<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewTheme\DocumentRequest;
use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Document-List', ['only' => ['index']]);
        $this->middleware('permission:Document-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Document-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Document-Delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $documents = Document::when(request('search'), function ($q) {
            return $q->where('name' , 'like' , '%' . request('search') . '%' )
                     ->orwhere('name_ar' , 'like' , '%' . request('search') . '%');
        })->where('created_by', '=', auth()->user()->creatorId());

        $documents = $documents->paginate(10);
        if($request->ajax()) {
            $search             = view('new-theme.settings.document.documents', compact("documents"));
            return response()->json([
                'search'     => $search->render()
            ]);
        }

        return view('new-theme.settings.document.index', compact('documents'));
    }

    public function create(Request $request)
    {
        $documentTypes = DocumentType::get();
        return view('new-theme.settings.document.create', compact('documentTypes'));
    }

    public function store(DocumentRequest $request)
    {
        $document              = new Document();
        $document->name        = $request->name;
        $document->name_ar     = $request->name_ar;
        $document->is_required = $request->is_required;
        $document->document_type = $request->document_type;
        $document->created_by  = auth()->user()->creatorId();
        $document->save();

        return redirect()->route('document.index')->with('success', __('Document type successfully created.'));
    }

    public function edit(Request $request , Document $document)
    {
        $documentTypes = DocumentType::get();
        return view('new-theme.settings.document.edit', compact('documentTypes','document'));
    }

    public function update(DocumentRequest $request, Document $document)
    {
        $document->name          = $request->name;
        $document->name_ar       = $request->name_ar;
        $document->is_required   = $request->is_required;
        $document->document_type = $request->document_type;
        $document->save();

        return redirect()->route('document.index')->with('success', __('Document type successfully updated.'));
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('document.index')->with('success', __('Document type successfully deleted.'));
    }
}
