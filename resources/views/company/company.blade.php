@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Companies</h1>
    <br>
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
                    <a href="{{ route('company.index',[$company->id,$company->slug])}}" class="btn btn-primary">Visit Company</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <br>
    {{$companies->links('vendor.pagination.bootstrap-4')}}

</div>
@endsection


<style scoped>
    #navbar {
        position: relative;
    }

</style>
