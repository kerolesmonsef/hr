<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\CompanyDucumentUpload;
class CompanyDucumentUploadController extends Controller
{
    public function destroy($id)
    {
        $document = CompanyDucumentUpload::find($id);
        FileHelper::delete_file($document -> document);
        $document->delete();
        flash()->addSuccess(__('Deleted successfully'));
        return redirect()->route('library.index');
    }
}
