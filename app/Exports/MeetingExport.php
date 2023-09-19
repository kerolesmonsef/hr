<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\Meeting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MeetingExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Meeting::get();
        foreach ($data as $k => $meeting) {

            $data[$k]["created_by"] = Employee::login_user($meeting->created_by);
            $data[$k]["employees"] = implode(',', $meeting->employees->pluck('name')->toArray() );
            unset($meeting->branch_id, $meeting->department_id, $meeting->employee_id, $meeting->supported_date, $meeting->description,$meeting->created_at,$meeting->updated_at,$meeting->url);
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            "ID",
            "Title",
            "Date",
            "Time",
            "note",
            "Created By",
            "Duration",
            "Location",
            "Employees",
        ];
    }
}
