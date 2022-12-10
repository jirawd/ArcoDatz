<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grooming extends Model
{
    use HasFactory;
    use softDeletes;
    // protected $table = 'groomings';
    protected $guarded = ['id'];

     public static $rules = [
    'name'=>'required',
    'description'=>'required',
    'price'=>'required'];

    
    public static $messages = [
        'required' => 'Ang :attribute field na ito ay kailangan',
        'min' => 'masyadong maliit ang :attribute',
        'alpha' => 'pawang mga letra lamang',
        'fname.required' => 'pakibigay lang ang inyong pangalan'
    ];

    public function images()
  {
   return $this->hasMany('App\Models\Image');
  }
}
