<!-- bulk payment -->
<div class="modal fade" id="bulkPayment" abindex="-1" aria-hidden="true">
    <div class="modal-dialog confirmS2">
        {{Form::open(array('url'=>'payslip/bulkpayment/'.$formate_month_year,'method'=>'post'))}}
        <div class="content">
            <div class="contentHead flex align between">
                <h3 class="title">{{__('Bulk Payment')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="des">
                {{ __('Total Unpaid Employee') }} <b>{{ count($unpaidEmployees) }}</b> {{__('out of')}} <b>{{ count($Employees) }}</b>
            </div>
            <div class="btns">
                @if(count($unpaidEmployees) != 0)
                    <button type="submit" class="buttonS1 primary">{{__('Bulk Payment')}}</button>
                @endif
                <button type="button" class="buttonS2 cancel" data-bs-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
        {{Form::close()}}
    </div>
</div>

{!! $employee_payroll->appends(request()->input())->links() !!}
