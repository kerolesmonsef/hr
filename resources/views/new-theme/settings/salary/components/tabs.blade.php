<div class="tabsS1">
    <ul class="nav nav-pills mb-3 scrollS2" id="pills-tab" role="tablist" style="padding: 0px 10px;">
        <li class="nav-item" role="presentation">
            <a style="padding-left: 10px; padding-right: 10px" href="{{ route("salary_setting.index") }}" class="nav-link {{ $active == "salary" ? "active" : "" }}" role="tab" aria-selected="true">@lang("Salary")</a>
        </li>
        <li class="nav-item" role="presentation">
            <a style="padding-left: 10px; padding-right: 10px" href="{{ route("payroll_setting.index") }}" class="nav-link {{ $active == "payroll" ? "active" : "" }}" role="tab"  aria-selected="false">@lang("Payroll")</a>
        </li>
        <li class="nav-item" role="presentation">
            <a style="padding-left: 10px; padding-right: 10px" href="{{ route("paysliptype.index") }}" class="nav-link {{ $active == "paysliptype" ? "active" : "" }}" role="tab"  aria-selected="false">@lang("Pay Slip")</a>
        </li> 
        
        <li class="nav-item" role="presentation">
            <a style="padding-left: 10px; padding-right: 10px" href="{{ route("allowanceoption.index") }}" class="nav-link {{ $active == "allowance" ? "active" : "" }}" role="tab"  aria-selected="false">@lang("Allowance")</a>
        </li>
        <li class="nav-item" role="presentation">
            <a style="padding-left: 10px; padding-right: 10px" href="{{ route("awardtype.index") }}" class="nav-link {{ $active == "awardtype" ? "active" : "" }}" role="tab"  aria-selected="false">@lang("Award")</a>
        </li>
        <li class="nav-item" role="presentation">
            <a style="padding-left: 10px; padding-right: 10px" href="{{ route("deductionoption.index") }}" class="nav-link {{ $active == "deductionoption" ? "active" : "" }}" role="tab"  aria-selected="false">@lang("Deduction")</a>
        </li>
        <li class="nav-item" role="presentation">
            <a style="padding-left: 10px; padding-right: 10px" href="{{ route("loanoption.index") }}" class="nav-link {{ $active == "loanoption" ? "active" : "" }}" role="tab"  aria-selected="false">@lang("Loan")</a>
        </li>
        <li class="nav-item" role="presentation">
            <a style="padding-left: 10px; padding-right: 10px" href="{{ route("paymenttype.index") }}" class="nav-link {{ $active == "paymenttype" ? "active" : "" }}" role="tab"  aria-selected="false">@lang("Payment")</a>
        </li>
    </ul>
</div>

<div class="tab-content" id="pills-tabContent">
    {!! $slot !!}
</div>