<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\DocumentTypeResource;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\DucumentUpload;
use App\Models\EmployeeDocument;
use App\Traits\ApiResponser;
use Hash;
use Validator;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\V1\User
 */
class DocumentController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $documents = DocumentType::query()
            ->with(['documents' => function ($q) {
                $q->whereHas("employeeDocuments", function ($q) {
                    $q->where("employee_id", auth()->user()->employee->id);
                })->with("employeeDocuments","documentType");
            }])->get()->pluck("documents")->flatten();


        return $this->success(DocumentResource::collection($documents));

    }

}
