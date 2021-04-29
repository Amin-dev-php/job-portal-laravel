@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form action="{{route('alljobs')}}" method="GET">
            <div class="form-inline" style="margin-top: 150px;">
                <div class="form-group">
                    <label>Position&nbsp;</label>
                    <input type="text" name="position" class="form-control" placeholder="job position">&nbsp;&nbsp;&nbsp;
                </div>
                <div class="form-group">
                    <label>Employment &nbsp;</label>
                    <select class="form-control" name="type">
                        <option value=""> -select- </option>
                        <option value="fulltime">fulltime</option>
                        <option value="parttime">parttime</option>
                        <option value="casual">casual</option>
                        <option value="remote">remote</option>
                    </select>
                    &nbsp;
                </div>
                <div class="form-group">
                    <label>category</label>
                    <select name="category_id" class="form-control">
                        <option value=""> -select- </option>
                        @foreach(App\Models\Category::all() as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                    &nbsp;
                </div>
                <div class="form-group">
                    <label>address</label>
                    <input type="text" name="address" class="form-control" placeholder="address">&nbsp;&nbsp;
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-search btn-primary btn-block" value="Search">
                </div>
            </div>
            <br>
        </form>
        <h1>Recent Jobs</h1>
        <div class="col-md-12 mb-2">
            @if(count($jobs)>0)
            <div class="rounded border jobs-wrap">
                @foreach ($jobs as $job)
                <a href="{{ route('jobs.show',[$job->id,$job->slug]) }}" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
                    <div class="company-logo blank-logo text-center text-md-left pl-3">
                        @if($job->company->logo !=='avatar/man.jpg')
                        <img src="{{ asset('upload/company-logo/'.$job->company->logo) }}" alt="Image" class="img-fluid mx-auto">
                        @else
                        <img src="{{ asset('avatar/man.jpg') }}" alt="Image" class="img-fluid mx-auto">
                        @endif
                    </div>
                    <div class="job-details h-100">
                        <div class="p-3 align-self-center">
                            <h3>{{ $job->position }}</h3>
                            <div class="d-block d-lg-flex">
                                <div class="mr-3"><span class="icon-suitcase mr-1"></span> {{ $job->company->cname }}</div>
                                <div class="mr-3"><span class="icon-room mr-1"></span> {{Str::limit($job->address ,20, '...') }}</div>
                                <div><span class="icon-money mr-1"></span> {{ $job->salary }}</div>
                                <div>&nbsp;&nbsp;&nbsp;<span class="fa fa-clock-o mr-1"></span>{{$job->created_at->diffForHumans()}}</div>
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
            </div>
            @else
            <h3>no jobs Found</h3>
            @endif
        </div>
        {{$jobs->appends(Illuminate\Support\Facades\request::except('page'))->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
@endsection
{{-- <style>
    .fa,
    .fas {
        color: #4351DC
    }

</style> --}}
