<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Models\Grooming;

class GroomingImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //
          foreach ($rows as $row) 
        {
            
            $grooming = new Grooming ();
            $grooming->name = $row['name'];
            $grooming->description = $row['description'];
            $grooming->price= $row['price'];
            $grooming->save();

            
           
            // } //end foreach  
        }
    }
}
