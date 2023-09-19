<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $fillable = [
        'employee_id',
        'title',
        'title_ar',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'lectures',
        'location',
        'about',
        'color',
        'description',
        'description_ar',
        'noted',
        'created_by',
        'photo'
    ];

    // protected $casts = [
    //     'start_date'    => 'date',
    //     'end_date'      => 'date',
    // ];
    protected $dates = [
        'start_date',
        'end_date' ,
    ];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class,'event_employees')->withTimestamps();
    }

    public function getPhotoPathAttribute(){

        if($this->photo){
            return asset('storage/'.$this->photo);
            // return asset('storage/'.$value);
        }
        return 'https://hrm.melesbs.com/new-theme/images/logoSmall.svg';
    }

}
