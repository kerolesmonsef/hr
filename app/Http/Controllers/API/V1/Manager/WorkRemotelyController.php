<?php

namespace App\Http\Controllers\API\V1\Manager;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeePermission;
use App\Models\Leave;
use App\Models\Mission;
use App\Models\WorkFromHomeRequest;
use Illuminate\Http\Request;

class WorkRemotelyController extends Controller
{

    public function accept($id){
        $row = WorkFromHomeRequest::findOrfail($id);
        $direct_manager = Employee::find($row->direct_manager);
        if(auth()->user()->employee->id != $row->direct_manager){
            return $this->error(__('You are not allowed to accept this request'),403,[]);
        }
        $row->update([
            'direct_manager'=> $direct_manager->direct_manager == null ? $row->direct_manager :  $direct_manager->direct_manager,
            'status' =>  $direct_manager->direct_manager == null ? 'approved' : 'pending',
        ]);
        return $this->success([] , 'success');
    }

    public function reject(Request $request,$id){
        $data=$request->validate([
            'reason'=>'required',
        ]);
        $row = WorkFromHomeRequest::findOrfail($id);
        if(auth()->user()->employee->id != $row->direct_manager){
            return $this->error(__('You are not allowed to reject this request'),403,[]);
        }
        $row->update([
            'status' => 'rejected',
            'reject_reason' => $data['reason'],
        ]);
        return $this->success([] , 'success');
    }

}
