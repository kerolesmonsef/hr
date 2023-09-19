<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class BreakService
{
    /**
     * @param Builder $breaks
     * @return void
     */
    public function filter( $breaks){
        if(request('start_date') || request('end_date')) {
            $start = back_date(request('start_date'));
            $end   = back_date(request('end_date'));
            $breaks->whereBetween("created_at", [$start, $end]);
        }
    }
}
