<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Service extends Model implements Searchable
{
    use HasFactory;
    protected $table = 'service';
    protected $guarded = ['id'];
     protected $fillable = ['employee_id','customer_id','service_date', 'status'];
    

     public function getSearchResult(): SearchResult
            {
               $url = route('customer.show', $this->id);
            //    $url = url('show-listener/'.$this->id);
                return new \Spatie\Searchable\SearchResult(
                   $this,
                   $this->customer_id,
                   $url
                   );
            }
}
