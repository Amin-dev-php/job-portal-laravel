@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                @include('admin.left-menu')
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                @include('error-partial.error')
                <div class="card-header">
                    Edit Post
                </div>
                <div class="card-body">

                    <form action="{{ route('post.update',$post->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ $post->title }}" id="title" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control">{{ $post->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control" placeholder="" aria-describedby="helpId">
                            <img src="{{ asset('upload/post-image/'.$post->image)}}" alt="" style="width: 100%">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $post->status=='1'?'selected':'' }}>Live</option>
                                <option value="0" {{ $post->status=='0'?'selected':'' }}>Draft</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
