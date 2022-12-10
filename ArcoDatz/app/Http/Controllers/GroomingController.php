<?php

namespace App\Http\Controllers;

use App\Models\Grooming;
use App\Models\Image;
use App\DataTables\GroomingsDataTable;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Redirect;
use View;
use Illuminate\Support\Facades\DB;
use App\Rules\ExcelRule;
use Excel;
use App\Imports\GroomingImport;



class GroomingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function import(Request $request) {
            
        $request->validate(['Grooming_upload' => ['required', new ExcelRule($request->file('Grooming_upload'))],
            ]);
            // dd($request);
            Excel::import(new GroomingImport, request()->file('Grooming_upload'));
            
            return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }

    public function getGroomings(GroomingsDataTable $dataTable)
    {
        // $albums = Album::with('artist')->get();
        // $groomings = Grooming::whereHas('images')->first();
        // dd($groomings);
        return $dataTable->render('grooming.index');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->file('images'));
        $grooming = new Grooming;
        $grooming->name = $request->input('name');
        $grooming->description = $request->input('description');
        $grooming->price = $request->input('price');
        $grooming->save();
        $id = DB::getPdo()->lastInsertId();

        if ($request->hasFile('images')) {
            
            foreach($request->file('images') as $file){
                $name = $file->getClientOriginalName();
                
                $file->move('storage/images/groomings/', $name);
                
                $image = new Image;
                $image->grooming_id = $id;
                $image->img_path = $name;
                $image->save();
            }
        }
        return Redirect::to('groomings');
    }
 
            
            
            
            

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grooming  $grooming
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $grooming = Grooming::find($id);
        $images = Image::where("grooming_id", "=", $id)->get();
        
        // dd($images);
        return View::make('grooming.show',compact('grooming','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grooming  $grooming
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $grooming = Grooming::find($id);
        // dd($employee);
        return View::make('grooming.edit',compact('grooming'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grooming  $grooming
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $groomingservice = Grooming::find($id);
        $groomingservice->name = $request->input('name');
        $groomingservice->description = $request->input('description');
        $groomingservice->price = $request->input('price');
        $groomingservice->update();
        return Redirect::to('/groomings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grooming  $grooming
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $grooming = Grooming::find($id);
        // Album::where('customer_id',$customer->id)->delete();
        // $customer->albums()->delete();

        $grooming->delete();
        // $customers = customer::with('albums')->get();
        
        
        return Redirect::to('/groomings');
    }
}
