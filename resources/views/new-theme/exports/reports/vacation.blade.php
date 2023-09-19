<table>
    <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Leave credit') }}</th>
            @foreach ($leaveTypes as $leaveType)
                <th>{{ app()->isLocale('en') ?  $leaveType->title : $leaveType->title_ar }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee )
            <tr>
                <td>{{ app()->isLocale('en') ? $employee->name : $employee->name_ar }}</td>
                <td>{{ $employee->annual_leave_entitlement}} {{ __('Days') }}</td>
                @foreach($leaveTypes as $leaveType)
                    <td>{{ $employee->getCurrentYearLeaves($currentYear)->where('leave_type_id' ,$leaveType->id)->sum('total_leave_days')}} {{ __('Days') }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>