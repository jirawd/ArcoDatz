<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\PetDataTable;
use View;
use Redirect;
use Validator;
use App\DataTables\CustomersDataTable;
use DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Mail\NewCustomerMail;
use Mail;
use App\Imports\CustomerUserImport;
use Excel;
use App\Rules\ExcelRule;

class CustomerController extends Controller
{
//     public function getCustomers(Builder $builder) {
       
//         $customer = Customer::query();   
//         if (request()->ajax()) {
//                     return DataTables::of($customer)
//                     ->order(function ($query) {
//                      $query->orderBy('id', 'ASC');
//                  })->addColumn('action', function($row) {
//                     return "<a href=".route('customer.edit', $row->id). "
// class=\"btn btn-warning\">Edit</a> <form action=". route('customer.destroy', $row->id). " method= \"POST\" >". csrf_field() .
//                     '<input name="_method" type="hidden" value="DELETE">
//                     <button class="btn btn-danger" type="submit">Delete</button>
//                       </form>';
//             })->addColumn('img_path', function(Customer $customer){
//         $url = url("storage/images/customers/".$customer->img_path);        
//         return '<img src="'. $url .'" width="100" height="120"/>'; 
// })
//                     ->rawColumns(['img_path','action'])
//                     ->toJson();
//         }
//         $html = $builder->columns([
//             ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
//             ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
//             ['data' => 'fname', 'name' => 'fname', 'title' => 'First Name'],
//             ['data' => 'lname', 'name' => 'lname', 'title' => 'Last Name'],
//             ['data' => 'addressline', 'name' => 'addressline', 'title' => 'Addressline'],
//             ['data' => 'town', 'name' => 'town', 'title' => 'Town'],
//             ['data' => 'zipcode', 'name' => 'zipcode', 'title' => 'Zipcode'],
//             ['data' => 'phonenumber', 'name' => 'phonenumber', 'title' => 'Phone Number'],
//             // ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
//             // ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
//             ['data' => 'img_path', 'name' => 'img_path', 'title' => 'Image'],
//             ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
//         ]);

//     return view('customer.index', compact('html'));
    // }

    public function getCustomers(CustomersDataTable $dataTable)
    {
        // $albums = Album::with('artist')->get();
        return $dataTable->render('customer.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return View::make('customer.create');
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
        // $input = $request->all();
        //  //dd($input);
        // Customer::create($input);
        //dd($request->all());
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
            // $des_path = 'storage/images/customers/';
            // $img_path = $request->file('img_path');
            // $img_name = $img_path->getClientOriginalName();
            // $path = $request->file('img_path')->storeAs($des_path,$img_name);
            // $customer->img_path = $img_name;

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

        //  $data = array(
        // 'sender'   =>  $request->input('fname').' '.$request->input('lname') ,
        // 'title'   =>  'New Customer',
        // 'body'   =>   'Customer Created Successfully'
        // );
        
        //dd($data);
        Mail::to('administrator@bands.com.ph')->send(new NewCustomerMail($data));
        

        return Redirect::to('customers');
    }

    public function import(Request $request) {
        
         $request->validate([
        'Customer_upload' => ['required', new ExcelRule($request->file('Customer_upload'))],
        ]);
        // dd($request);
        Excel::import(new CustomerUserImport, request()->file('Customer_upload'));
        
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $customer = Customer::find($id);
        // dd($customer);
        return View::make('customer.show',compact('customer'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $customer = Customer::find($id);
        // dd($customer);
        return View::make('customer.edit',compact('customer'));
    }

    public function cusEdit($id)
    {
        //
        $customer = Customer::find($id);
        // dd($customer);
        return View::make('customer.cusEdit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
    {
       $customer = Customer::find($id);
        // $album->customer_id = $request->customer_id;
        $customer->title = $request->title;
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->addressline = $request->addressline;
        $customer->town = $request->town;
        $customer->zipcode = $request->zipcode;
        $customer->phonenumber = $request->phonenumber;
        $customer->save();
        return Redirect::to('/customers')->with('success','customer updated!');
    }

    public function cusupdate(Request $request, $id)
    {
       $customer = Customer::find($id);
        // $album->customer_id = $request->customer_id;
        $customer->title = $request->title;
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->addressline = $request->addressline;
        $customer->town = $request->town;
        $customer->zipcode = $request->zipcode;
        $customer->phonenumber = $request->phonenumber;
        $customer->save();
        return Redirect::to('/customerprofile')->with('success','customer updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        // Album::where('customer_id',$customer->id)->delete();
        // $customer->albums()->delete();

        $customer->delete();
        // $customers = customer::with('albums')->get();
        
        
        return Redirect::to('/customers');
    }

    public function getProfile(){

        $customer = Customer::where('user_id',Auth::user()->id)->first();
        $pets = Pet::where('customer_id',$customer->id)->get();
        //dd($pets);

        //dd($customer);
        return view('customer.profile',compact('customer','pets'));
    }

    
    
}
