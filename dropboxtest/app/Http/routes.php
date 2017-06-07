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
use App\Task;
use Illuminate\Http\Request;
/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', function () {
	$tasks = Task::orderBy('created_at', 'asc')->get();
    //return view('tasks');
	return view('tasks', [
        'tasks' => $tasks
    ]);
});

Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:100',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
	$task->email = $request->email;
    $task->save();

    return redirect('/');
});
Route::delete('/task/{task}', function (Task $task) {
    $task->delete();

    return redirect('/');
});

Route::get('/dropbox', 'FileController@getDropbox');
Route::post('/save-file', 'FileController@saveDropbox');

Route::get('/dropbox-upload-file', 'FileController@dropboxFileUpload');
Route::get('/gcs-upload-file', 'GoogleCloudController@GoogleFileUpload');
Route::auth();

Route::get('/home', 'HomeController@index');

/* ================== Homepage + Admin Routes ================== */

require __DIR__.'/admin_routes.php';
