<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::paginate(10);
        return view('testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('Testimonial.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|min:40|max:500',
            'name' => 'required',
            'profession' => 'required',
            'video_id' => 'required|integer'
        ]);

        Testimonial::create([
            'name' => $request->name,
            'content' => $request->content,
            'profession' => $request->profession,
            'video_id' => $request->video_id,
        ]);

        return redirect()->back()->with('message', 'Testimonial created Successfully');
    }
}
