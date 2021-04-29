@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form action="{{route('alljobs')}}" method="GET">
            <div class="form-inline">
                <div class="form-group">
                    <label>Position&nbsp;</label>
                    <input type="text" name="position" class="form-control" placeholder="job position">&nbsp;&nbsp;&nbsp;
                </div>
                <div class="form-group">
                    <label>Employment &nbsp;</label>
                    <select class="form-control" name="type">
                        <option value=""> -select-</option>
                        <option value="fulltime">fulltime</option>
                        <option value="parttime">parttime</option>
                        <option value="casual">casual</option>
                        <option value="remote">remote</option>
                    </select>
                    &nbsp;&nbsp;
                </div>
                <div class="form-group">
                    <label>category</label>
                    <select name="category_id" class="form-control">
                        <option value=""> -select- </option>
                        @foreach(App\Models\Category::all() as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                    &nbsp;&nbsp;
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
        <table class="table">
            <thead>
                <th>logo</th>
                <th>Position</th>
                <th>Address</th>
                <th>Created_at</th>
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
                    <td>{{ $job->position }}
                        <br>
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
        {{$jobs->appends(Illuminate\Support\Facades\request::except('page'))->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
@endsection
<style>
    .fa,
    .fas {
        color: #4351DC
    }

</style>
