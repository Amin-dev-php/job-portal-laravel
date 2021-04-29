<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['seeker', 'verified']);
    }

    public function index()
    {
    }

    public function create()
    {
        return view('profile.create');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'address' => 'required',
            'phone_number' => 'required|min:10|numeric',
            'experience' => 'required|min:20',
            'bio' => 'required|min:20',

        ]);

        $user_id = auth()->user()->id;

        Profile::where('user_id', $user_id)->update([
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'experience' => $request->experience,
            'bio' => $request->bio,
        ]);

        return redirect()->back()->with('message', 'Profile Succesfully Updated!');
    }

    public function coverletter(Request $request)
    {

        $validation = $request->validate([
            'cover_letter' => 'required|mimes:pdf,doc,docx|max:20000'
        ]);

        $user_id = auth()->user()->id;
        if (isset(Auth::user()->profile->cover_letter)) {
            // path stored file cover-letter in directory storage
            $path = 'app/' . Auth::user()->profile->cover_letter;
            $path = storage_path($path);
            if (file_exists($path)) {
                unlink($path);
            }
        }


        $cover = $request->file('cover_letter')->store('public/files/cover-letter');
        Profile::where('user_id', $user_id)->update([
            'cover_letter' => $cover,

        ]);

        return redirect()->back()->with('message', 'cover letter Succesfully Updated!');
    }

    public function resume(Request $request)
    {
        $validation = $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:20000'
        ]);

        $user_id = auth()->user()->id;
        if (isset(Auth::user()->profile->resume)) {
            // path stored file cover-letter in directory storage
            $path = 'app/' . Auth::user()->profile->resume;
            $path = storage_path($path);
            if (file_exists($path)) {
                unlink($path);
            }
        }


        $resume = $request->file('resume')->store('public/files/resume');

        Profile::where('user_id', $user_id)->update([
            'resume' => $resume,

        ]);

        return redirect()->back()->with('message', 'resume Succesfully Updated!');
    }

    public function avatar(Request $request)
    {
        $validation = $request->validate([
            'avatar' => 'required|mimes:png,jpeg,jpg|max:20000'
        ]);

        $user_id = auth()->user()->id;
        if (isset(Auth::user()->profile->avatar)) {
            // path stored file cover-letter in directory storage
            $path = 'upload/avatar/' . Auth::user()->profile->avatar;
            $path = public_path($path);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('upload/avatar/', $fileName);

            Profile::where('user_id', $user_id)->update([
                'avatar' => $fileName,
            ]);
            return redirect()->back()->with('message', 'Avatar Succesfully Updated!');
        }
    }
}
