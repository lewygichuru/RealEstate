<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Carbon\Carbon;

use App\Mail\Contact;

use App\Models\Property;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Setting;
use App\Models\Message;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;

class DashboardController extends Controller
{
    public function index()
    {
        $propertycount     = Schema::hasTable('properties') ? Property::count('*') : 0;
        $postcount         = Schema::hasTable('posts') ? Post::count('*') : 0;
        $commentcount      = Schema::hasTable('comments') ? Comment::count('*') : 0;
        $usercount         = Schema::hasTable('users') ? User::count('*') : 0;
        $rolecount         = Schema::hasTable('roles') ? Role::count('*') : 0;
        $permissioncount   = Schema::hasTable('permissions') ? Permission::count('*') : 0;
        $todayregistrations = Schema::hasTable('users') ? User::whereDate('created_at', '=', today(), 'and')->count('*') : 0;
        $weekregistrations  = Schema::hasTable('users') ? User::where('created_at', '>=', now()->startOfWeek(), 'and')->count('*') : 0;

        $properties   = Schema::hasTable('properties') ? Property::latest('created_at')->with('user')->take(5)->get() : collect();
        $posts        = Schema::hasTable('posts') ? Post::latest('created_at')->with('user')->withCount('comments')->take(5)->get() : collect();
        $users        = Schema::hasTable('users') ? User::latest('created_at')->with('roles')->take(5)->get() : collect();
        $comments     = Schema::hasTable('comments') ? Comment::with('user')->take(5)->get() : collect();

        return view('admin.dashboard', compact(
            'propertycount', 'postcount', 'commentcount', 'usercount',
            'rolecount', 'permissioncount', 'todayregistrations', 'weekregistrations',
            'properties', 'posts', 'users', 'comments'
        ));
    }


    public function settings()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.settings.setting',compact('settings'));
    }

    public function settingStore(Request $request)
    {

        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'address'   => 'required',
            'footer'    => 'required',
            'aboutus'   => 'required',
            'facebook'  => 'required|url',
            'twitter'   => 'required|url',
            'linkedin'  => 'required|url',
        ]);

        $payload = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'footer' => $request->footer,
            'aboutus' => $request->aboutus,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
        ];

        foreach ($payload as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => 'general', 'type' => 'text']
            );
        }

        Toastr::success('message', 'Updated successfully.');
        return back();
    }


    public function changePassword()
    {
        return view('admin.settings.changepassword');

    }

    public function changePasswordUpdate(Request $request)
    {
        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {

            Toastr::error('message', 'Your current password does not matches with the password you provided! Please try again.');
            return redirect()->back();
        }
        if(strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0){

            Toastr::error('message', 'New Password cannot be same as your current password! Please choose a different password.');
            return redirect()->back();
        }

        $request->validate([
            'currentpassword' => 'required',
            'newpassword' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        Toastr::success('message', 'Password changed successfully.');
        return redirect()->back();
    }


    public function profile()
    {
        $profile = Auth::user();

        return view('admin.settings.profile',compact('profile'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'     => 'nullable',
            'image'     => 'image|mimes:jpeg,jpg,png',
        ]);

        $user = User::find(Auth::id(), ['*']);

        $image = $request->file('image');
        $slug  = Str::slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-admin-'.Auth::id().'-'.$currentDate.'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('users')){
                Storage::disk('public')->makeDirectory('users');
            }
            if(Storage::disk('public')->exists('users/'.$user->avatar) && $user->avatar){
                Storage::disk('public')->delete('users/'.$user->avatar);
            }
            $userimage = (string) Image::decode($image)->encode();
            Storage::disk('public')->put('users/'.$imagename, $userimage);

        }else{
            $imagename = $user->avatar;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->avatar = $imagename;

        $user->save();

        return back();
    }


    // MESSAGE
    public function message()
    {
        $messages = Message::latest('created_at')->where('receiver_id', '=', Auth::id(), 'and')->get();

        return view('admin.settings.messages.index',compact('messages'));
    }

    public function messageRead(string $id)
    {
        $message = Message::findOrFail($id);

        if ($message->receiver_id === Auth::id() && $message->read_at === null) {
            $message->read_at = now();
            $message->save();
        }

        return view('admin.settings.messages.readmessage',compact('message'));
    }

    public function messageReplay(string $id)
    {
        $message = Message::findOrFail($id);

        return view('admin.settings.messages.replaymessage',compact('message'));
    }

    public function messageSend(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|uuid',
            'subject'     => 'nullable|string|max:255',
            'body'        => 'required|string'
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'subject' => $request->subject,
            'body' => $request->body,
        ]);

        Toastr::success('message', 'Message send successfully.');
        return back();

    }

    public function messageReadUnread(Request $request)
    {
        $message = Message::findOrFail($request->messageid);

        if ($message->read_at) {
            $message->read_at = null;
        } else {
            $message->read_at = now();
        }

        $message->save();

        return redirect()->route('admin.message');
    }

    public function messageDelete(string $id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        Toastr::success('message', 'Message deleted successfully.');
        return back();
    }

    public function contactMail(Request $request)
    {
        $message  = $request->message;
        $name     = $request->name;
        $mailfrom = $request->mailfrom;

        Mail::to($request->email)->send(new Contact($message,$name,$mailfrom));

        Toastr::success('message', 'Mail send successfully.');
        return back();
    }
}
