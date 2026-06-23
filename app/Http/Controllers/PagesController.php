<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\Contact;

use App\Models\Property;
use App\Models\Message;
use App\Models\File;
use App\Models\Rating;
use App\Models\Post;
use App\Models\User;
use App\Models\Inquiry;

use Carbon\Carbon;

class PagesController extends Controller
{
    public function properties()
    {
        $cities     = Property::select('city')->distinct()->get();
        $properties = Property::latest('created_at')
            ->with(['rating','units','gallery'])
            ->withCount('comments')
            ->paginate(12);

        return view('pages.properties.property', compact('properties','cities'));
    }

    public function propertieshow(string $slug)
    {
        $property = Property::with([
                                'gallery',
                                'user',
                                'units',
                                'comments.user',
                                'comments.children.user',
                            ])
                            ->withCount('comments')
                            ->where('slug', '=', $slug, 'and')
                            ->first(['*']);

        $rating = Rating::where('model_type', '=', Property::class, 'and')
            ->where('model_id', '=', $property->id, 'and')
            ->avg('score');

        $relatedproperty = Property::latest('created_at')
                ->where('type', '=', $property->type, 'and')
                ->where('city', '=', $property->city, 'and')
                ->where('id', '!=', $property->id, 'and')
                ->with('gallery')
                ->take(5)
                ->get();

        $cities = Property::select('city')->distinct()->get();

        return view('pages.properties.single', compact('property','rating','relatedproperty','cities'));
    }


    // AGENT PAGE
    public function agents()
    {
        $agents = User::latest('created_at')->whereIn('type', ['owner', 'staff'])->paginate(12);

        return view('pages.agents.index', compact('agents'));
    }

    public function agentshow(string $id)
    {
        $agent      = User::findOrFail($id);
        $properties = Property::latest('created_at')->where('owner_id', '=', $id, 'and')->paginate(10);

        return view('pages.agents.single', compact('agent','properties'));
    }


    // BLOG PAGE
    public function blog()
    {
        $month = request('month');
        $year  = request('year');

        $posts = Post::latest('created_at')->withCount('comments')
                                ->when($month, function ($query, $month) {
                                    return $query->whereMonth('created_at', Carbon::parse($month)->month);
                                })
                                ->when($year, function ($query, $year) {
                                    return $query->whereYear('created_at', $year);
                                })
                                ->where('status', '=', 'published', 'and')
                                ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    public function blogshow(string $slug)
    {
        $post = Post::with('comments')
            ->withCount('comments')
            ->where('slug', '=', $slug, 'and')
            ->where('status', '=', 'published', 'and')
            ->first(['*']);

        return view('pages.blog.single', compact('post'));
    }


    // BLOG COMMENT
    public function blogComments(Request $request, string $id)
    {
        $request->validate([
            'body'  => 'required'
        ]);

        $post = Post::find($id, ['*']);

        $post->comments()->create(
            [
                'user_id'   => Auth::id(),
                'body'      => $request->body,
                'parent'    => $request->parent,
                'parent_id' => $request->parent_id
            ]
        );

        return back();
    }


    // BLOG CATEGORIES
    public function blogCategories(string $slug)
    {
        $posts = Post::latest('created_at')->withCount(['comments','categories'])
                                ->whereHas('categories', function($query) use ($slug) {
                                    $query->where('categories.slug', '=', $slug);
                                })
                                ->where('status', '=', 'published', 'and')
                                ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    // BLOG TAGS
    public function blogTags(string $slug)
    {
        $posts = Post::latest('created_at')->withCount('comments')
                                ->whereHas('tags', function($query) use ($slug) {
                                    $query->where('tags.slug', '=', $slug);
                                })
                                ->where('status', '=', 'published', 'and')
                                ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    // BLOG AUTHOR
    public function blogAuthor(string $userId)
    {
        $posts = Post::latest('created_at')->withCount('comments')
                    ->where('author_id', '=', $userId, 'and')
                    ->where('status', '=', 'published', 'and')
                                ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }



    // MESSAGE TO AGENT (SINGLE AGENT PAGE)
    public function messageAgent(Request $request)
    {
        $request->validate([
            'receiver_id'  => 'required|uuid',
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'message'   => 'required'
        ]);

        $inquiry = Inquiry::create([
            'property_id' => $request->property_id,
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'status' => 'new',
        ]);

        if (Auth::check()) {
            Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $request->receiver_id,
                'inquiry_id' => $inquiry->id,
                'subject' => $request->subject,
                'body' => $request->message,
            ]);
        }

        if($request->ajax()){
            return response()->json(['message' => 'Message send successfully.']);
        }

    }

    
    // CONATCT PAGE
    public function contact()
    {
        return view('pages.contact');
    }

    public function messageContact(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'message'   => 'required'
        ]);

        $message  = $request->message;
        $mailfrom = $request->email;

        if (Auth::check()) {
            Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => User::first(['*'])?->id,
                'subject' => $request->subject,
                'body' => $message,
            ]);
        }
            
        $adminname  = User::find(1, ['*'])->name;
        $mailto     = $request->mailto;

        Mail::to($mailto)->send(new Contact($message,$adminname,$mailfrom));

        if($request->ajax()){
            return response()->json(['message' => 'Message send successfully.']);
        }

    }

    public function contactMail(Request $request)
    {
        return $request->all();
    }


    // GALLERY PAGE
    public function gallery()
    {
        $galleries = File::latest('created_at')->paginate(12);

        return view('pages.gallery',compact('galleries'));
    }


    // PROPERTY COMMENT
    public function propertyComments(Request $request, string $id)
    {
        $request->validate([
            'body'  => 'required'
        ]);

        $property = Property::find($id, ['*']);

        $property->comments()->create(
            [
                'user_id'   => Auth::id(),
                'body'      => $request->body,
                'parent'    => $request->parent,
                'parent_id' => $request->parent_id
            ]
        );

        return back();
    }


    // PROPERTY RATING
    public function propertyRating(Request $request)
    {
        $score      = $request->input('rating');
        $propertyId = $request->input('property_id');
        $userId     = $request->input('user_id');

        $rating = Rating::updateOrCreate(
            ['user_id' => $userId, 'model_type' => Property::class, 'model_id' => $propertyId],
            ['score' => $score]
        );

        if($request->ajax()){
            return response()->json(['rating' => $rating]);
        }
    }


    // PROPERTY CITIES
    public function propertyCities()
    {
        $cities     = Property::select('city')->distinct()->get();
        $properties = Property::latest('created_at')->with('rating')->withCount('comments')
                ->where('city', '=', request('city'), 'and')
                        ->paginate(12);

        return view('pages.properties.property', compact('properties','cities'));
    }


}
