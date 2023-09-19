<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\Event;
use App\Models\Branch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Event::latest()->get();

        foreach ($data as $k => $events) {
            $data[$k]["branch_id"]     = Branch::where('id',$events->branch_id)->pluck('name')->first();
            unset($events->branch_id,$events->department_id,$events->employee_id,$events->color,$events->description,$events->description_ar,$events->title_ar,$events->noted,$events->created_at,$events->updated_at);
            $data[$k]["created_by"] = Employee::login_user($events->created_by);

        }
        return $data;
    }

    public function headings(): array
    {
        return [
            "ID",
            "Title",
            "Start Date",
            "End Date",
            "Start Time",
            "Created By",
            "End Time",
            "Lectures",
            "Location",
            "About"
        ];
    }
}
