<?php

namespace App\Exports;

use App\Models\CompanyDucumentUploadCategory;
use App\Models\EmployeePermission;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class DocumentLibraryExport implements FromView
{
    public function view(): View
    {
        return view('new-theme.exports.document-library', [
            'categories' =>  CompanyDucumentUploadCategory::with('documents') -> where(['created_by' =>  auth()->user()->creatorId()])->latest()->get()
        ]);
    }
}
