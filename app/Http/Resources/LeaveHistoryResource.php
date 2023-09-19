<?php

namespace App\Http\Resources;

use App\Models\LoanOption;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $color = [
            'approved' => 0,
            'pending'=> 1,
            'approvedWithDeduction' => 2,
            'rejected' => 3,
        ];
        if($this -> modeltype == 'leave'){
            return [
                //leaves
                'id' => $this->id,
                'modeltype' => $this-> modeltype,
                'status' =>  $this -> status,
                'status_number' => $color[$this->status],
                'leave_type' =>   $this->leaveType->requestTitle,
                'created_at' => date('F d, Y', strtotime($this->created_at)),
                'reason' => $this -> leave_reason,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ];
        }elseif($this -> modeltype == 'permission'){
            return [
                //permissions
                'id' => $this->id,
                'modeltype' => $this -> modeltype,
                'status' =>  $this -> status,
                'reason' => $this-> message,
                'from' =>  $this -> from ,
                'to' =>  $this -> to,
                'date' => Carbon::parse($this -> date),
            ];
        }elseif($this -> modeltype == 'loan'){
            return [
                'id' => $this -> id,
                'title' => $this -> title,
                'modeltype' => $this -> modeltype,
                'start_date' => $this -> start_date,
                'end_date' => Carbon::parse($this -> start_date)->addMonth( $this -> month_nubmer)->format('Y-m-d'),
                'amount' => $this -> amount,
                'month_number' => $this -> month_nubmer,
                'reason' => $this -> reason,
                'status' =>   $this -> status,
                'status_number' => $color[$this->status],
                'loan_option' => $this -> loan_option_item != null ? (app()->isLocale('en') ?   $this -> loan_option_item -> name :  $this -> loan_option_item -> name_ar ) : null,
            ];
        }elseif($this -> modeltype == 'work_from_home_request'){
            return [
                //permissions
                'id' => $this->id,
                'modeltype' => $this -> modeltype,
                'status' => $this -> status,
                'status_number' => $color[$this->status],
                'date' => Carbon::createFromFormat('Y-m-d' , $this -> date) -> format('F d, Y'),
                'reason' => $this-> reason,
            ];
        }
    }
}
