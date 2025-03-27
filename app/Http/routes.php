<?php


use Illuminate\Support\Facades\Artisan;


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function() {
//   echo "hi";  // return redirect('admin');
// });

// Route::auth();
Route::get('/', 'HomeController@starttest')->name('/');
Route::get('/newtest', 'HomeController@newTest')->name('/new');
Route::post('/enter', 'HomeController@entertest');
Route::get('/test/{id}', 'HomeController@testInstructions');
Route::get('/oldtest', 'HomeController@entertest');
// Route::get('/home', 'HomeController@index');
// Route::get('/instructions/{id}','HomeController@testInstructions');
Route::get('/user-details/{id}', 'HomeController@userDetailsForm');
Route::any('/saveuser/{id}', 'HomeController@storeUserDetails');
Route::get('/apt-form/{id}', 'HomeController@aptitudeForm');
Route::post('/save-answers/{id}', 'HomeController@saveUserAnswers');
Route::get('/logout', 'HomeController@logout')->name('logout');
Route::get('/results/{id}', 'HomeController@results');
Route::get('already-submitted', 'HomeController@alreadySubmitted');
Route::get('date-error/{id}', 'HomeController@testInstructions');

/**Routes for Admin */

Route::get('admin', 'AdminController@showLoginForm');
Route::post('login', 'AdminController@login');
Route::get('campus-reports', 'AdminController@showCampusReports');
Route::get('user-reports/{id}', 'AdminController@showUserReports');
Route::get('user-view/{id}', 'AdminController@showUserDetailView');
// Route::post('delete-user', 'AdminController@deleteUser');
Route::post('delete-report', 'AdminController@deleteReport');
Route::get('forgot-pwd', 'AdminController@showForgotUserForm');
Route::post('forgot-pwd', 'AdminController@forget_password');
Route::post('update-results', 'AdminController@update_result');

Route::get('dashboard', 'AdminController@dashboard');
Route::get('questions', 'QuestionsController@listQuestions');
Route::get('add-question', 'QuestionsController@create');
Route::post('add-question', 'QuestionsController@store');
Route::get('add-parent-question', 'QuestionsController@create_parent_questions');
Route::post('add-parent-question', 'QuestionsController@store_parent_questions');
Route::get('add-sub-question', 'QuestionsController@create_sub_questions');
Route::post('add-sub-question', 'QuestionsController@store_sub_questions');
Route::get('edit-question/{id}', 'QuestionsController@edit');
Route::post('edit-question/{id}', 'QuestionsController@update');
Route::post('delete-question', 'QuestionsController@deleteQuestions');

Route::get('sections', 'SectionController@index');
Route::get('add-section', 'SectionController@create');
Route::post('add-section', 'SectionController@store');
Route::get('edit-section/{id}', 'SectionController@edit');
Route::post('edit-section/{id}', 'SectionController@update');
Route::post('delete-section', 'SectionController@delete');

Route::get('level', 'QuestionLevelController@index');
Route::get('add-level', 'QuestionLevelController@create');
Route::post('add-level', 'QuestionLevelController@store');
Route::get('edit-level/{id}', 'QuestionLevelController@edit');
Route::post('edit-level/{id}', 'QuestionLevelController@update');
Route::post('delete-level', 'QuestionLevelController@delete');

Route::get('users', 'UserController@index');
// Route::get('add-user', 'UserController@create');
// Route::post('add-user', 'UserController@store');
// Route::get('edit-user/{id}', 'UserController@edit');
// Route::post('edit-user/{id}', 'UserController@update');
Route::post('delete-user', 'UserController@delete');

Route::get('colleges', 'CollegeController@index');
Route::get('add-college', 'CollegeController@create');
Route::post('add-college', 'CollegeController@store');
Route::get('edit-college/{id}', 'CollegeController@edit');
Route::post('edit-college/{id}', 'CollegeController@update');
Route::post('delete-college', 'CollegeController@delete');

Route::get('campuses', 'CampusController@index');
Route::get('add-campus', 'CampusController@create');
Route::post('add-campus', 'CampusController@store');
Route::get('edit-campus/{id}', 'CampusController@edit');
Route::post('edit-campus/{id}', 'CampusController@update');
Route::post('delete-campus', 'CampusController@delete');
Route::post('groupques-count', 'CampusController@getCount');
Route::post('delete-campus-users', 'CampusController@deleteCampusUsers');
Route::post('delete-user-details', 'CampusController@deleteUserDetails');
//For predefined Questions
Route::get('predefined-questions', 'preQuestionsController@index');
Route::get('add-prequestions', 'preQuestionsController@create');
Route::post('add-prequestions', 'preQuestionsController@store');
Route::get('edit-prequestions/{id}', 'preQuestionsController@edit');
Route::post('edit-prequestions/{id}', 'preQuestionsController@update');
Route::post('delete-prequestions', 'preQuestionsController@delete');
//File upload Route

Route::any('/upload', 'QuestionsController@upload')->name('upload');

//Show parent Question Ajax

Route::any('show-parent', 'QuestionsController@showParent');


Route::get('/clear-app-cache', function() {
    Artisan::call('cache:clear');
    return "Application cache cleared!";
});

Route::get('/clear-config', function() {
    \Artisan::call('config:clear');
    return "Configuration cache cleared!";
});

Route::get('/cache-config', function() {
    \Artisan::call('config:cache');
    return "Configuration cache rebuilt!";
});

Route::get('/clear-route-cache', function() {
    \Artisan::call('route:clear');
    return "Route cache cleared!";
});

Route::get('/clear-view-cache', function() {
    \Artisan::call('view:clear');
    return "View cache cleared!";
});

Route::get('/clear-compiled', function() {
    \Artisan::call('clear-compiled');
    return "Compiled classes cache cleared!";
});


Route::get('/generate-key', 'KeyGenerateController@showForm');
Route::post('/generate-key', 'KeyGenerateController@generateKey');



Route::get('/test', function() {
    return "Hello, this is a test response!";
});