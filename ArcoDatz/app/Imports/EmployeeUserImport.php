<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;


class EmployeeUserImport implements ToCollection, WithHeadingRow
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
                    $user->role = $row['role'];
                    $user->name = $row['fname'].' '.$row['lname'];
                    $user->email = $row['email'];
                    $user->password =bcrypt($row['password']);
                    $user->save();
                    $id = DB::getPdo()->lastInsertId();

                    $employee = new Employee;
                    $employee->user_id = $id;
                    $employee->title = $row['title'];
                    $employee->fname = $row['fname'];
                    $employee->lname = $row['lname'];
                    $employee->addressline = $row['addressline'];
                    $employee->town = $row['town'];
                    $employee->zipcode = $row['zipcode'];
                    $employee->phonenumber = $row['phonenumber'];
                    $employee->img_path = $row['img_path'];
                    
                    $employee->save();
                
                }
        }
    }
}

