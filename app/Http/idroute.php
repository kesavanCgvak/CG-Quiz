<?php

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

// Route::auth();
Route::get('/{id}', 'HomeController@testInfo');
Route::get('/home', 'HomeController@index');
Route::get('/instructions/{id}','HomeController@testInstructions');
Route::get('/user-details/{id}', 'HomeController@userDetailsForm');
Route::any('/saveuser', 'HomeController@storeUserDetails');
Route::get('/apt-form', 'HomeController@aptitudeForm');
Route::post('/save-answers/{id}', 'HomeController@saveUserAnswers');
Route::get('/logout', 'HomeController@logout')->name('logout');
Route::get('/results', 'HomeController@results');
Route::get('already-submitted', 'HomeController@alreadySubmitted');


/**Routes for Admin */

Route::get('admin', 'AdminController@showLoginForm');
Route::post('login', 'AdminController@login');
Route::get('reports', 'AdminController@showUserReports');
Route::get('user-view/{id}', 'AdminController@showUserDetailView');
Route::post('delete-user', 'AdminController@deleteUser');
Route::get('forgot-pwd', 'AdminController@showForgotUserForm');
Route::post('forgot-pwd', 'AdminController@forget_password');

Route::get('dashboard', 'AdminController@dashboard');
Route::get('questions', 'QuestionsController@listQuestions');
Route::get('add-question', 'QuestionsController@create');
Route::post('add-question', 'QuestionsController@store');
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
