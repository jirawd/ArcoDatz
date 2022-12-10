<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkup;
use App\Models\Employee;
use App\Models\Pet;
use App\Models\Customer;
use Redirect;
use DB;
use View;
use Auth;
use Mail;
use App\Mail\CheckupMail;
use App\Charts\petDiseaseChart;
use App\DataTables\CheckupsDataTable;

class CheckupController extends Controller
{
    //
        public function checkupPet($id)
    {
        //
        $query = DB::table('checkup')->insert([ 
                'pet_id'=> $id,
                'status'=> 'In-Progress',
                'disease'=> 'Need Checkup',      
            ]);  
        return Redirect::to('customerprofile')->with('status','Reserved for Checkup');
    }

    public function getCheckup(CheckupsDataTable $dataTable)
    {
        // $albums = Album::with('artist')->get();
        return $dataTable->render('checkup.indexx');
    }

        public function consultPet($id)
    {
        //
        $query = DB::table('checkup')->insert([ 
                'pet_id'=> $id,      
            ]);  
        return Redirect::to('customerprofile')->with('status','Reserved for Checkup');
    }

    public function index()
    {
        $checkups = Checkup::with('pet')->where('status','In-Progress')->get();
        //$pets = Pet::with('checkup')->where('status','In-Progress')->get();
        
        // dd($pet);
         //$pets = $checkups->pets();
         //($checkups);
        
    
        // $customer = Pet::where('pet_id',$checkups->pets->id)->with('customer')->get();
        // dd($customer);
        $petDisease = DB::table('checkup')
            ->join('pets','pets.id', '=', 'checkup.pet_id')
           
            ->groupBy('checkup.disease')
            ->pluck(DB::raw('count(checkup.pet_id) as total'),'disease')
            ->all();
         $petDiseaseChart = new PetDiseaseChart;

        $dataset = $petDiseaseChart->labels(array_keys($petDisease));
        $dataset = $petDiseaseChart->labels(array_keys($petDisease));
        $dataset = $petDiseaseChart->dataset('Pet Disease', 'bar', array_values($petDisease));
        //$dataset = $petDiseaseChart->dataset('Album Genre', 'pie', array_values($petDisease));
        $dataset = $dataset->backgroundColor(collect(['#32a852','#1e6e33', '#0f7028','#98ebae']));
        $petDiseaseChart->options([
            'responsive' => true,
            // 'legend' => ['display' => true],
            'tooltips' => ['enabled'=> true],
            // 'maintainAspectRatio' =>true,
            'title' => [
                'display'=> true,
                'text' => 'Chart.js Floating Bar Chart'
            ],
            // 'title' => 'genre',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> true],
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => true],
                            'display' => true

                          ]],
                ],

        ]);
        // dd($petDiseaseChart);
        

        return View::make('checkup.index',compact('checkups','petDiseaseChart'));
    }

   

    public function checkStatus($id)
    {
        //
        //dd(Auth::user());
        $checkup = Checkup::with('pet')->find($id);
        // $emp = Employee::all();
        return View::make('checkup.check',compact('checkup'));
    }

     public function updateStatus(Request $request, $id)
    {
        //
        //dd(Auth::user());
        $checkup = Checkup::find($id);
        //dd($checkup);
        $pet = Pet::with('customer')->where('id',$checkup->pet_id)->first();
        $customer = Customer::with('user')->where('user_id',$pet->customer->user_id)->first();
        //dd(Auth::user()->id);
        $emp = Employee::with('user')->where('user_id',Auth::user()->id)->first();
        //dd($emp_id);
        $checkup->employee_id = $emp->id;
        $checkup->disease = $request->input('disease');
        $checkup->comments = $request->input('comments');
        $checkup->checkupdate = date('Y-m-d H:i:s');
        $checkup->status = 'Done';
        $checkup->update();
        //dd($checkup);

        $data = new \stdClass();
        $data->sender = $emp->user->email;
        $data->title = 'Check Up Result';
        $data->disease = $request->input('disease');
        $data->petname = $pet->name;
        $data->customername = $pet->customer->name;
         // $data = array(
         //    'sender'   =>  $emp->user->email,
         //    'title'   =>  'Check Up Result',
         //    'disease'   =>   $request->input('disease'),
         //    'petname'   =>   $pet->name,
         //    'customername'   =>   $pet->customer->name,
         //    );
        
    //dd($data);
         Mail::to($customer->user->email)->send(new CheckupMail($data));
        if (Auth::user()->role == "Admin"){
            return Redirect::to('adminprofile')->with('status','Checkup Done');
        }else{
            return Redirect::to('employeeprofile')->with('status','Checkup Done');
        }
        
    }

 

    public function MedHistory()
    {
        $checkups = Checkup::with('pet')->where('status','Done')->get();
        return View::make('search.med',compact('checkups'));
    }

    public function show($id)
    {
        //
        $checkup = Checkup::find($id);
        // dd($customer);
        return View::make('search.medical',compact('checkup'));

    }

    


}
