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

// If authentecated already redirect from these pages
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return redirect('/login');
    });
    Route::get('/login', function (){
        return view('login');
    });
    Route::get('/register', function () {
        return view('register');
    });
    
});

Route::post('/register', 'Auth\RegisterController@register');

Route::post('/login', 'Auth\LoginController@login');




// Authenticated users only

Route::post('/logout', 'Auth\LoginController@logout');
Route::get('users/disabled', function(){
        // Get all inactive accounts
        $users = DB::table('users')
        ->where('account_status', 'Disabled')
        ->paginate(25);
        $count = $users->count();
        $currentpage = 'disabled_users';

        return view('users.users', compact(['users','count','currentpage']));

});



Route::group(['middleware'=> 'auth'], function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    
    Route::get('/search', 'SearchController@search');
    
    Route::post('/projects/add_collaborator', 'ProjectController@saveCollaborator');
    Route::get('/projects/add_collaborator/{project}', 'ProjectController@addCollaborator');
    Route::post('/projects/remove_collaborator', 'ProjectController@removeCollaboratorFromProject');
    Route::get('/projects/remove_collaborator/{project}', 'ProjectController@removeCollaborator');

    Route::post('/groups/add_user', 'GroupController@saveUser');
    Route::get('/groups/add_user/{group}', 'GroupController@addUser');
    Route::post('/groups/remove_user', 'GroupController@removeUserFromGroup');
    Route::get('/groups/remove_user/{group}', 'GroupController@removeUser');
});


Route::resource('users', 'UserController');

Route::resource('projects', 'ProjectController');
Route::resource('rfis', 'RFIController');
Route::resource('groups', 'GroupController');
Route::resource('posts', 'RFIPostController');

//Route::get('/info', function (){
//    phpinfo();
//});



