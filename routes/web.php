<?php

use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Marketplace\AuthController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Jobportal\AuthController as JobportalLogin;
use App\Http\Controllers\Jobportal\JobController;
use App\Http\Controllers\Jobportal\CompnyDetailController;

use App\Http\Controllers\Marketplace\HomeController;
use App\Http\Controllers\Marketplace\InvoiceSettingsController;
use App\Http\Controllers\Marketplace\ProfileController;
use App\Http\Controllers\Marketplace\ProjectController;
use App\Http\Controllers\Marketplace\MilestoneController;

use App\Http\Controllers\Frontend\HomepageController;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\BuildResumeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Jobportal\CandidateController;
use App\Http\Controllers\JobportalNotificationController;
use App\Http\Controllers\JobpreferenceController;
use App\Http\Controllers\MarketplaceMessageController;
use App\Http\Middleware\JobportalAuth;

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return back()->with('success', 'All type of cache cleared');
});

Route::get('/welcome-animation', function () {
    return view('welcome-animation');
})->name('welcome.animation')->middleware('auth');

// User Dashboard
Route::get('/', function () {
    return view('marketplace.index');
})->middleware('check.role:user');


// Client Dashboard
Route::get('/', function () {
    return view('marketplace.index');
})->middleware('check.role:client');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login_check');
Route::post('/user/logout-window', [AuthController::class, 'logoutWindow'])->name('user.logout-window');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register/store', [AuthController::class, 'storeRegister'])->name('register-store');

// Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/User/Client', [AuthController::class, 'showUserClient'])->name('user_client');
Route::get('/Client/Details/{id}', [AuthController::class, 'showClientDetails'])->name('client_details');
Route::post('/Client/Details/Store', [AuthController::class, 'storeClientDetails'])->name('client_details-store');
Route::get('/User/Details/{id}', [AuthController::class, 'showUserDetails'])->name('user_details');
Route::post('/User/Details/Store', [AuthController::class, 'storeUserDetails'])->name('user_details-store');
Route::post('/marketplace/subindustry', [AuthController::class, 'getSubIndustry']);
Route::get('/search-skills', [AuthController::class, 'searchSkills']);
Route::get('/search-project-skills', [AuthController::class, 'searchProjectSkills']);


