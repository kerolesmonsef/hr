<?php

namespace App\Services;


use Illuminate\Database\Eloquent\Builder;

class WorkFromHomeService
{
    public function filter(Builder $requests){

        $requests->when(request('start_date'), function ($q){
            $q->where('date','>=',request('start_date'));
        })->when(request('end_date'), function ($q){
            $q->where('date','<=',request('end_date'));
        })->latest();

        if(request('search')){
             $requests->where(function($q){
                $q->where('reason' , 'like' , '%'.request('search').'%')
                    ->orwhere('date'  , 'like' , '%'.request('search').'%')
                    ->orwhereHas('employee' , function($q){
                        $q->where('name' , 'like' , '%' . request('search') . '%' )
                            ->orwhere('name_ar' , 'like' , '%' . request('search') . '%');
                    });
            });
        }
        return $requests;
    }
}
