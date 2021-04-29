<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(20);
        return view('admin.index', compact('posts'));
    }
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('upload/post-image/', $fileName);
            Post::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'status' => $request->status,
                'image' => $fileName,
            ]);
        }

        return redirect('/dashboard')->with('message', 'post created Successfully');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.read', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.update', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required',
            'image' => 'mimes:jpeg,png,jpg',
        ]);
        $post = Post::findOrfail($id);

        if ($request->hasFile('image')) {

            // unlink old Image
            $oldImage = \public_path() . '/upload/post-image/' . $post->image;
            if (file_exists($oldImage) && !empty($post->image)) {
                unlink($oldImage);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('upload/post-image/', $fileName);

            $post->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'status' => $request->status,
                'image' => $fileName,
            ]);
        } else {
            $this->updateAllExpectImage($request, $post->id);
        }

        return redirect()->back()->with('message', 'Post Updated Successfully');
    }

    public function updateAllExpectImage(Request $request, $id)
    {
        return Post::findOrFail($id)->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status
        ]);
    }

    public function toggle($id)
    {
        $post = Post::find($id);
        $post->status = !$post->status;
        $post->save();
        return redirect()->back()->with('message', 'status Updated Successfully');
    }
    public function getAllJobs()
    {
        $jobs = Job::latest()->paginate(50);
        return view('admin.job', compact('jobs'));
    }

    public function changeJobStatus($id)
    {
        $job = Job::find($id);
        $job->status = !$job->status;
        $job->save();
        return redirect()->back()->with('message', 'Status updated successfully');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->paginate(20);
        return view('admin.trash', compact('posts'));
    }

    public function restore($id)
    {
        Post::onlyTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('message', 'post restored successfully!');
    }

    public function forceDelete($id)
    {
        Post::where('id', $id)->forceDelete();
        return redirect()->back()->with('message', 'post deleted successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->back()->with('message', 'post trashed successfully!');
    }
}
