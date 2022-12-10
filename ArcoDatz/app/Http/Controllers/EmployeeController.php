<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Grooming;
use App\Models\User;
use Illuminate\Http\Request;
use View;
use Redirect;
use Validator;
use App\DataTables\EmployeesDataTable;
use DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Imports\EmployeeUserImport;
use Excel;
use App\Rules\ExcelRule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//      public function getEmployees(Builder $builder) {
    public function import(Request $request) {
            
        $request->validate(['Employee_upload' => ['required', new ExcelRule($request->file('Employee_upload'))],
            ]);
            // dd($request);
            Excel::import(new EmployeeUserImport, request()->file('Employee_upload'));
            
            return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }

    

    public function getEmployees(EmployeesDataTable $dataTable)
    {
        // $albums = Album::with('artist')->get();
        return $dataTable->render('employee.index');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = new User;
        $user->role = $request->input('role');
        $user->name = $request->input('fname').' '.$request->input('lname');
        $user->email = $request->input('email');
        $user->password =bcrypt($request->input('password'));
        $user->save();
        $id = DB::getPdo()->lastInsertId();

        $employee = new Employee;
        $employee->user_id = $id;
        $employee->title = $request->input('title');
        $employee->fname = $request->input('fname');
        $employee->lname = $request->input('lname');
        $employee->addressline = $request->input('addressline');
        $employee->town = $request->input('town');
        $employee->zipcode = $request->input('zipcode');
        $employee->phonenumber = $request->input('phonenumber');
        //dd($request->input('img_path'));
        if($request->hasFile('img_path'))
        {
            // $des_path = 'storage/images/employees/';
            // $img_path = $request->file('img_path');
            // $img_name = $img_path->getClientOriginalName();
            // $path = $request->file('img_path')->storeAs($des_path,$img_name);
            // $employee->img_path = $img_name;

            $file = $request->file('img_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('storage/images/employees/', $filename);
            $employee->img_path = $filename;
        }
        $employee->save();
        return Redirect::to('employees');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $employee = Employee::find($id);
        // dd($employee);
        return View::make('employee.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $employee = Employee::find($id);
        // dd($employee);
        return View::make('employee.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         $employee = Employee::find($id);
        // $album->employee_id = $request->employee_id;
        $employee->title = $request->title;
        $employee->fname = $request->fname;
        $employee->lname = $request->lname;
        $employee->addressline = $request->addressline;
        $employee->town = $request->town;
        $employee->zipcode = $request->zipcode;
        $employee->phonenumber = $request->phonenumber;
        $employee->save();
        return Redirect::to('/employees')->with('success','employee updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $employee = Employee::find($id);
        // Album::where('customer_id',$customer->id)->delete();
        // $customer->albums()->delete();

        $employee->delete();
        // $customers = customer::with('albums')->get();
        
        
        return Redirect::to('/employees');
    }

    public function getProfile(){

    //return $dataTable->render('customer.profile');
        return view('employee.profile');
    }

    public function getAdminProfile(){

    //return $dataTable->render('customer.profile');
        return View::make('admin.profile');
    }

    public function getDeleted()
    {
        $pet = Pet::onlyTrashed()->get();
        $customers = Customer::onlyTrashed()->get();
        $employee = Employee::onlyTrashed()->get();
        $groomings = Grooming::onlyTrashed()->get();
        return View::make('admin.delete',compact('pet','customers','employee','groomings'));
    }
    public function restoreC($id)
    {
        Customer::withTrashed()->find($id)->restore();
  
        return back();
    }
    public function restoreP($id)
    {
        Pet::withTrashed()->find($id)->restore();
  
        return back();
    }
    public function restoreE($id)
    {
        Employee::withTrashed()->find($id)->restore();
  
        return back();
    }
    public function restoreG($id)
    {
        Grooming::withTrashed()->find($id)->restore();
  
        return back();
    }

    public function changerole($id)
    {
        $user = User::find($id);
        if($user->role == 'Groomer')
        {
            $role = 'Veterinarian';
        }
        else
        {
            $role = 'Groomer';
        }
        $user->role = $role;
        $user->update();
        return back();
    }

     public function roles()
    {
        $employees = User::where('role','Veterinarian')->orWhere('role','Groomer')->get();
        
        return View::make('admin.role',compact('employees'));
    }
}
