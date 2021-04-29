<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\EmployerRegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Auth route
Auth::routes(['verify' => true]);

// job Route
Route::get('/', [JobController::class, 'index'])->name('welcome');
Route::get('/jobs/{id}/{jobs}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::post('/jobs/store', [JobController::class, 'store'])->name('jobs.store');
Route::get('/jobs/my-jobs', [JobController::class, 'myJob'])->name('my.jobs');
Route::get('/job/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
Route::post('/jobs/{id}/update', [JobController::class, 'update'])->name('jobs.update');
Route::get('/jobs/applications', [JobController::class, 'applicant'])->name('jobs.applicant');
Route::get('/jobs/alljobs', [JobController::class, 'alljobs'])->name('alljobs');
Route::post('applications/{id}', [JobController::class, 'applyJob'])->name('apply');
Route::get('/jobs/search', [JobController::class, 'searchJobs']);




//Company Route
Route::get('/company/{id}/{company}', [CompanyController::class, 'index'])->name('company.index');
Route::get('/company/create', [CompanyController::class, 'create'])->name('company.view');
Route::post('/company/create', [CompanyController::class, 'store'])->name('company.store');
Route::post('/company/coverPhoto', [CompanyController::class, 'coverPhoto'])->name('cover.photo');
Route::post('/company/logo', [CompanyController::class, 'logo'])->name('company.logo');
Route::get('/companies', [CompanyController::class, 'company'])->name('company');

//User Profile
Route::get('user/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::post('user/profile/store', [ProfileController::class, 'store'])->name('profile.store');
Route::post('user/cover-letter', [ProfileController::class, 'coverletter'])->name('cover.letter');
Route::post('user/resume', [ProfileController::class, 'resume'])->name('resume');
Route::post('user/avatar', [ProfileController::class, 'avatar'])->name('avatar');

//Employer route
Route::view('employer/register', 'auth.employer-register')->name('employer.register');
Route::post('user/register', [EmployerRegisterController::class, 'employerRgister'])->name('emp.register');


//save and unsave jobs
Route::post('/save/{id}', [FavouriteController::class, 'saveJob']);
Route::post('/unsave/{id}', [FavouriteController::class, 'unSaveJob']);


// Category
Route::get('/category/{id}/jobs', [CategoryController::class, 'index'])->name('category.index');


// email alert job
Route::post('/jobs/email', [EmailController::class, 'send'])->name('mail');


//Admin
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('admin');
Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('post.create')->middleware('admin');
Route::post('/dashboard/store', [DashboardController::class, 'store'])->name('post.store')->middleware('admin');
Route::get('/dashboard/{id}/edit', [DashboardController::class, 'edit'])->name('post.edit')->middleware('admin');
Route::post('/dashboard/{id}/update', [DashboardController::class, 'update'])->name('post.update')->middleware('admin');
Route::post('/dashboard/{id}/destroy', [DashboardController::class, 'destroy'])->name('post.softdelete')->middleware('admin');
Route::post('/dashboard/{id}/forceDelete', [DashboardController::class, 'forceDelete'])->name('post.forceDelete')->middleware('admin');
Route::get('/dashboard/trash', [DashboardController::class, 'trash'])->name('post.trash')->middleware('admin');
Route::get('/dashboard/{id}/restore', [DashboardController::class, 'restore'])->name('post.restore')->middleware('admin');
Route::get('/dashboard/{id}/toggle', [DashboardController::class, 'toggle'])->name('post.toggle')->middleware('admin');
Route::get('/posts/{id}/slug', [DashboardController::class, 'show'])->name('post.show');
Route::get('/dashboard/jobs/', [DashboardController::class, 'getAllJobs'])->name('getAllJobs')->middleware('admin');
Route::get('/dashboard/{id}/jobs', [DashboardController::class, 'changeJobStatus'])->name('job.status')->middleware('admin');


// testimonial
Route::get('testimonial/', [TestimonialController::class, 'index'])->name('testimonial.index')->middleware('admin');
Route::get('testimonial/create', [TestimonialController::class, 'create'])->name('testimonial.create')->middleware('admin');
Route::post('testimonial/store', [TestimonialController::class, 'store'])->name('testimonial.store')->middleware('admin');
