<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\Pet;
use App\Models\Checkup;
use App\Models\Customer;
use App\Models\Service;
//use App\DataTables\CheckupDataTable;

class SearchController extends Controller
{
    //
    public function search(Request $request){
        // dd($request);
        $pet = Pet::where('name',$request->input('query'))->first();
        //dd($pet);
        $searchResults = (new Search())
        // ->registerModel(Checkup::class, ['disease','checkupdate'])
        ->registerModel(Checkup::class,'pet_id')
           
           
            ->perform($pet->id);
           // dd($searchResults);
//  ->search($request->get('search'));
            // dd($searchResults->('name'));
       // return view('item.search',compact('searchResults'));
           return view('search',compact('searchResults','pet'));
    }

    public function searchservice(Request $request){
        // dd($request);
        $customer = Customer::where('fname',$request->input('query'))->first();
        //dd($pet);
        $searchResults = (new Search())
        // ->registerModel(Checkup::class, ['disease','checkupdate'])
        ->registerModel(Service::class,'customer_id')
           
           
            ->perform($customer->id);
           // dd($searchResults);
//  ->search($request->get('search'));
            // dd($searchResults->('name'));
       // return view('item.search',compact('searchResults'));
           return view('service',compact('searchResults','customer'));
    }

    // public function getCheckup(CheckupDataTable $dataTable)
    // {
    //     // $albums = Album::with('artist')->get();
    //     // $customer = Customer::all();
    //     return $dataTable->render('search.med1');
    // }


}
