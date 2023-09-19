<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class PerformanceService
{
    public function filter(Builder $performance)
    {
        $performance
            ->whereHas('employee', function ($q) {
                $q->where('is_active', 1)
                    ->when(request('search'), function ($q) {
                        return $q->where('name', 'like', '%' . request('search') . '%')
                            ->orwhere('name_ar', 'like', '%' . request('search') . '%')
                            ->orwhere('id', 'like', '%' . request('search') . '%');
                    });
            })->when(request('start_date'), function ($q) {
                $q->where('date', '>=', back_date(request('start_date')));
            })->when(request('end_date'), function ($q) {
                $q->where('date', '<=', back_date(request('end_date')));
            })->with('performance_period', 'details');
    }
}
