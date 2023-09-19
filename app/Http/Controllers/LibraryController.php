<?php

namespace App\Http\Controllers;

use App\Exports\DocumentLibraryExport;
use App\Exports\EmployeePermissionsExport;
use App\Helpers\FileHelper;
use App\Models\CompanyDucumentUpload;
use App\Models\CompanyDucumentUploadCategory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class LibraryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Library-List', ['only' => ['index']]);
        $this->middleware('permission:Library-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Library-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Library-Delete', ['only' => ['destroy']]);
    }

    public function export()
    {
        return Excel::download(new DocumentLibraryExport, 'document-library.xlsx');
    }

    public function index(Request $request)
    {
        $categories = CompanyDucumentUploadCategory::with('documents')
            ->where(['created_by' => auth()->user()->creatorId()])
            ->latest();

        if (request('search')) {
            $categories = $categories->where(function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%')
                    ->orwhere('name_ar', 'like', '%' . request('search') . '%');
            });
        }

        if (request("start_date")) {
            $categories = $categories->where('created_at', '>=', back_date(request("start_date")));
        }
        if (request("end_date")) {
            $categories = $categories->where('created_at', '<=', back_date(request("end_date")));
        }

        $categories = $categories->paginate(10);
        if ($request->ajax()) {
            $search = view('new-theme.document-library.document-library', compact("categories"));
            $paginate = view('new-theme.document-library.paginate', compact("categories"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }
        return view('new-theme.document-library.index', compact('categories'));
    }

    public function create(Request $request)
    {
        return view('new-theme.document-library.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);
        /** @var CompanyDucumentUploadCategory $row */
        $row = CompanyDucumentUploadCategory::create([
            'name' => $request->name,
            'name_ar' => $request->name,
            'created_by' => auth()->user()->creatorId(),
        ]);
        $row->storeRequestedDocuments();
        flash()->addSuccess(__('Added successfully'));
        return redirect()->route('library.index');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'documents' => 'nullable | array',
            'documents.*' => 'file|mimes:png,jpg,jpeg,pdf,docs,docx',
        ]);
        /** @var CompanyDucumentUploadCategory $row */
        $row = CompanyDucumentUploadCategory::findorfail($id);
        $row->update([
            'name' => $request->name,
            'name_ar' => $request->name,
        ]);

        $row->storeRequestedDocuments();

        flash()->addSuccess(__('Updated successfully'));
        return response()->json();
    }

    public function destroy($id)
    {
        $folder = CompanyDucumentUploadCategory::findOrfail($id);
        $folder->delete();
        flash()->addSuccess(__('Deleted successfully'));
        return redirect()->route('library.index');

    }
}
