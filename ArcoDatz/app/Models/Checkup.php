<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


class Checkup extends Model implements Searchable
{
    use HasFactory;
    protected $table = 'checkup';
    protected $guarded = ['id'];
    protected $fillable = ['employee_id','pet_id','disease', 'comments', 'checkupdate'];
    
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

     public function getSearchResult(): SearchResult
            {
               $url = route('search.medical', $this->id);
            //    $url = url('show-listener/'.$this->id);
                return new \Spatie\Searchable\SearchResult(
                   $this,
                   $this->disease,
                   $url
                   );
            }
    // protected $nullable = [
    //     'employee_id','pet_id',
    //     'disease',
    //     'comments',
    //     'checkupdate'];
}
