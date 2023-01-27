<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\CompanyController;
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Website\CandidateController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Authentication
if (!app()->runningInConsole()) {
    Auth::routes(['verify' => setting('email_verification')]);
} else {
    Auth::routes(['verify' => false]);
}

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    // return 123;
    $request->fulfill();

    if (auth('user')->user()->role == 'company') {
        return redirect()->route('company.dashboard', ['verified' => true]);
    } else {
        return redirect()->route('candidate.dashboard', ['verified' => true]);
    }
})->middleware(['auth', 'signed'])->name('verification.verify');

// Guest Routes
Route::controller(WebsiteController::class)->name('website.')->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/plans', 'pricing')->name('plan');
    Route::get('/plans/{label}', 'planDetails')->name('plan.details');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/terms-condition', 'termsCondition')->name('termsCondition');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacyPolicy');
    Route::get('/coming-soon', 'comingSoon')->name('comingsoon');
    Route::get('/jobs', 'jobs')->name('job');
    Route::get('/jobs/{job:slug}', 'jobDetails')->name('job.details');
    Route::get('/jobs/{job:slug}/bookmark', 'toggleBookmarkJob')->name('job.bookmark');
    Route::post('/jobs/apply', 'toggleApplyJob')->name('job.apply');
    Route::get('/candidates', 'candidates')->name('candidate');
    Route::get('/candidates/{candidate:username}', 'candidateDetails')->name('candidate.details');
    Route::get('/candidate/profile/details', 'candidateProfileDetails')->name('candidate.profile.details');
    Route::get('/candidate/application/profile/details', 'candidateApplicationProfileDetails')->name('candidate.application.profile.details');
    Route::get('/candidates/download/cv/{resume}', 'candidateDownloadCv')->name('candidate.download.cv');
    Route::get('/employers', 'employees')->name('company');
    Route::get('/employers/{user:username}', 'employersDetails')->name('employe.details');
    Route::get('/posts', 'posts')->name('posts');
    Route::get('/post/{post:slug}', 'post')->name('post');
    Route::post('/comment/{post:slug}/add', 'comment')->name('comment');
    Route::post('/markasread/single/notification', 'markReadSingleNotification')->name('markread.notification');
    Route::post('/set/session', 'setSession')->name('set.session');
    Route::post('/set/current/location', 'setCurrentLocation')->name('set.current.location');
    Route::get('/selected/country', 'setSelectedCountry')->name('set.country');
    Route::get('/selected/country/remove', 'removeSelectedCountry')->name('remove.country');
    Route::get('job/autocomplete', 'jobAutocomplete')->name('job.autocomplete');
});

// Social Authentication
Route::get('/auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])
    ->where('provider', 'google|facebook|github|twitter|linkedin')->name('social.login');

Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'callback'])
    ->where('provider', 'google|facebook|github|twitter|linkedin');

