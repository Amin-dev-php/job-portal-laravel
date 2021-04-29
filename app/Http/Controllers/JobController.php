<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Post;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Http\Requests\JobPostRequest;



class JobController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['employer', 'verified'], ['except' => array('index', 'show', 'applyJob', 'alljobs', 'searchJobs')]);
    }

    public function index()
    {
        $jobs = Job::latest()->limit(10)->where('status', 1)->get();
        $companies = Company::get()->random(12);
        $categories = Category::with('jobs')->get();
        $posts = Post::where('status',1)->get();
        return view('welcome', compact('jobs', 'companies', 'categories','posts'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $job = Job::findOrFail($id);
        return view('jobs.edit', compact('job', 'categories'));
    }

    public function update(Request $request, JobPostRequest $JobPostRequest, $id)
    {

        $job = Job::find($id);
        $job->update($request->all());

        return  redirect()->back()->with('message', ' Job updated Successfuly!');
    }

    public function show($id)
    {
        $job = job::findOrFail($id);
        $jobRecommendations = $this->jobRecommendations($job);
        return view('jobs.show', compact('job', 'jobRecommendations'));
    }

    public function jobRecommendations($job)
    {
        $data = [];
        // recommended Jobs Based On Category
        $jobsBasedOnCategories = Job::latest()
            ->where('category_id', $job->category_id)
            ->whereDate('last_date', '>', date('Y-m-d'))
            ->where('id', '!=', $job->id)
            ->where('status', 1)
            ->limit(6)
            ->get();
        array_push($data, $jobsBasedOnCategories);

        // recommended Jobs Based On Company
        $jobBasedOnCompany = Job::latest()
            ->where('company_id', $job->company_id)
            ->whereDate('last_date', '>', date('Y-m-d'))
            ->where('id', '!=', $job->id)
            ->where('status', 1)
            ->limit(6)
            ->get();
        array_push($data, $jobBasedOnCompany);

        // recommended Jobs Based On position
        $jobBasedOnPosition = Job::where('position', 'LIKE', '%' . $job->position . '%')
            ->where('id', '!=', $job->id)
            ->where('status', 1)
            ->limit(6);
        array_push($data, $jobBasedOnPosition);

        $collection  = collect($data);
        $unique = $collection->unique("id");
        $jobRecommendations =  $unique->values()->first();
        return $jobRecommendations;
    }


    public function myJob()
    {
        $user_id = auth()->user()->id;
        $jobs = Job::where('user_id', $user_id)->get();
        return view('jobs.myJob', compact('jobs'));
    }


    public function applicant()
    {
        //Applicant one specify Job by Users
        $applicants = Job::has('users')->where('user_id', auth()->user()->id)->get();
        return view('jobs.applicants', compact('applicants'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('jobs.create', compact('categories'));
    }

    public function store(Request $request, JobPostRequest $JobPostRequest)
    {


        $user_id = auth()->user()->id;
        $company_id = auth()->user()->company->id;
        Job::create([
            'user_id' => $user_id,
            'company_id' => $user_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'roles' => $request->roles,
            'category_id' => $request->category_id,
            'position' => $request->position,
            'address' => $request->address,
            'type' => $request->type,
            'status' => $request->status,
            'last_date' => $request->last_date,
            'number_of_vacancy' => $request->number_of_vacancy,
            'experience' => $request->experience,
            'gender' => $request->gender,
            'salary' => $request->salary,
        ]);

        return  redirect()->back()->with('message', ' Job Add Successfuly!');
    }


    public function applyJob(Request $request, $id)
    {
        $job_id = Job::findOrFail($id);
        $job_id->users()->attach(Auth::user()->id);
        return  redirect()->back()->with('message', ' Applicant  Successfuly Sent!');
    }

    public function alljobs(Request $request)
    {
        //front search
        $search = $request->search;
        $address = $request->address;
        if ($search || $address) {

            $jobs = Job::where('position', 'LIKE', '%' . $search . '%')
                ->orWhere('title', 'LIKE', '%' . $search . '%')
                ->orWhere('type', 'LIKE', '%' . $search . '%')
                ->orWhere('address', 'LIKE', '%' . $address . '%')
                ->paginate(10);

            return view('jobs.alljobs', compact('jobs'));
        }

        $position = $request->position;
        $type = $request->type;
        $category = $request->category_id;
        $address = $request->address;

        if ($position || $type || $category || $address) {

            $jobs = Job::where('position', 'LIKE', '%' . $position . '%')
                ->orWhere('type', $type)
                ->orWhere('category_id', $category)
                ->orWhere('address', $address)
                ->paginate(20);

            return view('jobs.alljobs', compact('jobs'));
        } else {
            $jobs = Job::latest()->paginate(10);
            return view('jobs.alljobs', compact('jobs'));
        }
    }

    public function searchJobs(Request $request)
    {
        $keyword = $request->keyword;
        $job = Job::where('title', 'like', '%' . $keyword . '%')
            ->orWhere('position', 'like', '%' . $keyword . '%')
            ->limit(5)->get();
        return response()->json($job);
    }
}
