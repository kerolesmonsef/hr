<?php
namespace App\Filters;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TaskFilter
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $query)
    {
        $query->with('employees')
            ->where('created_by', auth()->user()->creatorId())
            ->when($this->request->filled('search'), function ($q) {
                $q->where('name', 'like', "%" . $this->request->search . "%");
            })
            ->when($this->request->filled('label'), function ($q) {
                $q->where('label', 'like', "%" . $this->request->label . "%");
            })
            ->when($this->request->filled('start_date'), function ($q) {
                $q->whereDate('start_date', Carbon::createFromFormat('d/m/Y', $this->request->start_date));
            })
            ->when($this->request->filled('due_date'), function ($q) {
                $q->whereDate('due_date', Carbon::createFromFormat('d/m/Y', $this->request->due_date));
            })
            ->when($this->request->filled('status'), function ($q) {
                $q->where('status', $this->request->status);
            })
            ->when($this->request->filled('employee'), function ($q) {
                $q->whereHas('employees', function ($query) {
                    $query->where('employees.employee_id', $this->request->employee);
                });
            });

        return $query;
    }
}
