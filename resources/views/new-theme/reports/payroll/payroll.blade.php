@foreach ($payslips as $payroll)
    <tr>
        <td>
            <div class="userTabl user">
                <img src="/new-theme/icons/all/user.svg" />
            </div>
        </td>
        <td>{{ auth()->user()->employeeIdFormat($payroll->employees->id) }}</td>
        <td>{{ $payroll->employees['name' . $lang] }}</td>
        <td>{{ $payroll->employees->jobtitle ? $payroll->employees->jobtitle['name' . $lang] : 'N/A' }}</td>
        <td>{{ $payroll->employees->department ? $payroll->employees->department['name' . $lang] : 'N/A' }}</td>
        <td>{{ auth()->user()->priceFormat($payroll->getNetSalary($payroll->employee_id)) }}</td>
        <td>
            <div class="buttonS2 {{ $payroll->status == 1 ? 'primary' : 'pending' }}">
                {{ $payroll->status == 1 ? __('Paid') : __('Unpaid') }}
            </div>
        </td>
    </tr>
@endforeach