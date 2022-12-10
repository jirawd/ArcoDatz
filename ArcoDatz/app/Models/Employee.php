<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = 'Employees';
    protected $guarded = ['id'];
    public static $rules = ['lname'=>'required',
        'fname'=>'required',
        'addressline'=>'required',
        'phonenumber'=>'digits_between:3,8',
        'town'=>'required',
        'zipcode'=>'required',
        'img_path'=>'required'
    ];

    public static $messages = [
        'required' => 'Ang :attribute field na ito ay kailangan',
        'min' => 'masyadong maliit ang :attribute',
        'alpha' => 'pawang mga letra lamang',
        'fname.required' => 'pakibigay lang ang inyong pangalan'
    ];

    public function pets()
    {
        return $this->belongsToMany(Pet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkup()
    {
        return $this->belongsToMany(Checkup::class);
    }
}
