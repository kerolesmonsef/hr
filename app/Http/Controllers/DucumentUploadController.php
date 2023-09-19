<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DucumentUpload;
use App\Models\DucumentUploadImage;
use App\Models\Employee;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DucumentUploadController extends Controller
{

    public function index()
    {

            if(auth()->user()->type == 'company')
            {
                $documents = DucumentUpload::with('ducument')->get();
            }
            else
            {
                $userRole  = auth()->user()->roles->first();
                $documents = DucumentUpload::whereIn(
                    'role', [
                              $userRole->id,
                              0,
                          ]
                )->with('ducument')->get();
            }
            return view('documentUpload.index', compact('documents'));

    }
    public function delete_image($id){
        DucumentUploadImage::find($id)->delete();
        return ;

    }
    public function create(Request $request)
    {
        if(auth()->user()->can('Create Document'))
        {
            $documents = Document::where('created_by' ,auth()->user()->creatorId() )->get();
            $employees = Employee::where('created_by' , auth()->user()->creatorId())->get();
            $roles = Role::get()->pluck('name', 'id');
            $roles->prepend('All', '0');
            $employeeId = $request->employee_id;
            return view('documentUpload.create', compact('roles','employeeId','documents','employees'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }
    public function report(){
        $documents = Document::where('created_by' , auth()->user()->creatorId() )->get();
        $employees = Employee::where('created_by' , auth()->user()->creatorId() )->with('ducument_uploads')->get();
        //return response($employees);
        return view('documentUpload.report', compact('documents','employees'));
    }
    public function store(Request $request)
    {
        if(auth()->user()->can('Create Document'))
        {
            $validator = \Validator::make(
                $request->all(), [
                    'document_id' => 'required|numeric',
                    'employee_id' => 'required|numeric',
                    'document' => 'required|array',
                    'document.*' => 'mimes:jpeg,png,jpg,svg,pdf,doc,zip|max:20480',
                    'exp_date' => 'nullable|string',
                ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $last_document = DucumentUpload::where('employee_id' , $request->employee_id )->where('document_id', $request->document_id )->first();
            if( $last_document ){
                 return redirect()->back()->with('error', __('This document has been uploaded to this employee before, you can modify it instead of uploading it again'));
            }
            $document              = new DucumentUpload();
            $document->employee_id = $request->employee_id;
            $document->role        = $request->role;
            $document->document_id        = $request->document_id;
            $document->description = $request->description;
            $document->employee_id        = $request->employee_id;
            if($request->exp_date){
                $document->exp_date = $request->exp_date;
            }
            $document->created_by  = auth()->user()->creatorId();
            $document->save();
            if(!empty($request->document))
            {
                foreach($request->document as $imageObject){
                    $filenameWithExt = $imageObject->getClientOriginalName();
                    $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension       = $imageObject->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $dir             = storage_path('uploads/documentUpload/');

                    if(!file_exists($dir))
                    {
                        mkdir($dir, 0777, true);
                    }
                    $path = $imageObject->storeAs('uploads/documentUpload/', $fileNameToStore);
                    DucumentUploadImage::create(['image' => $fileNameToStore , 'ducument_upload_id' => $document->id]);
                }
            }
            return redirect()->back()->with('success', __('Document successfully uploaded.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function show(DucumentUpload $ducumentUpload)
    {
        //
    }


    public function edit($id)
    {

        if(auth()->user()->can('Edit Document'))
        {
            $employees = Employee::where('created_by' , auth()->user()->creatorId())->get();
            $documents = Document::where('created_by' ,auth()->user()->creatorId() )->get();
            $roles = Role::get()->pluck('name', 'id');
            $roles->prepend('All', '0');
            $ducumentUpload = DucumentUpload::with('ducumentuploadimages')->find($id);

            return view('documentUpload.edit', compact('roles', 'ducumentUpload','documents','employees'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        if(auth()->user()->can('Edit Document'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                    'document_id' => 'required|numeric',
                                    'employee_id' => 'required|numeric',
                                    'document' => 'nullable|array',
                                   'document.*' => 'mimes:jpeg,png,jpg,svg,pdf,doc,zip|max:20480',
                                   'exp_date' => 'nullable|string',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $document = DucumentUpload::find($id);

            if(!empty($request->document))
            {
                foreach($request->document as $imageObject){
                    $filenameWithExt = $imageObject->getClientOriginalName();
                    $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension       = $imageObject->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $dir             = storage_path('uploads/documentUpload/');

                    if(!file_exists($dir))
                    {
                        mkdir($dir, 0777, true);
                    }
                    $path = $imageObject->storeAs('uploads/documentUpload/', $fileNameToStore);
                    DucumentUploadImage::create(['image' => $fileNameToStore , 'ducument_upload_id' => $document->id]);
                }
            }



            if(!empty($request->document))
            {
                $document->document = !empty($request->document) ? $fileNameToStore : '';
            }

            $document->role        = $request->role;
            $document->document_id        = $request->document_id;
            $document->description = $request->description;
            $document->employee_id        = $request->employee_id;
            if($request->exp_date){
                $document->exp_date = $request->exp_date;
            }
            $document->save();



            return redirect()->back()->with('success', __('Document successfully uploaded.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        if(auth()->user()->can('Delete Document'))
        {
            $document = DucumentUpload::find($id);
            if($document->created_by == auth()->user()->creatorId())
            {
                $document->delete();

                $dir = storage_path('uploads/documentUpload/');

                if(!empty($document->document))
                {
                    unlink($dir . $document->document);
                }

                return redirect()->back()->with('success', __('Document successfully deleted.'));
            }
            else
            {
                flash()->addError(__('Permission denied'));
            return redirect()->back();
            }
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }
}
