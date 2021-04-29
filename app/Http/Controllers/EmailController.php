<?php

namespace App\Http\Controllers;

use App\Mail\SendJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(Request $request)
    {

        $this->validate($request, [
            'your_name' => 'required|string',
            'your_email' => 'required|email',

            'friend_name' => 'required|string',
            'friend_email' => 'required|email'
        ]);

        $homeUrl = url('/');
        $jobId = $request->job_id;
        $jobSlug = $request->job_slug;

        $jobUrl = $homeUrl . '/' . 'jobs/' . $jobId . '/' . $jobSlug;

        $data = array(
            'your_name' => $request->your_name,
            'your_email' => $request->your_email,
            'friend_name' => $request->friend_name,
            'jobUrl' => $jobUrl
        );

        $emailTo = $request->get('friend_email');
        try {
            Mail::to($emailTo)->send(new SendJob($data));
            return redirect()->back()->with('message', 'Job link sent to ' . $emailTo);
        } catch (\Exception $e) {
            $e->getMessage();
            return redirect()->back()->with('err_message', 'Sorry, Something went wrong.Please try later');
        }
    }
}
