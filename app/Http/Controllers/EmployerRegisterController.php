<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployerRegisterController extends Controller
{
    public function employerRgister(Request $request)
    {
        $this->validate($request, [
            'cname' => 'required|string|max:60',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([

            'email' => $request->email,
            'user_type' => $request->user_type,
            'password' => Hash::make($request->password),
        ]);

        Company::create([
            'user_id' => $user->id,
            'cname' => $request->cname,
            'slug' => Str::slug($request->cname),
        ]);

        $user->sendEmailVerificationNotification();

        return redirect()->back()->with('message', 'A verification link is sent to your email. Please follow the link to verify it');
    }
}
