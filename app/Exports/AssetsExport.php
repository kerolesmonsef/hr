<?php

namespace App\Exports;

use App\Models\Asset;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssetsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Asset::get();
        foreach ($data as $k => $assets) {

            $data[$k]["created_by"] = Employee::login_user($assets->created_by);
            $data[$k]["employee_id"] = $assets->employee->name;
            unset($assets->created_at, $assets->updated_at, $assets->purchase_date, $assets->supported_date, $assets->description);
        }
        return $data;
    }
    public function headings(): array
    {
        return [
            "ID",
            "Employee",
            "Asset Name",
            "Amount",
            "Created By",
            "serial number",
            "status",
            "type",
        ];
    }
}
