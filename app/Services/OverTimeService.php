<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class OverTimeService
{
    public function filter(Builder $overtimerequests){
         return  $overtimerequests->when(request()->filled('search'),function($sql){
                $sql->where(function($q){
                     $q->where('reason' , 'like' , '%'.request('search').'%')
                        ->orwhere('date'  , 'like' , '%'.request('search').'%')
                        ->orwhereHas('employee' , function($q){
                            $q->where('name' , 'like' , '%' . request('search') . '%' )
                                ->orwhere('name_ar' , 'like' , '%' . request('search') . '%');
                        });
                });
            })->when(request()->filled('start_date'),function($q){
                 $q->whereDate('date','>=', Carbon::createFromFormat('d/m/Y', request('start_date') )  );
            })->when(request()->filled('end_date'),function($q){
                $q->whereDate('date','<=', Carbon::createFromFormat('d/m/Y', request('end_date') )  );
           }); 
    }
}
