@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <h2 style="margin-top: 150px;">{{$categoryName->name}}</h2>
            <div class="rounded border jobs-wrap">
                @if(count($jobs)>0)
                @foreach($jobs as $job)
                <a href="{{route('jobs.show',[$job->id,$job->slug])}}" class="job-item d-block d-md-flex align-items-center  border-bottom @if($job->type=='parttime') partime @elseif($job->type=='fulltime')fulltime @else freelance   @endif;">
                    <div class="company-logo blank-logo text-center text-md-left pl-3">
                        @if($job->company->logo !=='avatar/man.jpg')
                        <img src="{{ asset('upload/company-logo/'.$job->company->logo) }}" alt="" width="60" height="60">
                        @else
                        <img src="{{ asset('avatar/man.jpg') }}" alt="" width="60" height="60">
                        @endif
                    </div>
                    <div class="job-details h-100">
                        <div class="p-3 align-self-center">
                            <h3>{{$job->position}}</h3>
                            <div class="d-block d-lg-flex">
                                <div class="mr-3"><span class="icon-suitcase mr-1"></span> {{$job->company->cname}}</div>
                                <div class="mr-3"><span class="icon-room mr-1"></span> {{Str::limit($job->address,20,'...')}}</div>
                                <div><span class="icon-money mr-1"></span>{{$job->salary}}</div>
                                <div>&nbsp;<span class="fa fa-clock-o mr-1"></span>{{$job->created_at->diffForHumans()}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="job-category align-self-center">
                        @if($job->type=='fullTime')
                        <div class="p-3">
                            <span class="text-info p-2 rounded border border-info">{{ $job->type }}</span>
                        </div>
                        @elseif ($job->type=='parttime')
                        <div class="p-3">
                            <span class="text-warning p-2 rounded border border-warning">{{ $job->type }}</span>
                        </div>
                        @elseif ($job->type=='remote')
                        <div class="p-3">
                            <span class="text-success p-2 rounded border border-success">{{ $job->type }}</span>
                        </div>
                        @elseif ($job->type=='casual')
                        <div class="p-3">
                            <span class="text-danger p-2 rounded border border-danger">{{ $job->type }}</span>
                        </div>
                        @endif
                    </div>
                </a>
                @endforeach
                @else
                <h1>No jobs found</h1>
                @endif
            </div>
        </div>
        {{$jobs->appends(Illuminate\Support\Facades\request::except('page'))->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
<br>

@endsection
<style>
    .fa,
    .fas {
        color: #4351DC
    }

</style>
