<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Models\Customer;
class LoginController extends Controller
{
    public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);
        
        if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))    
            {
                // 
            if (auth()->user()->role === 'Customer') {
                $customer = Customer::where('user_id',Auth::id())->first();
                return redirect()->route('customer.profile',compact('customer'));
            } 
            else if (auth()->user()->role === 'Admin'){
                 return redirect()->route('admin.profile');
            } 
            else {
                return redirect()->route('employee.profile');
            }
        }
        else{
            return redirect()->route('auth.signin')
                ->with('error','Email-Address And Password Are Wrong.');
        }
     }
    
    public function getLogout(){
        Auth::logout();
        return redirect()->guest('/signin');
    }
}
