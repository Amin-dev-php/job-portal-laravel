@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(Auth::user()->user_type =='seeker')
            @foreach ($jobs as $job)
            <div class="card">
                <div class="card-header">{{ $job->title}}</div>
                <small class="badge badge-primary">{{ $job->position}}</small>

                <div class="card-body">
                    {{ $job->description}}
                </div>
                <div class="card-footer">
                    <span><a href="{{ route('jobs.show',[$job->id,$job->slug]) }}">Read</a></span>
                    <span class="float-right">Last Date:{{ $job->last_date }}</span>
                </div>
            </div>
            <br>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
