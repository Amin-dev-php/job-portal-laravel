@extends('layouts.app')
@section('content')
<div class="container">
    @if(Session::has('message'))
    <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-4">
            @include('admin.left-menu')
        </div>
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date Create</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post )
                    <tr>
                        <td><img src="{{ asset('upload/post-image/'.$post->image) }}" alt="" width="60" height="60"></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ Str::limit($post->content, 10, '...') }}</td>
                        <td>
                            @if($post->status =='1')
                            <a href="{{ route('post.toggle',$post->id) }}" class="badge badge-success">live</a>
                            @else
                            <a href="{{ route('post.toggle',$post->id) }}" class="badge badge-primary">draft</a>
                            @endif
                        </td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('post.edit',$post->id) }}"><button class="btn btn-success">Edit</button></a>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                                Trashed
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Do You want Trashed This Post?
                                        </div>
                                        <form action="{{ route('post.softdelete' ,$post->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Trashed</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $posts->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>

@endsection
