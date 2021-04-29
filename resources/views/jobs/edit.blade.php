@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @include('error-partial.error')
                <div class="card-header">Update A Job</div>
                <div class="card-body">
                    <form action="{{ route('jobs.update' ,$job->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ $job->title }}" id="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" class="form-control">{{ $job->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="roles">Role:</label>
                            <textarea name="roles" id="roles" class="form-control">{{ $job->roles }}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select name="category_id" id="category" class="form-control">
                                @foreach ($categories as $category )
                                <option value="{{ $category->id}}" {{$job->category_id == $category->id ? 'selected': ''}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="position">Position:</label>
                            <input type="text" name="position" value="{{ $job->position }}" id="position" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" name="address" value="{{ $job->address }}" id="address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="number_of_vacancy">No of vacancy:</label>
                            <input type="text" name="number_of_vacancy" value="{{ $job->number_of_vacancy }}" class="form-control{{ $errors->has('number_of_vacancy') ? ' is-invalid' : '' }}" value="{{ old('number_of_vacancy') }}">
                        </div>

                        <div class="form-group">
                            <label for="experience">Year of experience:</label>
                            <input type="text" name="experience" value="{{ $job->experience }}" class="form-control{{ $errors->has('experience') ? ' is-invalid' : '' }}" value="{{ old('experience') }}">
                        </div>

                        <div class="form-group">
                            <label for="type">Gender:</label>
                            <select class="form-control" name="gender">
                                <option value="any">Any</option>
                                <option value="male" {{ $job->gender=='male'?'selected':'' }}>male</option>
                                <option value="female" {{ $job->gender=='female'?'selected':'' }}>female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Salary/year:</label>
                            <select class="form-control" name="salary">
                                <option value="negotiable">Negotiable</option>
                                <option value="2000-5000" {{ $job->salary=='2000-5000'?'selected':'' }}>$2000-$5000</option>
                                <option value="50000-10000" {{ $job->salary=='50000-$10000'?'selected':'' }}>$5000-$10000</option>
                                <option value="10000-20000" {{ $job->salary=='10000-20000'?'selected':'' }}>$10000-$20000</option>
                                <option value="30000-500000" {{ $job->salary=='30000-$500000'?'selected':'' }}>$50000-$500000</option>
                                <option value="500000-600000" {{ $job->salary=='500000-600000'?'selected':'' }}>$500000-$600000</option>

                                <option value="600000 plus" {{ $job->salary=='600000 plus'?'selected':'' }}>$600000 plus</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Type Job:</label>
                            <select name="type" id="type" class="form-control">
                                <option value="fulltime" {{ $job->type=='fulltime'?'selected':'' }}>fulltime</option>
                                <option value="parttime" {{ $job->type=='parttime'?'selected':'' }}>parttime</option>
                                <option value="remote" {{ $job->type=='remote'?'selected':'' }}>remote</option>
                                <option value="casual" {{ $job->type=='casual'?'selected':'' }}>casual</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $job->status== 1? 'selected':'' }}>Live</option>
                                <option value="0" {{ $job->status== 0? 'selected':'' }}>draft</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="last_date">Last Date:</label>
                            <input type="date" name="last_date" value="{{ $job->last_date }}" id="last_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                    </form>


                </div>

            </div>

        </div>
    </div>
</div>
@endsection
