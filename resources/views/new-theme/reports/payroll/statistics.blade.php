<div class="row">
    <div class="col-lg-3">
        <div class='sectionS1 payrollCard'>
            <div class='headerTitle'>{{__('Total Basic Salary')}}</div>
            <div class='number'>
                {{ number_format($filterData['totalBasicSalary'], 2)}} <span>{{auth()->user()->currencySymbol()}}</span>
                
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class='sectionS1 payrollCard'>
            <div class='headerTitle'>{{__('Total Net Salary')}}</div>
            <div class='number'> 
                {{ number_format($filterData['totalNetSalary'], 2)}} <span>{{auth()->user()->currencySymbol()}}</span>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class='sectionS1 payrollCard'>
            <div class='headerTitle'>{{__('Total Allowance')}}</div>
            <div class='number'> 
                {{ number_format($filterData['totalAllowance'], 2)}} <span>{{auth()->user()->currencySymbol()}}</span>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class='sectionS1 payrollCard'>
            <div class='headerTitle'>{{__('Total Commission')}}</div>
            <div class='number'>
                {{ number_format($filterData['totalCommision'], 2)}} <span>{{auth()->user()->currencySymbol()}}</span>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class='sectionS1 payrollCard'>
            <div class='headerTitle'>{{__('Total Loan')}}</div>
            <div class='number'>
                {{ number_format($filterData['totalLoan'], 2)}} <span>{{auth()->user()->currencySymbol()}}</span>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class='sectionS1 payrollCard'>
            <div class='headerTitle'>{{__('Total Deduction')}}</div>
            <div class='number'>
                {{ number_format($filterData['totalSaturationDeduction'], 2)}} <span>{{auth()->user()->currencySymbol()}}</span>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class='sectionS1 payrollCard'>
            <div class='headerTitle'>{{__('Total Other Payment')}}</div>
            <div class='number'>
                {{ number_format($filterData['totalOtherPayment'], 2)}} <span>{{auth()->user()->currencySymbol()}}</span>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class='sectionS1 payrollCard'>
            <div class='headerTitle'>{{__('Total Overtime')}}</div>
            <div class='number'>
                {{ number_format($filterData['totalOverTime'], 2)}} <span>{{auth()->user()->currencySymbol()}}</span>
            </div>
        </div>
    </div>
</div>