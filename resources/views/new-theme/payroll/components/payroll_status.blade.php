<?php 
    if ($payroll->status == 1 and $payroll->is_recieved == 1){
        $status = "Paid";
        $class = "success";
    }elseif ($payroll->status == 1 and $payroll->is_recieved == 0){
        $status = "Pending";
        $class = "warning";
    }else{
        $status = "Unpaid";
        $class = "danger";
    }
?>

<div class="buttonS2 {{ $class }}">
    @lang($status)
</div>