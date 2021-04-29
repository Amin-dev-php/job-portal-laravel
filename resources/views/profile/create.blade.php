@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->profile->avatar))
            <img src="{{ asset('avatar/man.jpg') }}" alt="" width="100" style="width: 100%">
            @else
            <img src="{{ asset('upload/avatar/'.Auth::user()->profile->avatar) }}" alt="" width="100" style="width: 100%">
            @endif
            <form action="{{ route('avatar') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="card mt-3">
                    <div class="card-header mt-2">Update Your Avatar</div>
                    <div class="card-body">
                        <input class="form-control" type="file" name="avatar" id="">
                        <button class="btn btn-success mt-2 float-right" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-5">
            <div class="card">
                @include('error-partial.error')
                <div class="card-header">Update Your Profile</div>
                <form action="{{ route('profile.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input v class="form-control" type="text" name="address" id="address" value="{{Auth::user()->profile->address}}" id="">
                        </div>

                        <div class="form-group">
                            <label for="phone_number">phone number</label>
                            <input v class="form-control" type="text" name="phone_number" id="phone_number" value="{{Auth::user()->profile->phone_number}}" id="">
                        </div>

                        <div class="form-group">
                            <label for="experience">Experience</label>
                            <textarea name="experience" id="experience" class="form-control">{{Auth::user()->profile->experience}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea name="bio" id="bio" class="form-control">{{Auth::user()->profile->bio}}</textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Your Information</div>
                <div class="card-body">
                    <p><strong>Name:&nbsp;</strong>{{Auth::user()->name}}</p>
                    <p><strong>Email:&nbsp;</strong>{{Auth::user()->email}}</p>
                    <p><strong>Address:&nbsp;</strong>{{Auth::user()->profile->address}}</p>
                    <p><strong>Phone Number:&nbsp;</strong>{{Auth::user()->profile->phone_number}}</p>
                    <p><strong>gender:&nbsp;</strong>{{Auth::user()->profile->gender}}</p>
                    <p><strong>Experince:&nbsp;</strong>{{Auth::user()->profile->experience}}</p>
                    <p><strong>Bio:&nbsp;</strong>{{Auth::user()->profile->bio}}</p>
                    <p><strong>Member On:&nbsp;</strong>{{date('F d Y',strtotime(Auth::user()->profile->created_at))}}</p>
                    @if(!empty(Auth::user()->profile->cover_letter))
                    <p>
                        <a href="{{ Storage::url(Auth::user()->profile->cover_letter) }}">Cover Letter</a>
                    </p>
                    @else
                    <p>Please Upload Your Cover letter</p>
                    @endif

                    @if(!empty(Auth::user()->profile->resume))
                    <p>
                        <a href="{{ Storage::url(Auth::user()->profile->resume) }}">Resume</a>
                    </p>
                    @else
                    <p>Please Upload Your Resume</p>
                    @endif

                </div>
            </div>

            <form action="{{ route('cover.letter') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="card mt-2">
                    <div class="card-header">Update Your Cover Letter</div>
                    <div class="card-body">
                        <input class="form-control" type="file" name="cover_letter" id="">
                        <button class="btn btn-success mt-2 float-right" type="submit">Update</button>
                    </div>
                </div>
            </form>


            <form action="{{ route('resume') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="card mt-2">
                    <div class="card-header mt-2">Update Your Resume</div>
                    <div class="card-body">
                        <input class="form-control" type="file" name="resume" id="">
                        <button class="btn btn-success mt-2 float-right" type="submit">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
