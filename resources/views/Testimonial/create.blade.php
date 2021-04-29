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
                    Create Post
                </div>
                <div class="card-body">

                    <form action="{{ route('testimonial.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="profession">Profession</label>
                            <input type="text" name="profession" id="profession" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="video_id">demo Video Id</label>
                            <input type="text" name="video_id" id="video_id" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
