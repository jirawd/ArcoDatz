<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grooming;
use App\Models\Customer;
use App\Models\Employee;
use Session;
use DB;
use App\Cart;
use Auth;
use Askedio\Laravel5ProfanityFilter\ProfanityFilter;
use Snipe\BanBuilder\CensorWords;
use App\Charts\ServiceChart;

class ServiceController extends Controller
{
    //
    public function index(){
        $groomings = Grooming::with('images')->get();
        $customer = Customer::all();
        return view('services.index', compact('groomings','customer'));
        //return view('shop.index');
    }

    public function getAddToCart(Request $request , $id){
        //dd($id);
        if(Auth::check()){
            if (!(Auth::user()->role == "Customer")){
                return redirect()->back()->with('status','Login as Customer');
            }
            else{ 
                $groomings = Grooming::find($id);
                //dd($groomings);
                $oldCart = Session::has('cart') ? Session::get('cart'):null;
                $cart = new Cart($oldCart);

                $cart->add($groomings, $groomings->id);
                Session::put('cart', $cart);
                Session::save();
                return redirect()->back()->with('status','Added');
            }
            
        }
        else{
            return view('auth.signin');
        }
        
    }

    public function info($id)
    {          
        $comment = DB::table('comments')
                    
                                ->select('comments.*')
                                ->where('comments.grooming_id', '=', $id)                     
                                ->orderBy('comments.commentdate', 'asc')
                                ->get();
        $groomings = Grooming::with('images')->find($id);
        return view('services.info', compact('groomings','comment'));
    }  

    public function getCart(Request $request) {
        if(Auth::check()){
            if (!(Auth::user()->role == "Customer")){
                  return redirect()->back()->with('status','Login as Customer');
            }
            else{ 
                if (!Session::has('cart')) {
                    return view('services.shopping-cart');
                }
                $customer = Customer::where('user_id',Auth::id())->first();
                //dd($customer);
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $pet = DB::table('pets')
                                        ->join('customers', 'customers.id', '=', 'pets.customer_id')
                                        ->select('pets.*')
                                        ->where('customers.id', '=', $customer->id)                     
                                        ->orderBy('pets.id', 'asc')
                                        ->get();
                $employee= Employee::all();

                return view('services.shopping-cart', ['groomings' => $cart->groomings, 'totalPrice' => $cart->totalPrice], compact('pet','employee'));
                  }   
        }
        else{
            return view('auth.signin');
        }
    }

