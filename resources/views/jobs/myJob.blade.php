@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
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
                                    @if(empty(Auth::user()->company->logo))
                                    <img src="{{ asset('avatar/man.jpg') }}" alt="" width="80" height="80">
                                    @else
                                    <img src="{{ asset('upload/company-logo/'.Auth::user()->company->logo) }}" alt="" width="80" height="80">
                                    @endif
                                </td>
                                <td><b>Posision: &nbsp;</b>{{ $job->position }}
                                    <br>
                                    <i class="fas fa-clock"></i>&nbsp;{{ $job->type }}
                                </td>
                                <td><i class="fa fa-map-marker" aria-hidden="true"></i>Address:&nbsp;{{ $job->address }}</td>
                                <td><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;{{ $job->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('jobs.show',[$job->id,$job->slug]) }}">
                                        <button class="btn btn-success">Apply</button>
                                    </a>
                                    <br>
                                    <a href="{{ route('jobs.edit',[$job->id]) }}">
                                        <button class="btn btn-success mt-2">edit</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .fa,
    .fas {
        color: #4351DC
    }

</style>
