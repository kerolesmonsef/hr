<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class MissionService
{
    public function filter(Builder  $missions){
        if(request('search')){
            $missions = $missions->where(function($q){
                $q->where('reason' , 'like' , '%'.request('search').'%')
                    ->orwhere('date'  , 'like' , '%'.request('search').'%')
                    ->orwhere('start'  , 'like' , '%'.request('search').'%')
                    ->orwhere('end'  , 'like' , '%'.request('search').'%')
                    ->orwhereHas('employee' , function($q){
                        $q->where('name' , 'like' , '%' . request('search') . '%' )
                            ->orwhere('name_ar' , 'like' , '%' . request('search') . '%');
                    });

            });
        }

        return $missions;
    }
}