Route::get('forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('verify-otp', [AuthController::class, 'showOtpForm'])->name('verify.otp.get');
Route::post('verify-otp', [AuthController::class, 'submitOtpForm'])->name('verify.otp.post');
Route::post('resend-otp', [AuthController::class, 'resendOtp'])->name('otp.resend');
Route::post('/password/update', [AuthController::class, 'updatePassword'])->name('password.update');


Route::middleware(['auth', 'switch_language'])->group(function () {

    Route::get('/', [HomeController::class, 'root'])->name('All.project');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('marketplace.logout');

    Route::get('/profile/{id}', [ProfileController::class, 'create'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'store'])->name('profile.store');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/delete/{id}', [ProfileController::class, 'destroy'])->name('profile.delete');
    Route::post('/storePortfolio', [ProfileController::class, 'storePortfolio'])->name('storePortfolio');
    Route::post('/experience/store', [ProfileController::class, 'storeExperience'])->name('experience.store');

    Route::get('/projects/filter', [HomeController::class, 'filter'])->name('projects.filter');
    Route::get('/project/details/{id}', [HomeController::class, 'projectDetails'])->name('project-details');
    Route::get('/bookmarked/project/{id}', [HomeController::class, 'bookmarkedProject'])->name('bookmarked-project');

    Route::get('/users/filter', [HomeController::class, 'userFilter'])->name('users.filter');
    Route::get('/search-user/skills', [HomeController::class, 'userSearch'])->name('user-search.skills');
    Route::post('/user-selected-skills', [HomeController::class, 'userSelectedSkills'])->name('user.selected.skills');
    /*---Invoice Setting End-- */

    /*----------------project store---------------------*/
    Route::get('/project', [ProjectController::class, 'show'])->name('project.show');
    Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store');
    Route::get('/search-project/skills', [HomeController::class, 'search'])->name('search.skills');
    Route::post('/store-selected-skills', [HomeController::class, 'storeSelectedSkills'])->name('store.selected.skills');


    // ------------------------------Chat Route------------------------------------
    Route::get('/marketplace/chat', [MarketplaceMessageController::class, 'userlist'])->name('marketplace.chat');
    Route::get('/marketplace/chat/user', [MarketplaceMessageController::class, 'index']);
    Route::get('/marketplace/chat/{userId}', [MarketplaceMessageController::class, 'chat'])->name('marketplace.chat.user_id');
    Route::post('/marketplace/chat/mark-seen', [MarketplaceMessageController::class, 'markSeen']);
    Route::post('/marketplace/chat/send', [MarketplaceMessageController::class, 'sendMessage']);
    Route::get('/marketplace/chat/messages/{userId}', [MarketplaceMessageController::class, 'getMessages']);
    // ---------------------------------Chat Route------------------------------------

    // ----------------------------------------- Invoice -------------------------------------------
    Route::get('/invoices/create', [InvoiceSettingsController::class, 'create'])->name('invoices.create');
    Route::get('/invoices/pdf', [InvoiceSettingsController::class, 'pdfView'])->name('invoices.pdf');
    Route::post('/invoices', [InvoiceSettingsController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/download/{id}', [InvoiceSettingsController::class, 'download'])->name('invoices.download');
    // ----------------------------------------- Invoice -------------------------------------------

    // ----------------------------------------- Wallet -------------------------------------------
    Route::get('/wallet', [HomeController::class, 'showWallet'])->name('wallet.show');

    // ----------------------------------------- Bid -------------------------------------------
    Route::post('/storeBid/{id}', [ProjectController::class, 'storeBid'])->name('storeBid');
    Route::post('/editBid/{id}', [ProjectController::class, 'editBid'])->name('bid.edit');
    Route::get('/assignProject/{pId}/{uId}', [ProjectController::class, 'assignProject'])->name('assignProject');


    Route::get('/bid/{id}', [HomeController::class, 'showBid'])->name('bid.show');
    Route::get('/proposal', [HomeController::class, 'userBid'])->name('bid.proposal');

    // ----------------------------------------- Bookmark -------------------------------------------
    Route::post('/storeBookmark/{id}', [ProjectController::class, 'storeBookmark'])->name('storeBookmark');

    // ----------------------------------------- Chat -------------------------------------------
    Route::get('chats', [MarketplaceMessageController::class, 'index'])->name('chats.index');
    Route::post('chats/send', [MarketplaceMessageController::class, 'sendMessage'])->name('chats.sendMessage');
    Route::post('chats/setReceiver', [MarketplaceMessageController::class, 'setReceiver'])->name('chats.setReceiver');
    Route::get('chats/fetch-messages', [MarketplaceMessageController::class, 'fetchMessages'])->name('chats.fetchMessages');

    // ----------------------------------------- Assign -------------------------------------------
    Route::get('/Review', [HomeController::class, 'showReview'])->name('review.show');
    Route::get('/Accept/Proposal', [HomeController::class, 'acceptProposal'])->name('Accept.Proposal');
    Route::post('/bank-accounts', [HomeController::class, 'storeBankDetails'])->name('bank_accounts.store');

    // ----------------------------------------- Review -------------------------------------------
    Route::get('/Rating', [HomeController::class, 'rating'])->name('rating.show');

    // ----------------------------------------- Milestone -------------------------------------------
    Route::get('/projects/milestones/{id}', [MilestoneController::class, 'index'])->name('milestones.index');
    Route::get('/projects/{projectId}/milestones/create', [MilestoneController::class, 'create'])->name('milestones.create');
    Route::post('/projects/{projectId}/milestones/store', [MilestoneController::class, 'store'])->name('milestones.store');
});

// --------------------------------------------------------------------------------------------------------------
// --------------------------------Job Portal Routes Start ------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------

/*---Currency Controller Code start--*/
Route::get('/currency', [CurrencyController::class, 'show'])->name('currency.show');
Route::post('/currency', [CurrencyController::class, 'store'])->name('currency.store');
Route::post('/currency/exchange', [CurrencyController::class, 'exchangestore'])->name('exchange.store');
Route::delete('/currency/{id}/delete', [CurrencyController::class, 'destroy'])->name('currency.destroy');
Route::put('/currency/{id}', [CurrencyController::class, 'update'])->name('currency.update');
Route::get('currency/update-status', [CurrencyController::class, 'updateStatus']);
Route::get('/currency/{symbol}', [CurrencyController::class, 'currencySwitch'])->name('currencySwitch');
Route::post('currency/update-currency', [CurrencyController::class, 'update_currency'])->name('update_currency');
/*---Currency Controller Code end--*/
Route::get('/changelangouage/{code}', function ($code) {
    Session::put('changed_language', $code);
    return back()->with('success', 'Language Changed Successfully');
})->name('lang.switch');

Route::get('/changecurrency/{code}', function ($code) {
    Session::put('changed_currency', $code);
    $currency = DB::table('currencies')->where('code', $code)->first();
    Session::put('changed_currency_symbol', $currency->symbol);
    return back()->with('success', 'Currency Changed Successfully');
})->name('currency.switch');

Route::prefix('jobportal')->group(function () {
    Route::get('/alljobs', [JobController::class, 'jobFront'])->name('jobportal.frontjob');
    Route::get('login', [JobportalLogin::class, 'login'])->name('jobportal.login');
    Route::post('checkotp', [JobportalLogin::class, 'checkotp'])->name('jobportal.checkotp');
    Route::match(['post', 'get'], 'login/checkmail', [JobportalLogin::class, 'checkemail'])->name('jobportal.checkemail');
    Route::get('login/{email}', [JobportalLogin::class, 'password'])->name('jobportal.password');
    Route::get('register/{email}', [JobportalLogin::class, 'otp'])->name('jobportal.otp');
    Route::post('login', [JobportalLogin::class, 'dologin'])->name('jobportal.dologin');
    Route::get('jobs/{id}', [JobController::class, 'view'])->name('jobportal.job.view');
    Route::middleware(['jobportal.auth', 'switch_language'])->group(function () {
        Route::post('check/notification', [JobportalNotificationController::class, 'index']);
        Route::post('read/notification', [JobportalNotificationController::class, 'read']);
        Route::post('clear/notification', [JobportalNotificationController::class, 'clear']);
        Route::get('/', [JobportalLogin::class, 'login']);
        Route::get('dashboard', function () {
            return view('jobportal.dashboard.index');
        })->name('jobportal.dashboard');



        // ------------------------------Chat Route------------------------------------
        Route::get('/chat', [ChatController::class, 'userlist'])->name('chat');
        Route::get('/chat/user', [ChatController::class, 'index']);
        Route::get('/chat/userlist', [ChatController::class, 'userlistuser'])->name('user.chat');
        Route::get('/chat/{userId}', [ChatController::class, 'chat'])->name('chat.user_id');
        Route::get('/chat/user/{userId}', [ChatController::class, 'userChat'])->name('user.chat.user_id');
        Route::post('/chat/mark-seen', [ChatController::class, 'markSeen']);
        Route::post('/chat/send', [ChatController::class, 'sendMessage']);
        Route::get('/chat/messages/{userId}', [ChatController::class, 'getMessages']);
        // ---------------------------------Chat Route------------------------------------

        // --------------------------------Jobs Route------------------------------------
        Route::get('jobs', [JobController::class, 'index'])->name('jobportal.jobs');
        Route::get('/jobcreate', [JobController::class, 'create'])->name('jobportal.job_create');
        Route::get('/job/{id}/preference', [JobController::class, 'preference'])->name('jobportal.job_preference');
        Route::post('/update-job-details', [JobController::class, 'jobupdate'])->name('jobportal.jobupdate');
        Route::post('/job/preference/store', [JobController::class, 'savepreferences'])->name('jobportal.savepreferences');
        Route::get('/job/{id}/edit', [JobController::class, 'edit'])->name('jobportal.job_edit');
        Route::get('/job/{id}/review', [JobController::class, 'review'])->name('jobportal.job_review');
        Route::get('/job/{id}/sponser', [JobController::class, 'sponser'])->name('jobportal.job_sponser');
        Route::post('/job/sponser', [JobController::class, 'sponserstore'])->name('job_sponser');
        Route::get('/job/{id}/payment', [JobController::class, 'payment'])->name('payment.page');
        Route::get('/job/{id}/skills', [JobController::class, 'skills'])->name('jobportal.job_skill');
        Route::get('/state/country', [JobController::class, 'get_state_country'])->name('get.state.country');
        Route::get('/job/{id}/prescreen', [JobController::class, 'precsreen'])->name('jobportal.job_precsreen');
        Route::post('/job/prescreen', [JobController::class, 'precsreensave'])->name('jobportal.job_precsreensave');
        Route::post('/job/skills/store', [JobController::class, 'addskill'])->name('jobportal.job_skill_store');
        Route::post('/job/store', [JobController::class, 'store'])->name('jobportal.jobstore');
        Route::get('job/{id}/apply/contact-info', [JobController::class, 'contactinfo'])->name('jobportal.contact-info');
        Route::post('job/{id}/updateinfo', [JobController::class, 'updateinfo'])->name('jobportal.updateinfo');
        Route::get('job/{id}/user/preview/', [JobController::class, 'resume'])->name('jobportal.resume');
        Route::post('job/{id}/resume/', [JobController::class, 'resumeupload'])->name('jobportal.resumeupload');
        Route::post('job/apply', [JobController::class, 'applyJob'])->name('apply.job');
        Route::post('emp/job/filter', [JobController::class, 'empJobFilter']);
        Route::match(['get', 'post'], 'savejob', [JobController::class, 'saveJob']);
        Route::match(['get', 'post'], 'notintrested', [JobController::class, 'notintrested']);
        Route::post('myjob/filter', [JobController::class, 'saveJobFilter']);
        Route::post('myjob/status', [JobController::class, 'myjobstatus']);
        Route::post('search-jobs', [JobController::class, 'searchJobs']);
        Route::get('/prescreentest/{id}', [JobController::class, 'prescreentest'])->name('prescreentest');
        Route::post('/prescreentest/{id}/save', [JobController::class, 'prescreentestsave'])->name('prescreentest.save');
        // --------------------------------Jobs Route------------------------------------

        // --------------------------------Resume Route----------------------------------
        Route::get('build/resume', [BuildResumeController::class, 'create'])->name('jobportal.build_resume');
        Route::post('build/resume', [BuildResumeController::class, 'store'])->name('jobportal.build_resume.store');
        Route::get('resume/{id}/preview', [BuildResumeController::class, 'preview'])->name('jobportal.build_resume.preview');
        Route::post('resume/personalinfo', [BuildResumeController::class, 'personalInformation'])->name('resume.personalinfo');
        Route::post('resume/deletepersonalinfo', [BuildResumeController::class, 'personalInformationDelete'])->name('resume.deletepersonalinfo');
        Route::post('resume/contactinfo', [BuildResumeController::class, 'contactInformation'])->name('resume.contactinfo');
        Route::post('resume/summary', [BuildResumeController::class, 'summary'])->name('resume.summary');
        Route::post('resume/experience/create', [BuildResumeController::class, 'experiencecreate'])->name('create.experience');
        Route::post('resume/experience/update', [BuildResumeController::class, 'experienceUpdate'])->name('edit.experience');
        Route::get('resume/experience/delete/{id}', [BuildResumeController::class, 'experienceDelete'])->name('delete.experience');
        Route::post('resume/education/update', [BuildResumeController::class, 'updateEducation'])->name('edit.education');
        Route::post('resume/education/create', [BuildResumeController::class, 'createEducation'])->name('create.education');
        Route::get('resume/education/delete/{id}', [BuildResumeController::class, 'deleteEducation'])->name('delete.education');
        Route::get('resume/certificate/delete/{id}', [BuildResumeController::class, 'deleteCertificate'])->name('delete.certificate');
        Route::get('resume/skill/delete/{id}', [BuildResumeController::class, 'deleteSkills'])->name('delete.skills');
        Route::post('resume/skill/create', [BuildResumeController::class, 'addSkills'])->name('create.skills');
        Route::post('resume/certificate/create', [BuildResumeController::class, 'addCretificate'])->name('create.certificate');
        Route::get('searchable', [JobportalLogin::class, 'searchable'])->name('searchable');
        Route::post('searchable/update', [BuildResumeController::class, 'searchableUpdate'])->name('update.searchabe');
        Route::get('jobprefrences', [JobpreferenceController::class, 'index'])->name('jobpreferences');
        Route::post('jobprefrences/store', [JobpreferenceController::class, 'store'])->name('jobpreferences.store');
        Route::post('getcities', [JobpreferenceController::class, 'getCities']);
        Route::post('/resume/type', [BuildResumeController::class, 'resumeType'])->name('resume.type');
        Route::post('/resume/coverletter', [BuildResumeController::class, 'coverLatter'])->name('cover.letter');
        // --------------------------------Resume Route----------------------------------

        // --------------------------------Candidate Route ------------------------------
        Route::get('candidates', [CandidateController::class, 'index'])->name('job.candidate');
        Route::post('/candidate/filter', [CandidateController::class, 'filter']);
        Route::post('/candidate/shortlisted', [CandidateController::class, 'shortlisted']);
        Route::post('/candidate/{id}', [CandidateController::class, 'shortlisted']);
        Route::get('/candidate/{id}/profile', [CandidateController::class, 'candidateProfile'])->name('candidate.profile');
        Route::post('setupinterview', [CandidateController::class, 'sertupInterview']);
        Route::get('interview', [CandidateController::class, 'interview'])->name('interview');
        Route::post('gethired', [CandidateController::class, 'getHired']);
        Route::get('download/resume/{id}', [CandidateController::class, 'download'])->name('download.resume');
        Route::get('myjob', [CandidateController::class, 'myjobs'])->name('myjobs');
        Route::post('interview/filter', [CandidateController::class, 'interviewFilter']);
        // --------------------------------Candidate Route ------------------------------

        // --------------------------------Company Route---------------------------------
        Route::get('company/register', [CompnyDetailController::class, 'index'])->name('jobportal.company.register');
        Route::post('company/save', [CompnyDetailController::class, 'store'])->name('savecompanydetails');
        Route::post('/subindustry', [CompnyDetailController::class, 'getSubcategory']);
        // --------------------------------Company Route----------------------------------

        Route::post('/jobstatus/update', [JobController::class, 'statusUpdate']);
        Route::get('/billing', function () {
            return view('jobportal.billing.index');
        })->name('jobportal.billing');
        Route::get('/profile', [JobportalLogin::class, 'profile'])->name('jobportal.profile');
        Route::post('/saveProfile', [JobportalLogin::class, 'saveProfile'])->name('jobportal.saveProfile');

        // ---------------------------Logout---------------------------
        Route::get('logout', [JobportalLogin::class, 'logout'])->name('jobportal.logout');
    });
});

// --------------------------------------------------------------------------------------------------------------
// --------------------------------Job Portal Routes End ------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------

// --------------------------------------------------------------------------------------------------------------
// -------------------------------------Admin Routes Start ------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------

// ===========================frontend routes start============================//
Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');

Route::get('/blog/detail', function () {
    return view('frontend.blog.detailblog');
})->name('blog.detail');

Route::get('/becomeaseller', function () {
    return view('frontend.becomeaseller.becomeaseller');
})->name('becomeaseller');

Route::get('/about', function () {
    return view('frontend.about.about');
})->name('about');

Route::get('/jobs', function () {
    return view('frontend.jobs.jobs');
})->name('jobs');

Route::get('/help&support', function () {
    return view('frontend.help&support.help&support');
})->name('help&support');

Route::get('/faq', function () {
    return view('frontend.faq.jobfaq');
})->name('faq');

Route::get('/termsandcondition', function () {
    return view('frontend.conditions.terms');
})->name('termsandcondition');

Route::get('/privacypolicy', function () {
    return view('frontend.conditions.privacypolicy');
})->name('privacypolicy');

Route::get('/development', function () {
    return view('frontend.marketplace.development');
})->name('development-it');
// ===========================frontend routes end===============================//

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
