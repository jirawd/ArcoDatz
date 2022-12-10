<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    use softDeletes;
    protected $guarded = ['id'];
      public static $rules = [
    'grooming_id'=>'required',
    'img_path'=>'required'];

    public static $messages = [
        'required' => 'Ang :attribute field na ito ay kailangan',
        'min' => 'masyadong maliit ang :attribute',
        'alpha' => 'pawang mga letra lamang',
        'fname.required' => 'pakibigay lang ang inyong pangalan'
    ];
    
  public function grooming()
    {
        return $this->belongsTo('App\Models\Grooming');
    }
}