     public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->groomings) > 0) {
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }

         return redirect()->back();
    }

     public function servicecheckout(Request $request)
    {
        $customer = Customer::where('user_id',Auth::id())->first();

        //dd($request);
       // var_dump($request->pet_id);
        if (!Session::has('cart')) {
            return redirect()->route('services.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
       // dd($cart->groomingservices);
        //dd($request->input('pet_id'));
              try{
                DB::beginTransaction();
                  $current_date_time = date('Y-m-d H:i:s');
                  //dd($request->all());
                   DB::table('service')->insert(
                            ['service_date' => $current_date_time, 
                             'status' => "Pending",
                             'customer_id' => $customer->id,

                            ]
                            );
                  // $data=new Serviceline();
                  // $data->service_date = $current_date_time;
                  // $data->employee_id = Auth::user()->id;
                  // $data->save();

                  
                  $id = DB::getPdo()->lastInsertId();
                  foreach($cart->groomings as $grooming){
                        //$id = $groomingservices['groomingservice']['id'];
                        //$pet_id = $groomingservices['groomingservice']['pet_id'];
                        // dd($id);
                 
                        DB::table('serviceline')->insert(
                            ['groomings_id' => $grooming['grooming']['id'], 
                             'service_id' => $id,
                             'pet_id' => $request->pet_id[$grooming['grooming']['id']],
                             
                            ]
                            );
                    
                    }               
                 DB::commit();
                 Session::forget('cart');
                 //Pet::onlyTrashed()->restore();
                 return redirect()->route('services.receipt', ['id' => $id])->with('status','Grooming Registered Successfully');
               
                 }
                
                catch (Throwable $e) {
                     DB::rollback();
                      return redirect()->back()->with('status','Error');
                }
    }

    public function receipt($id){
       
        $service = DB::table('service')
                                ->join('serviceline', 'service.id', '=', 'serviceline.service_id')
                               
                                ->join('pets', 'pet_id', '=', 'pets.id')
                                ->join('groomings', 'groomings_id', '=', 'groomings.id')
                                ->join('customers', 'pets.customer_id', '=', 'customers.id')
                                ->select('service_date as sdate', 'groomings.name as hname','price','customers.lname','customers.fname','pets.name as pname')
                                ->where('service.id', '=', $id)
                                ->get();

                               //dd($serviceline);
         $total = DB::table('serviceline')
                                ->join('service', 'service.id', '=', 'serviceline.service_id')
                                ->join('groomings', 'groomings_id', '=', 'groomings.id')
                                ->where('serviceline.service_id', '=', $id)
                                ->sum('price');
        return view('services.receipt', compact('service','total'));
    }

    public function comment(Request $request){
        if(!empty($request->input('name'))){
            $name = $request->input('name');
        }
        else
        {   
            $name = 'Guest';
        }
            $string = app('profanityFilter')->filter($request->input('comments'));
            // $string = $profanityFilter->filter();
           
        
         try{
            
            DB::beginTransaction();

            $current_date_time = date('Y-m-d H:i:s');
            
            $query = DB::table('comments')->insert([
                'commentdate' => $current_date_time,
                'name' => $name,
                'grooming_id'=> $request->input('groomings_id'),
                'comment' => $string,
                'img_path' => 'guest.png',
                
            ]);
            //dd($checkup);
            //$checkup ->save();
            DB::commit();
            return redirect()->back()->with('status','Comment Registered Successfully');
           // return redirect()->back()->with('status','Checkup Registered Successfully');
            }
        catch (Throwable $e) {
             DB::rollback();
             return redirect()->back()->with('status','Error');
            }

    }

     function Transaction(Request $request){
           
           $trans = DB::table('customers')
                                ->join('service', 'service.customer_id', '=', 'customers.id')
                             
                                
                                ->select('fname','service_date as sdate','status','service.id as id')
                                ->where('service.status', '=', "Pending")
                                
                                ->orderBy('service.id', 'desc')
                                ->get();
          //dd($checkup);
            return view('services.transactions',compact('trans'));
    }

     public function updateService(Request $request, $id)
    {
        $emp = Employee::where('user_id',Auth::id())->first();
         DB::table('service')
        ->where('id', $id)
        ->update([
            'employee_id' => $emp->id,
            'status' => "Paid",
        ]);
         return redirect()->back()->with('status','Transaction Status Changed');
    }

     public function checkService($id)
    {
        $service = DB::table('service')
                                ->join('serviceline','serviceline.service_id','=','service.id')
                                ->join('pets','serviceline.pet_id','=','pets.id')
                                ->join('groomings','serviceline.groomings_id','=','groomings.id')
                                ->select('pets.name as pname','groomings.name as gname','price','description')
                                ->where('service.id', '=', $id)
                                
                                ->orderBy('service.id', 'desc')
                                ->get();
        return view('services.check',compact('service'));
    }

    public function serviceChart()
    {   

        $Service = DB::table('service')
            ->join('serviceline','service.id', '=', 'serviceline.service_id')
            ->groupBy('service_date')
            ->pluck(DB::raw('count(serviceline.pet_id) as total'),'service_date')
          
            ->all();
         $ServiceChart = new ServiceChart;

        $dataset = $ServiceChart->labels(array_keys($Service));
        $dataset = $ServiceChart->labels(array_keys($Service));
        $dataset = $ServiceChart->dataset('Pet Service', 'bar', array_values($Service));
        //$dataset = $ServiceChart->dataset('Album Genre', 'pie', array_values($Service));
        $dataset = $dataset->backgroundColor(collect(['#32a852','#1e6e33', '#0f7028','#98ebae']));
        $ServiceChart->options([
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

        return view('services.servicechart',compact('ServiceChart'));
    }

    public function changeDate(Request $request)
    {   

        $Service = DB::table('service')
            ->join('serviceline','service.id', '=', 'serviceline.service_id')
            ->whereBetween('service_date', [$request->input('startingDate'), $request->input('endingDate')])
            ->groupBy('service_date')
            ->pluck(DB::raw('count(serviceline.pet_id) as total'),'service_date')
            
            ->all();
         $ServiceChart = new ServiceChart;

        $dataset = $ServiceChart->labels(array_keys($Service));
        $dataset = $ServiceChart->labels(array_keys($Service));
        $dataset = $ServiceChart->dataset('Pet Service', 'bar', array_values($Service));
        //$dataset = $ServiceChart->dataset('Album Genre', 'pie', array_values($Service));
        $dataset = $dataset->backgroundColor(collect(['#32a852','#1e6e33', '#0f7028','#98ebae']));
        $ServiceChart->options([
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

        return view('services.servicechart',compact('ServiceChart'));
    }

}

