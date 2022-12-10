<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Mail\NewCustomerMail;
use Mail;

class CustomerUserImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        // 
        foreach ($rows as $row) 
        {
            try {
                    // $artist = Artist::where('artist_name',$row['artist'])->first();
                    $user = User::where('name',$row['fname'].' '.$row['lname'])->firstOrFail();
                }
            catch (ModelNotFoundException $ex) 
                {
               
                    $user = new User;
                    $user->role = 'Customer';
                    $user->name = $row['fname'].' '.$row['lname'];
                    $user->email = $row['email'];
                    $user->password =bcrypt($row['password']);
                    $user->save();
                    $id = DB::getPdo()->lastInsertId();

                    $customer = new Customer;
                    $customer->user_id = $id;
                    $customer->title = $row['title'];
                    $customer->fname = $row['fname'];
                    $customer->lname = $row['lname'];
                    $customer->addressline = $row['addressline'];
                    $customer->town = $row['town'];
                    $customer->zipcode = $row['zipcode'];
                    $customer->phonenumber = $row['phonenumber'];
                    $customer->img_path = $row['img_path'];
                    $customer->save();
                    
                    $data = new \stdClass();
                    $data->sender = $row['email'];
                    $data->title = 'New Customer';
                    $data->body = 'Customer Created Successfully';
                    Mail::to('administrator@bands.com.ph')->send(new NewCustomerMail($data));
                
                }
        }
    }
}

