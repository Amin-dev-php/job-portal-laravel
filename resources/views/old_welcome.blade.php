@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <search-component></search-component>
        </div>
        <br>
        <br>
        <h1>Recent Jobs</h1>
        <table class="table">
            <thead>
                <th>logo</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                <tr>
                    <td>
                        @if($job->company->logo !=='avatar/man.jpg')
                        <img src="{{ asset('upload/company-logo/'.$job->company->logo) }}" alt="" width="80" height="60">
                        @else
                        <img src="{{ asset('avatar/man.jpg') }}" alt="" width="80" height="60">
                        @endif
                    </td>
                    <td>Posision:{{ $job->position }}
                        <br>
                        <i class="fas fa-clock"></i>&nbsp;{{ $job->type }}
                    </td>
                    <td><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;{{ $job->address }}</td>
                    <td><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;{{ $job->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('jobs.show',[$job->id,$job->slug]) }}">
                            <button class="btn btn-success btn-sm">Apply</button>
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div>
        <a href="{{ route('alljobs') }}"> <button class="btn btn-success btn-lg" style="width: 100%">Browse All Jobs</button></a>
    </div>
    <br><br>
    <h1>Featured Companies</h1>
</div>

<div class="container">
    <div class="row">
        @foreach ($companies as $company )
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                @if($company->logo !=='avatar/man.jpg')
                <img src="{{ asset('upload/company-logo/'.$company->logo) }}" alt="" width="60" height="60">
                @else
                <img src="{{ asset('avatar/man.jpg') }}" alt="" width="60" height="60">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{Str::limit($company->cname, 20, '...')  }}</h5>
                    <p class="card-text">{{Str::limit($company->description, 20, '...')  }}</p>
                    <a href="{{ route('company.index',[$job->company->id,$job->company->slug])}}" class="btn btn-primary">Visit Company</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection


<style>
    .fa,
    .fas {
        color: #4351DC
    }

</style>
