<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Customer;
use App\Models\Employee;
use App\Mail\NewCustomerMail;
use Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function getSignin(){
        return view('auth.signin');
    }

    public function getSignupC(){
        return view('auth.signupC');
    }

    public function postSignupC(Request $request){
        $this->validate($request, [
            'email' => 'email| required| unique:users',
            'password' => 'required| min:4'
        ]);
          $user = new User;
        $user->role = 'Customer';
        $user->name = $request->input('fname').' '.$request->input('lname');
        $user->email = $request->input('email');
        $user->password =bcrypt($request->input('password'));
        $user->save();
        $id = DB::getPdo()->lastInsertId();

        $customer = new Customer;
        $customer->user_id = $id;
        $customer->title = $request->input('title');
        $customer->fname = $request->input('fname');
        $customer->lname = $request->input('lname');
        $customer->addressline = $request->input('addressline');
        $customer->town = $request->input('town');
        $customer->zipcode = $request->input('zipcode');
        $customer->phonenumber = $request->input('phonenumber');
        //dd($request->input('img_path'));
        if($request->hasFile('img_path'))
        {
         
            $file = $request->file('img_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('storage/images/customers/', $filename);
            $customer->img_path = $filename;
        }
        $customer->save();
        //dd(env('MAIL_USERNAME'));
        $data = new \stdClass();
        $data->sender =  $request->input('email');
        $data->title = 'New Customer';
        $data->body = 'Customer Created Successfully';

        Mail::to('administrator@bands.com.ph')->send(new NewCustomerMail($data));
         Auth::login($user);
         return redirect()->route('customer.profile');
    }

     public function getSignupE(){
        return view('auth.signupE');
    }

    public function postSignupE(Request $request){
        $this->validate($request, [
            'email' => 'email| required| unique:users',
            'password' => 'required| min:4'
        ]);

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
        Auth::login($user);
        //dd($user->role);
       if($user->role = "Admin"){
            return redirect()->route('admin.profile');
        }else{
            return redirect()->route('employee.profile');
        }
        
        // }else if($user->role = "Groomer"){

        //     return redirect()->route('employee.profile');
        // }else if($user->role = "Veterinarian"){
        //     return redirect()->route('employee.profile');
        // }else {
        //         return redirect()->route('auth.signin')
        //         ->with('error','Route Error');
        //     }
        
    }

 

}

