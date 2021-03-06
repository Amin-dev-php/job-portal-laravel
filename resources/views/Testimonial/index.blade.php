@extends('layouts.app')
@section('content')
<div class="container">
    @include('error-partial.error')
    <div class="row">
        <div class="col-md-4">
            @include('admin.left-menu')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Content</th>
                                <th scope="col">Name</th>
                                <th scope="col">Profession</th>
                                <th scope="col">Viemo video id</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testimonials as $testimonial)
                            <tr>
                                <td>{{$testimonial->content}}</td>
                                <td>{{$testimonial->name}}</td>
                                <td>{{$testimonial->profession}}</td>
                                <td>{{$testimonial->video_id}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$testimonials->links('vendor.pagination.bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
