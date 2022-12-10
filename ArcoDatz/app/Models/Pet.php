<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


class Pet extends Model implements Searchable
{
    use HasFactory;
    use softDeletes;
    protected $guarded = ['id'];
    public static $rules = ['name'=>'required','customer_id',
    'type'=>'required',
    'breed'=>'required',
    'img_path'=>'required'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public static $messages = [
        'required' => 'Ang :attribute field na ito ay kailangan',
        'min' => 'masyadong maliit ang :attribute',
        'alpha' => 'pawang mga letra lamang',
        'fname.required' => 'pakibigay lang ang inyong pangalan'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

    public function getSearchResult(): SearchResult
            {
               $url = route('pet.show', $this->id);
            //    $url = url('show-listener/'.$this->id);
                return new \Spatie\Searchable\SearchResult(
                   $this,
                   $this->name,
                   $url
                   );
            }
}

