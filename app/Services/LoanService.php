<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class LoanService
{
    public function filter(Builder $loans)
    {

        $loans->when(request('start_date'), function ($q) {
            $q->where('start_date', '>=', request('start_date'));
        })->when(request('end_date'), function ($q) {
            $q->where('start_date', '<=', request('end_date'));
        })->latest();


        if (request('search')) {
            $loans = $loans->where(function ($q) {
                $q->where('reason', 'like', '%' . request('search') . '%')
                    ->orwhere('start_date', 'like', '%' . request('search') . '%')
                    ->orwhere('amount', 'like', '%' . request('search') . '%')
                    ->orwhereHas('employee', function ($q) {
                        $q->where('name', 'like', '%' . request('search') . '%')
                            ->orwhere('name_ar', 'like', '%' . request('search') . '%');
                    });
            });
        }

    }
}
