<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Carbon\Carbon;
use App\Models\Comment;
use App\Models\Message;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;

class DashboardController extends Controller
{
    public function index()
    {   
        $comments = Comment::latest('created_at')
                           ->with('commentable')
                   ->where('user_id', '=', Auth::id(), 'and')
                           ->paginate(10);

        $commentcount = Comment::where('user_id', '=', Auth::id(), 'and')->count('*');

        return view('user.dashboard',compact('comments','commentcount'));
    }

    public function profile()
    {
        $profile = Auth::user();

        return view('user.profile',compact('profile'));
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
            $imagename = $slug.'-user-'.Auth::id().'-'.$currentDate.'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('users')){
                Storage::disk('public')->makeDirectory('users');
            }
            if(Storage::disk('public')->exists('users/'.$user->avatar) && $user->avatar){
                Storage::disk('public')->delete('users/'.$user->avatar);
            }
            $userimage = (string) Image::decode($image)->encode();
            Storage::disk('public')->put('users/'.$imagename, $userimage);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->avatar = isset($imagename) ? $imagename : $user->avatar;

        $user->save();

        return back();
    }


    public function changePassword()
    {
        return view('user.changepassword');

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


    // MESSAGE
    public function message()
    {
        $messages = Message::latest('created_at')->where('receiver_id', '=', Auth::id(), 'and')->paginate(10);

        return view('user.messages.index',compact('messages'));
    }

    public function messageRead(string $id)
    {
        $message = Message::findOrFail($id);

        if ($message->receiver_id === Auth::id() && $message->read_at === null) {
            $message->read_at = now();
            $message->save();
        }

        return view('user.messages.read',compact('message'));
    }

    public function messageReplay(string $id)
    {
        $message = Message::findOrFail($id);

        return view('user.messages.replay',compact('message'));
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

        return redirect()->route('user.message');
    }

    public function messageDelete(string $id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        Toastr::success('message', 'Message deleted successfully.');
        return back();
    }

}
