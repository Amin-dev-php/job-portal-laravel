@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="company-profile">
            @if(empty($company->cover_photo) || $company->cover_photo =='cover/Banner-Company.jpg' )
            <img src="{{ asset('cover/Banner-Company.jpg') }}" alt="" style="width: 100%;">
            @else
            <img src="{{ asset('upload/cover-photo/'.$company->cover_photo)}}" alt="" style="width: 100%" height="300">
            @endif
            <div class="company-desc">
                @if(empty($company->logo) || $company->logo =='avatar/man.jpg')
                <img class="mt-4 mb-4" src="{{ asset('avatar/man.jpg') }}" alt="" width="100">
                @else
                <img class="mt-4 mb-4" src="{{ asset('upload/company-logo/'.$company->logo) }}" alt="" width="100">
                @endif
                <p>{{ $company->description }}</p>
                <h1>{{ $company->cname }}</h1>
                <p><strong>Slogan</strong>:&nbsp{{ $company->slogan }}
                    <br>
                    <strong>Address</strong>&nbsp:{{ $company->address }}
                    <br>
                    <strong>phone</strong>:&nbsp{{ $company->phone }};
                    <br>
                    <strong>Website</strong>:&nbsp{{$company->website }}</p>
            </div>
        </div>

        <table class="table">
            <thead>
                <th>logo</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($company->jobs as $job)
                <tr>
                    <td>
                        @if(empty($company->logo) || $company->logo =='avatar/man.jpg')
                        <img src="{{ asset('avatar/man.jpg') }}" alt="" width="80" height="50">
                        @else
                        <img class="mt-4 mb-4" src="{{ asset('upload/company-logo/'.$company->logo) }}" alt="" width="80" height="50">
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
</div>
@endsection
