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

/**
 * Misc. pages
 */
Route::get('/', 'PageController@welcome');
Route::get('/about', 'PageController@about');
Route::get('/contact', 'PageController@contact');


/**
 * Employees
 */
# CREATE
# Show the form to add a new employee
Route::get('/employees/create', 'EmployeeController@create');

# Process the form to add a new Employee
Route::post('/employees', 'EmployeeController@store');

# READ
# Show a listing of all the Employees
Route::get('/employees', 'EmployeeController@index');

# Show an individual Employee
Route::get('/employees/{id}', 'EmployeeController@show');

# UPDATE
# Show the form to edit a specific book
Route::get('/employees/{id}/edit', 'EmployeeController@edit');

# Process the form to edit a specific book
Route::put('/employees/{id}', 'EmployeeController@update');

# DELETE
# Show the page to confirm deletion of a book
Route::get('/employees/{id}/delete', 'EmployeeController@delete');

# Process the deletion of a book
Route::delete('/employees/{id}', 'EmployeeController@destroy');

# READ
# Show a listing of all the Employees
Route::get('/requests', 'EmployeeController@showRequests');

# UPDATE
# Show the form to edit a specific book
Route::get('/staffRequests/{id}/match', 'EmployeeController@matchEmp');

# UPDATE
# Show the form to edit a specific book
Route::get('/staffRequests/{employeeId}/{staffId}/assignEmployee', 'EmployeeController@assignEmployee');

# MISC
# Search books
# TODO: Update to query database instead of books.json file
Route::get('/books/search', 'BookController@search');



Route::get('/debug', function () {

    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});