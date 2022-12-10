<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Models\Pet;

class PetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //
          foreach ($rows as $row) 
        {
            
            $pet = new Pet();
            $pet->customer_id = $row['customer_id'];
            $pet->name = $row['name'];
            $pet->type = $row['type'];
            $pet->breed = $row['breed'];
            $pet->img_path = $row['img_path'];
            $pet->save();
           
            // } //end foreach  
        }
    }
}
