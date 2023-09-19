<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class EmployeePermissionService
{
    public function filter(Builder $permissions)
    {
        if (request('search')) {
            $permissions->where(function ($q) {
                $q->where('message', 'like', '%' . request('search') . '%')
                    ->orwhere('date', 'like', '%' . request('search') . '%')
                    ->orwhereHas('employee', function ($q) {
                        $q->where('name', 'like', '%' . request('search') . '%')
                            ->orwhere('name_ar', 'like', '%' . request('search') . '%');
                    });
            });
        }

        $permissions->when(request('start_date'), function ($q) {
            $q->where('date', '>=', request('start_date'));
        })->when(request('end_date'), function ($q) {
            $q->where('date', '<=', request('end_date'));
        })->latest('id');

        return $permissions;
    }
}
