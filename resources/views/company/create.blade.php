@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->company->logo))
            <img src="{{ asset('avatar/man.jpg') }}" alt="" width="100" style="width: 100%">
            @else
            <img src="{{ asset('upload/company-logo/'.Auth::user()->company->logo) }}" alt="" width="100" style="width: 100%" height="200">
            @endif
            <form action="{{ route('company.logo') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="card mt-3">
                    <div class="card-header mt-2">Update Your Logo Company</div>
                    <div class="card-body">
                        <input class="form-control" type="file" name="logo" id="logo">
                        <button class="btn btn-success mt-2 float-right" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-5">
            <div class="card">
                @include('error-partial.error')
                <div class="card-header">Update Your Company Information</div>
                <form action="{{ route('company.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input v class="form-control" type="text" name="address" value="{{ Auth::user()->company->address }}" id="address">
                        </div>

                        <div class="form-group">
                            <label for="phone">phone number</label>
                            <input v class="form-control" type="text" name="phone" value="{{ Auth::user()->company->phone }}" id="phone">
                        </div>

                        <div class="form-group">
                            <label for="website">Website</label>
                            <input v class="form-control" type="text" name="website" value="{{ Auth::user()->company->website }}" id="website">
                        </div>

                        <div class="form-group">
                            <label for="slogan">slogan</label>
                            <input v class="form-control" type="text" name="slogan" value="{{ Auth::user()->company->slogan }}" id="slogan">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ Auth::user()->company->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success float-right" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Your Company Information</div>
                <div class="card-body">
                    <p><strong>Company Name:&nbsp;</strong>{{ Auth::user()->company->cname }}</p>
                    <p><strong>Address:&nbsp;</strong>{{ Auth::user()->company->address }}</p>
                    <p><strong>Phone:&nbsp;</strong>{{ Auth::user()->company->phone }}</p>
                    <p><strong>Website:&nbsp;</strong>
                        <a href="{{Auth::user()->company->website}}">{{ Auth::user()->company->website }}</a>
                    </p>
                    <p><strong>Slogan:&nbsp;</strong>{{ Auth::user()->company->slogan }}</p>
                    <p><strong>Company Page:&nbsp;</strong><a href="{{ route('company.index',[Auth::user()->company->id,Auth::user()->company->slug]) }}">View</a></p>
                </div>
            </div>

            <form action="{{ route('cover.photo') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="card mt-2">
                    <div class="card-header">Update Your Cover Photo</div>
                    <div class="card-body">
                        <input class="form-control" type="file" name="cover_photo" id="">
                        <button class="btn btn-success mt-2 float-right" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
