<?php

namespace App\Http\Controllers\API\V1\Manager;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\MissingValue;
class LeavesController extends Controller
{

    public function accept($id){
        $leave = Leave::findOrfail($id);
        $direct_manager = Employee::find($leave->direct_manager);
        if(auth()->user()->employee->id != $leave->direct_manager){
            return $this->error(__('You are not allowed to accept this request'),403,[]);
        }
        $leave->update([
            'direct_manager'=> $direct_manager->direct_manager == null ? $leave->direct_manager :  $direct_manager->direct_manager,
            'status' =>  $direct_manager->direct_manager == null ? 'approved' : 'pending',
        ]);
        return $this->success([] , 'success');
    }


    public function reject(Request $request,$id){
        $data=$request->validate([
            'reason'=>'required',
        ]);
        $leave = Leave::findOrfail($id);
        if(auth()->user()->employee->id != $leave->direct_manager){
            return $this->error(__('You are not allowed to reject this request'),403,[]);
        }
        $leave->update([
            'status' => 'rejected',
            'admin_message' => $data['reason'],
        ]);
        return $this->success([] , 'success');
    }



}
