<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Pet;
use Illuminate\Http\Request;
use View;
use Redirect;
use Validator;
use App\DataTables\PetsDataTable;
use DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Imports\PetImport;
use App\Rules\ExcelRule;
use Excel;

class PetController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function getPets(PetsDataTable $dataTable)
    {
        // $albums = Album::with('artist')->get();
        $customer = Customer::all();
        return $dataTable->render('pet.index',compact('customer'));
    }

    public function import(Request $request) {
            
        $request->validate(['Pet_upload' => ['required', new ExcelRule($request->file('Pet_upload'))],
            ]);
            // dd($request);
            Excel::import(new PetImport, request()->file('Pet_upload'));
            
            return redirect()->back()->with('success', 'Excel file Imported Successfully');
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
    }

    public function addpet($id)
    {
         $customer = $id;
         $owner = Customer::find($id);
        //$pets = Pet::all();
        return view('pet.addpet',compact('customer','owner'));
    }

    public function storePet(Request $request,$id)
    {
        //
        $pet = new Pet;
        $pet->customer_id = $id;
        $pet->name = $request->input('name');
        $pet->type = $request->input('type');
        $pet->breed = $request->input('breed');
        
        if($request->hasfile('img_path'))
        {
            $file = $request->file('img_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('storage/images/pets/', $filename);
            $pet->img_path = $filename;
        }
        $pet->save();
        return Redirect::to('customerprofile')->with('status','pet Added Successfully');
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
        $pet = new Pet;
        $pet->customer_id = $request->input('customer_id');
        $pet->name = $request->input('name');
        $pet->type = $request->input('type');
        $pet->breed = $request->input('breed');
        
        if($request->hasfile('img_path'))
        {
            $file = $request->file('img_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('storage/images/pets/', $filename);
            $pet->img_path = $filename;
        }
        $pet->save();
        return redirect()->back()->with('status','pet Added Successfully');
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
        $pet = Pet::find($id);
        // dd($customer);
        return View::make('pet.show',compact('pet'));
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
        $pet = Pet::find($id);
        $customers = Customer::all();
        // dd($customer);
        return View::make('pet.edit',compact('pet','customers'));
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
        $pet = Pet::find($id);
        $pet->name = $request->input('name');
        $pet->type = $request->input('type');
        $pet->breed = $request->input('breed');
        $pet->customer_id = $request->input('customer_id');
        if($request->hasfile('img_path'))
        {
            $destination = 'storage/images/pets/'.$pet->img_path;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('img_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('storage/images/pets/', $filename);
            $pet->img_path = $filename;
        }

        $pet->update();
        return Redirect::to('pets');
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
        $pet = Pet::find($id);
        // Album::where('customer_id',$customer->id)->delete();
        // $customer->albums()->delete();

        $pet->delete();
        // $customers = customer::with('albums')->get();
        
        
        return Redirect::to('/pets');
    }
}
