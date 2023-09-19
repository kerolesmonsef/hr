<table border="1">
    <thead>
    <tr>
        <th>{{ __('Code') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Job Title') }}</th>
        <th>{{ __('Duration') }}</th>
        <th>{{ __('Vacation Type') }}</th>
        <th>{{ __('Status') }}</th>
    </tr>
    </thead>
    <tbody>
    @php
        $status_translate_array = [
            'approved' => __('Approved'),
            'approvedWithDeduction' => __('Approved With Deduction'),
            'pending'  => __('Pending'),
            'rejected' => __('Rejected'),
        ];
    @endphp
    @foreach($vacations as $value => $vacation)
        <tr>
            
            <td>{{ auth() -> user()->employeeIdFormat($vacation->employee->id)  }}</td>
            <td>{{ app()->isLocale('ar') ?  $vacation -> employee -> name_ar : $vacation -> employee -> name }}</td>
            <td> {{ $vacation->employee->jobtitle ? $vacation->employee->jobtitle['name'.$lang] : "N/A" }}</td>
            <td>{{ $vacation -> total_leave_days }} {{ $vacation -> total_leave_days > 1 ? __('Days') : __('Day') }} </td>
            <td>{{ $vacation->leaveType ? $vacation->leaveType->title : "N/A" }}</td>
            <td>{{ $status_translate_array[$vacation -> status] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    window.print();
</script>