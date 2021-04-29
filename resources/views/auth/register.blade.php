@extends('layouts.main')
@section('content')
<div class="album text-muted">
    <div class="container">
        <div class="row">
            <h1>Employer Registration</h1>
            <div class="site-section bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-8 mb-5">
                            @include('error-partial.error')
                            <form method="POST" action="{{ route('register') }}" class="p-5 bg-white">
                                @csrf
                                <input type="hidden" value="seeker" name="user_type">
                                <div class="form-group row">
                                    <div class="col-md-12">Name</div>
                                    <div class="col-md-12">
                                        <input id="name" type="text" placeholder="Enter name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">Email</div>
                                    <div class="col-md-12">
                                        <input id="email" type="text" placeholder="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">Date Of Birth</div>
                                    <div class="col-md-12">
                                        <input id="dob" type="date" placeholder="email" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}" required autofocus>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">Password</div>
                                    <div class="col-md-12">
                                        <input id="password" type="password" placeholder="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required autofocus>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">Confirm password</div>

                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 mb-2">Gender</div>
                                    <div class="col-md-12">
                                        <input class="mt-2" type="radio" name="gender" id="" value="male" required>Male
                                        <input class="mt-2" type="radio" name="gender" id="" value="female" required>Female

                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <input type="submit" value="Register as User" class="btn btn-primary  py-2 px-5">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="p-4 mb-3 bg-white">
                                <h3 class="h5 text-black mb-3">More Info</h3>
                                <p>Once you create an account a verification link will be sent to your email.</p>
                                <p><a href="#" class="btn btn-primary  py-2 px-4">Learn More</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
