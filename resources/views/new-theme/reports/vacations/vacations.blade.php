@foreach ($employees as $employee )
    <tr>
        <td>{{ app()->isLocale('en') ? $employee->name : $employee->name_ar }}</td>
        <td>{{ $employee-> annual_leave_entitlement}} {{ __('Days') }}</td>
        @foreach($leaveTypes as $leaveType)
            <td>{{ $employee->getCurrentYearLeaves($currentYear)->where('leave_type_id' ,$leaveType->id)->sum('total_leave_days')}} {{ __('Days') }}</td>
        @endforeach
    </tr>
@endforeach