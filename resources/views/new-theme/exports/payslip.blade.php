<table>
    <thead>
        <tr>
            <th>{{ __('Code') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Job Title') }}</th>
            <th>{{ __('Department') }}</th>
            <th>{{ __('Total') }}</th>
            <th>{{ __('Status') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employee_payroll as $value => $payroll)
            <tr>
                <td>{{ auth()->user()->employeeIdFormat($payroll->employees->id) }}</td>
                <td>{{ $payroll->employees['name' . $lang] }}</td>
                <td>{{ $payroll->employees->jobtitle ? $payroll->employees->jobtitle['name' . $lang] : 'N/A' }}</td>
                <td>{{ $payroll->employees->department ? $payroll->employees->department['name' . $lang] : 'N/A' }}</td>
                <td>{{ auth()->user()->priceFormat($payroll->getNetSalary($payroll->employee_id)) }}</td>
                <td>{{ $payroll->status == 1 ? __('Paid') : __('Unpaid') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>