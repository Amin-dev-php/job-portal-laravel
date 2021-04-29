@extends('layouts.main')
@section('content')
<div class="album text-muted">
    <div class="container">
        <div class="row" id="app">
            <div class="title">
                <h2></h2>
            </div>
            @if($company->cover_photo =='cover/Banner-Company.jpg'|| empty($company->cover_photo))
            <img style="margin-top: 200px;" src="{{asset('cover/Banner-Company.jpg')}}" style="width:100%;">
            @else
            <img style="margin-top: 200px;" src="{{asset('upload/cover_photo/'.$company->cover_photo)}}" style="width: 100%;">
            @endif
            <div class="col-lg-12">
                <div class="p-4 mb-8 bg-white">
                    <div class="company-desc">
                        @if($company->logo =='avatar/man.jpg'|| empty($company->logo))
                        <img width="100" src="{{asset('avatar/man.jpg')}}">
                        @else
                        <img width="100" src="{{asset('upload/company-logo/'.$company->logo)}}">
                        @endif
                        <h3 class="mt-2">description</h3>
                        <p>{{$company->description}}</p>
                        <p><b> Company Name:</b>&nbsp;{{$company->cname}}</p>
                        <p><b>Slogan:</b> &nbsp;{{$company->slogan}}</p>
                        <p><b>Address:</b>&nbsp;{{$company->address}}</p>
                        <p><b>Phone:</b>&nbsp;{{$company->phone}}</p>
                        <p><b>Website:</b>&nbsp;<a target="_blank" href="https://{{$company->website}}">{{$company->website}}</a></p>
                    </div>
                </div>
                <hr style="width:100%" , size="3" , color=green>
                <table class="table">
                    <tbody>
                        <h2>Posted Jobs by This Company</h2>
                        @foreach($company->jobs as $job)
                        <tr>
                            <td>
                                @if($company->logo =='avatar/man.jpg'|| empty($company->logo))
                                <img width="100" src="{{asset('avatar/man.jpg')}}">
                                @else
                                <img width="100" src="{{asset('upload/company-logo/'.$company->logo)}}">
                                @endif
                            </td>
                            <td>Position:{{$job->position}}
                                <br>
                                <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;{{$job->type}}
                            </td>
                            <td><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Address:{{$job->address}}</td>
                            <td><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;Date:{{$job->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('jobs.show',[$job->id,$job->slug])}}">
                                    <button class="btn btn-success btn-sm"> Apply
                                    </button>
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
@endsection