// Authentiated Routes
Route::middleware('auth:user', 'verified')->group(function () {
    // Dashboard Route
    Route::get('/user/dashboard', [WebsiteController::class, 'dashboard'])->name('user.dashboard');

    Route::post('/user/notification/read', [WebsiteController::class, 'notificationRead'])->name('user.notification.read');

    // Candidate Routes
    Route::controller(CandidateController::class)->prefix('candidate')->middleware('candidate')->name('candidate.')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('applied-jobs', 'appliedjobs')->name('appliedjob');
        Route::get('bookmarks', 'bookmarks')->name('bookmark');
        Route::get('settings', 'setting')->name('setting');
        Route::put('settings/update', 'settingUpdate')->name('settingUpdate');
        Route::post('get/city', 'getCity')->name('getCity');
        Route::post('get/state', 'getState')->name('getState');
        Route::get('/all/notifications', 'allNotification')->name('allNotification');
        Route::get('/job/alerts', 'jobAlerts')->name('job.alerts');
        Route::post('/resume/store', 'resumeStore')->name('resume.store');
        Route::post('/resume/update', 'resumeUpdate')->name('resume.update');
        Route::delete('/resume/delete/{resume}', 'resumeDelete')->name('resume.delete');
    });

    // Company Routes
    Route::controller(CompanyController::class)->prefix('company')->middleware('company')->group(function () {
        Route::middleware('company.profile')->group(function () {
            Route::get('dashboard', 'dashboard')->name('company.dashboard');
            Route::get('plans', 'plan')->name('company.plan');
            Route::post('download/transaction/invoice/{transaction}', 'downloadTransactionInvoice')->name('company.transaction.invoice.download');
            Route::get('my-jobs', 'myjobs')->name('company.myjob');
            Route::get('create/job', 'createJob')->name('company.job.create')->middleware('check_plan');
            Route::post('/store/job', 'storeJob')->name('company.job.store')->middleware('check_plan');
            Route::get('/promote/job/{job:slug}', 'showPromoteJob')->name('company.job.promote.show');
            Route::get('/promote/{job:slug}', 'jobPromote')->name('company.promote');
            Route::get('/clone/{job:slug}', 'jobClone')->name('company.clone');
            Route::post('/promote/job/{jobCreated}', 'promoteJob')->name('company.job.promote');
            Route::get('edit/{job:slug}/job', 'editJob')->name('company.job.edit');
            Route::post('make/job/expire/{job}', 'makeJobExpire')->name('company.job.make.expire');
            Route::put('/update/{job:slug}/job', 'updateJob')->name('company.job.update');
            Route::get('job/applications', 'jobApplications')->name('company.job.application');
            Route::put('applications/sync', 'applicationsSync')->name('company.application.sync');
            Route::post('applications/column/store', 'applicationColumnStore')->name('company.applications.column.store');
            Route::delete('applications/group/delete/{group}', 'applicationColumnDelete')->name('company.applications.column.delete');
            Route::put('applications/group/update', 'applicationColumnUpdate')->name('company.applications.column.update');
            Route::delete('delete/{job:id}/application', 'destroyApplication')->name('company.application.delete');
            Route::get('bookmarks', 'bookmarks')->name('company.bookmark');
            Route::get('settings', 'setting')->name('company.setting');
            Route::put('settings/update', 'settingUpdateInformaton')->name('company.settingUpdateInformaton');
            Route::get('/all/notifications', 'allNotification')->name('company.allNotification');
            Route::put('settings/update/contactinfo', 'settingUpdateContactInformaton')->name('company.settingUpdateContactInformaton');
            Route::put('settings/update/socialmedia', 'settingUpdateSocialMedia')->name('company.settingUpdateSocialMedia');
            // ====== appication group =======
            Route::post('applications/group/store', 'applicationsGroupStore')->name('company.applications.group.store');
            Route::put('applications/group/update/{group}', 'applicationsGroupUpdate')->name('company.applications.group.update');
            Route::delete('applications/group/destroy/{group}', 'applicationsGroupDestroy')->name('company.applications.group.destroy');
            // ====== appication group End=======
        });

        Route::post('/settings/statelist', 'getStateList')->name('company.getStateByCountry');
        Route::post('/settings/citylist', 'getCityList')->name('company.getCityByCountry');

        Route::post('/company/bookmark/{candidate}', 'companyBookmarkCandidate')->name('company.companybookmarkcandidate');
        Route::get('account-progress', 'accountProgress')->name('company.account-progress');
        Route::put('/profile/complete/{id}', 'profileCompleteProgress')->name('company.profile.complete');
        Route::get('/bookmark/categories', 'bookmarkCategories')->name('company.bookmark.category.index');
        Route::post('/bookmark/categories/store', 'bookmarkCategoriesStore')->name('company.bookmark.category.store');
        Route::get('/bookmark/categories/edit/{category}', 'bookmarkCategoriesEdit')->name('company.bookmark.category.edit');
        Route::put('/bookmark/categories/update/{category}', 'bookmarkCategoriesUpdate')->name('company.bookmark.category.update');
        Route::delete('/bookmark/categories/destroy/{category}', 'bookmarkCategoriesDestroy')->name('company.bookmark.category.destroy');
        Route::post('send-email', 'sendEmailCandidate')->name('company.send.email');
    });
});

Route::get('/lang/{lang}', function ($lang) {
    session()->put('set_lang', $lang);
    app()->setLocale($lang);

    return back();
});
