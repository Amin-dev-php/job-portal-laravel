<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['employer', 'verified'], ['except' => array('index', 'company')]);
    }

    public function index($id, Company $company)
    {
        return view('company.index', compact('company'));
    }

    public function company()
    {
        $companies = Company::latest()->paginate(10);
        return view('company.company', compact('companies'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        // $validation = $request->validate([
        //     'address' => 'required',
        //     'phone_number' => 'required|min:10|numeric',
        //     'experience' => 'required|min:20',
        //     'bio' => 'required|min:20',

        // ]);

        $user_id = auth()->user()->id;
        Company::where('user_id', $user_id)->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'website' => $request->website,
            'slogan' => $request->slogan,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('message', 'Company Info Succesfully Updated!');
    }

    public function coverPhoto(Request $request)
    {

        $validation = $request->validate([
            'cover_photo' => 'required|mimes:png,jpeg,jpg|max:20000'
        ]);

        $user_id = auth()->user()->id;
        if (isset(Auth::user()->company->cover_photo)) {
            // path stored file cover-letter in directory storage
            $path = 'upload/cover-photo/' . Auth::user()->profile->avatar;
            $path = public_path($path);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        if ($request->hasFile('cover_photo')) {
            $file = $request->file('cover_photo');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('upload/cover-photo/', $fileName);

            Company::where('user_id', $user_id)->update([
                'cover_photo' => $fileName,
            ]);
            return redirect()->back()->with('message', 'Cover Photo Succesfully Updated!');
        }
    }


    public function logo(Request $request)
    {

        $validation = $request->validate([
            'logo' => 'required|mimes:png,jpeg,jpg|max:20000'
        ]);

        $user_id = auth()->user()->id;
        if (isset(Auth::user()->company->logo)) {
            // path stored file cover-letter in directory storage
            $path = 'upload/company-logo/' . Auth::user()->profile->avatar;
            $path = public_path($path);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('upload/company-logo/', $fileName);

            Company::where('user_id', $user_id)->update([
                'logo' => $fileName,
            ]);
            return redirect()->back()->with('message', 'Company logo Succesfully Updated!');
        }
    }
}
