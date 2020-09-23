<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//guest Routes
Route::group(['middleware' => ['guest']], function () {
    // Guest routes
    // Route::get('/', function()
    // {
    //     return View::make('homepage');
    // });
    //  Route::get('/signup', function()
    // {
    //     return View::make('register');
    // });
    Route::get('/', 'SiteController@index')->name('homepage');
    Route::get('/signup', 'SignupController@index')->name('signup');
    Route::post('/signup', 'SignupController@create')->name('signup.create');
    Route::get('/verification', 'SignupController@load')->name('verifying.load');

    Route::get('/verification/verifyme/{email}/{key}', 'SignupController@verifyme')->name('verify.me');

    Route::get('/signin', 'SigninController@index')->name('signin.index');
    Route::post('/signin', 'SigninController@checkLogin')->name('signin.validate');
    Route::get('/signin/emailverify', 'SigninController@unverifiedCandidate')->name('signin.emailverify');

    
});

Auth::routes();

/************************** After login routes **********************************************************/
//candidate
Route::group(['middleware' => ['verify.candidate']], function () {
    Route::get('/candidate/dashboard', 'CandidateController@candidateDashboard')->name('cand.dashboard');

    Route::get('/candidate/profile', 'CandidateController@showcandidateProfile')->name('cand.profile');
    Route::post('/candidate/store', 'CandidateController@store')->name('cand.store');

    Route::get('/candidate/edit', 'CandidateController@editCandidate')->name('cand.edit');
    // Route::get('/candidate/apply/position/{postjob_id}', 'SiteController@applyfor')->name('cand.apply');

    Route::get('/candidate/apply/position/{postjob_id}/{postwage_id?}', 'SiteController@listRanks')->name('cand.apply');
    Route::post('/candidate/save/rank', 'SiteController@saveRank')->name('save.rank');

    Route::get('/candidate/apply/list', 'CandidateController@candidateJobApplyList')->name('cand.applylist');

    //endorsment docs------------------------
    Route::get('/candidate/endorsment/uploads', 'CandidateController@endorsementDocuments')->name('endorsment.docs');

    Route::post('/candidate/endorsment/save', 'CandidateController@endorsDocsSubmit')->name('endorsment.save');
    Route::post('/candidate/traveldoc/save', 'CandidateController@travelDocsSubmit')->name('traveldoc.save');
    Route::post('/candidate/medicaldoc/save', 'CandidateController@medicalDocsSubmit')->name('medicaldoc.save');
    Route::post('/candidate/skilTraining/save', 'CandidateController@skilTrainingDocsSubmit')->name('skilldoc.save');
    Route::post('/candidate/personal/save', 'CandidateController@personalDocsSubmit')->name('personaldoc.save');
    Route::post('/candidate/cocdoc/save', 'CandidateController@cocDocsSubmit')->name('cocDocs.save');

    Route::post('/candidate/stcwdoc/save', 'CandidateController@stcwDocsSubmit')->name('stcwdoc.save');
    Route::post('/candidate/Offshoredoc/save', 'CandidateController@OffshoreDocsSubmit')->name('Offshoredoc.save');
    Route::post('/candidate/yachtdoc/save', 'CandidateController@yachtDocsSubmit')->name('yachtdoc.save');
    Route::post('/candidate/anyotherdoc/save', 'CandidateController@anyOtherDocsSubmit')->name('anyotherdoc.save');
    //----------End endorsment docs------------------------
});

//employer
// Route::group(['middleware' => ['verify.employer']], function () {
    //employer
    Route::get('/employer/dashboard', 'EmployerController@index')->name('employer.dashboard');
    Route::post('/employer/picture', 'EmployerController@profilepicupdate')->name('employer.image');

    Route::get('/employer/profile', 'EmployerController@profileCreate')->name('employer.profile');
    Route::post('/employer/profile/store', 'EmployerController@storeEmployer')->name('employer.store');
    Route::get('/employer/edit', 'EmployerController@editEmployer')->name('employer.edit');
    //apllication list of candidate
    Route::get('/employer/application/listing', 'EmployerController@applyByCandidateList')->name('lists.appliedjob');
    //change application status
    Route::post('/employer/application/changeStatus', 'EmployerController@changeApplicationStatusByEmp')->name('change.applicationStatus');



    Route::get('/employer/postajob', 'PostjobController@index')->name('postjob.index');
    Route::post('/employer/postajob/store', 'PostjobController@store')->name('postjob.store');

    Route::get('/employer/postajob/listing', 'PostjobController@postjobListing')->name('postjob.listing');
    Route::get('/employer/postajob/edit/{id}', 'PostjobController@edit')->name('postjob.edit');
    Route::post('/employer/postajob/update/{id}', 'PostjobController@postjobUpdate')->name('postjob.update');
    Route::get('/employer/postajob/delete/{id}/{employer_id}', 'PostjobController@deleteJobs')->name('postjob.delete');



    //deatils view for candidate 
    Route::get('/postajob/details/{id}', 'SiteController@jobDeatils')->name('postjob.details');

    //socialite 
    // Route::get('signin/facebook', 'SigninController@redirectToProvider')->name('fb.redirect');
    // Route::get('signin/facebook/callback', 'SigninController@handleProviderCallback');
    Route::get('signin/{provider}', 'SigninController@redirectToProvider')->name('fb.redirect');
    Route::get('signin/{provider}/callback', 'SigninController@handleProviderCallback');


    Route::get('signin/usertype', 'SigninController@socialLogin')->name('social.login');

    //Ajax call
    Route::post('/candidate/apply/rank/details', 'AjaxController@getPosthJobID')->name('job.data');
    Route::post('/candidate/apply/rank/potion/details', 'AjaxController@getPosthJobID')->name('jobposition.applylist');

    //show employer to candidate details
    Route::get('/employer/applyied/candidate/details/{id}', 'EmployerController@viewCandidateDetails')->name('cand.details');


    Route::get('/employer/applyied/postjob/details/{id}', 'EmployerController@postjobDetailView')->name('postjob.detailsview');

    Route::get('/employer/download/resume/{id}', 'EmployerController@downloadResume')->name('download.resume');
 // });
    //job menu item1
    Route::get('/job/joblist/companywise/', 'PostjobController@companyWiseJoblist')->name('joblist.companywise');
    Route::get('/job/joblist/companywise/filter', 'PostjobController@companyWiseJoblistFilter')->name('joblist.companyfilter');

    //job menu item2
    // Route::get('/job/browse/joblist/', 'PostjobController@browseJoblist')->name('joblist.browse');
    Route::get('/job/browse/joblist/{company_name?}/{city?}/','PostjobController@browseJoblist')->name('joblist.browse');
    Route::get('/job/browse/joblist/search/{company_name?}/{city?}/{rank_position?}/','PostjobController@browseJoblistFromHome')->name('homepage_serach');
    
    Route::post('/job/browse/joblist/rankfilter/{company_name?}/{city?}/{rank_position?}/{params?}','PostjobController@browseJoblistRankfilter')->where('params', '(.*)')->name('rank.filter');
    //contact Us
    Route::get('/contactus/', 'SiteController@contactusView')->name('contactus.load');