<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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
    })->name('sub');

Route::get('/index', function () {
    return view('dashboard.index');
    })->name('try');

   //Auth 
Route::group(['middleware' => 'guest'], function() {
        Route::get('signupC', [
        'uses' => 'AuthController@getSignupC',
        'as' => 'auth.signupsC',
            ]);
        
        Route::get('signupE', [
        'uses' => 'AuthController@getSignupE',
        'as' => 'auth.signupsE',
            ]);
        
        Route::get('signin', [
                'uses' => 'AuthController@getSignin',
                'as' => 'auth.signins',
             ]);
        Route::post('signin', [
                'uses' => 'LoginController@postSignin',
                'as' => 'auth.signin',
            ]);

        Route::post('signupE', [
                'uses' => 'AuthController@postSignupE',
                'as' => 'auth.signupE',
            ]);

        Route::post('signupC', [
                'uses' => 'AuthController@postSignupC',
                'as' => 'auth.signupC',
            ]);
});

// Customer Only
Route::group(['middleware' => 'role:Customer'], function() {
    Route::get('customerprofile', [
    'uses' => 'CustomerController@getProfile',
    'as' => 'customer.profile',
        ]);

    Route::get('/edit-customer/{id}', [
    'uses' => 'CustomerController@cusEdit',
    'as' => 'cusEdit'
    ]);    
    Route::put('/update-customer/{id}', [
    'uses' => 'CustomerController@cusupdate',
    'as' => 'cusUpdate'
    ]);   
    Route::get('/add-pet/{id}', [
    'uses' => 'PetController@addpet',
    'as' => 'add-petc'
    ]);  
    Route::post('/add-pet/{id}', [
    'uses' => 'PetController@storePet',
    'as' => 'add-pets'
    ]); 

    Route::get('/service/add-to-cart/{id}','ServiceController@getAddToCart');

    Route::post('/checkup-pet/{id}', [
    'uses' => 'CheckupController@checkupPet',
    'as' => 'checkup-pet'
    ]); 

    Route::post('/service/checkout','ServiceController@servicecheckout');

    Route::get('/service/receipt/{id}', 'ServiceController@receipt')->name('services.receipt');
    Route::get('services/shopping-cart','ServiceController@getCart');
    Route::get('/service/remove/{id}','ServiceController@getRemoveItem')->name('service.remove');
});

Route::group(['middleware' => 'role:Veterinarian,Groomer'], function() {
    Route::get('/employeeprofile', [
    'uses' => 'EmployeeController@getProfile',
    'as' => 'employee.profile',
        ]);  
   
});

Route::group(['middleware' => 'role:Admin,Groomer'], function() {
    Route::post('/searchservice', 'SearchController@searchservice')->name('searchservice');
    
    
    Route::get('/servicetransactions', 'ServiceController@Transaction');
    Route::get('/updateService/{id}', 'ServiceController@updateService');
    Route::get('/checkService/{id}', 'ServiceController@checkService');
    Route::get('/chartsdate', 'ServiceController@serviceChart');
    Route::post('/changedate', 'ServiceController@changeDate');
   
   
});

Route::group(['middleware' => 'role:Admin,Veterinarian'], function() {
    Route::get('/checkup', [
    'uses' => 'CheckupController@index',
    'as' => 'checkupindex'
    ]); 

    Route::get('/check/{id}', [
    'uses' => 'CheckupController@checkStatus',
    'as' => 'checkup'
    ]);

    Route::put('/update-checkup/{id}', [
    'uses' => 'CheckupController@updateStatus',
    'as' => 'upcheckup'
    ]); 

    Route::post('/search', 'SearchController@search')->name('search');
    Route::get('/medicalhistory', 'CheckupController@MedHistory');
   
});

   

Route::group(['middleware' => 'role:Admin'], function() {
    
    Route::get('/adminprofile', [
    'uses' => 'EmployeeController@getAdminProfile',
    'as' => 'admin.profile',
        ]);     

    Route::get('/deleteddata', [
          'uses' => 'EmployeeController@getDeleted',
           'as' => 'getdeleted'
        ]);

    Route::get('employees/restore/one/{id}', [
        'uses' => 'EmployeeController@restoreE',
        'as' => 'restoreEmployees']);

    Route::get('pets/restore/one/{id}', [
        'uses' => 'EmployeeController@restoreP',
        'as' => 'restorePets']);

    Route::get('customers/restore/one/{id}', [
        'uses' => 'EmployeeController@restoreC',
        'as' => 'restoreCustomers']);
    Route::get('groomings/restore/one/{id}', [
        'uses' => 'EmployeeController@restoreG',
        'as' => 'restoreGroomings']);

    Route::get('changerole/{id}', [
        'uses' => 'EmployeeController@changerole',
        'as' => 'changerole']);

    Route::get('/roles', [
          'uses' => 'EmployeeController@roles',
           'as' => 'roles'
        ]);


});


Route::group(['middleware' => 'role:Admin,Groomer,Veterinarian'], function() {
    Route::get('/customers', [
    'uses' => 'CustomerController@getCustomers',
    'as' => 'getCustomers'
        ]);

    Route::get('/pets', [
          'uses' => 'PetController@getPets',
           'as' => 'getPets'
        ]);

    Route::get('/employees', [
          'uses' => 'EmployeeController@getEmployees',
           'as' => 'getEmployees'
        ]);

    Route::get('/groomings', [
          'uses' => 'GroomingController@getGroomings',
           'as' => 'getGroomings'
        ]);

    Route::post('/customer/import', 'CustomerController@import')->name('CustomerImport');
    Route::post('/employee/import', 'EmployeeController@import')->name('EmployeeImport');
    Route::post('/pet/import', 'PetController@import')->name('PetImport');
    Route::post('/grooming/import', 'GroomingController@import')->name('GroomingImport');
    Route::resource('customer', 'CustomerController')->except(['index']);
    Route::resource('pet', 'PetController')->except(['index']);
    Route::resource('employee', 'EmployeeController')->except(['index']);
    Route::resource('grooming', 'GroomingController')->except(['index']);

});
Route::get('/medical/{id}', 'CheckupController@show')->name('search.medical');

 

    // Route::get('/search/{search?}',['uses' => 'SearchController@search','as' => 'search'] );

// Route::get('/checkupps', [
//               'uses' => 'SearchController@getCheckup',
//                'as' => 'getCheckup'
//             ]); 


    Route::get('/services','ServiceController@index');

    Route::get('/service/info/{id}', 'ServiceController@info');
    Route::post('/service/comments', 'ServiceController@comment');

// });
Route::get('logout',[
  'uses' => 'LoginController@getLogout',
  'as' => 'user.logout',
 ]);

Route::get('/getCheckup', [
          'uses' => 'CheckupController@getCheckup',
           'as' => '/getCheckup'
        ]);

