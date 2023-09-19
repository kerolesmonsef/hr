<table border="1">
    <thead>
    <tr>
        <th>{{ __('Code') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Job Title') }}</th>
        <th>{{ __('Date') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Clock In') }}</th>
        <th>{{ __('Clock Out') }}</th>
        <th>{{ __('Work Hours') }}</th>
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
    @foreach($attendances as $value => $attendance)
        <tr>
            
            <td>{{ $attendance->employee ? auth()->user()->employeeIdFormat($attendance->employee->id) : "N/A" }}</td>
            <td>{{ $attendance->employee ? $attendance->employee['name'.$lang] : "N/A" }}</td>
            <td> {{ $attendance->employee && $attendance->employee->jobtitle ? $attendance->employee->jobtitle['name'.$lang] : "N/A" }}</td>
            <td>{{ $attendance->date }} </td>
            <td>{{ $attendance->status }} </td>
            <td>{{ $attendance->clock_in }} </td>
            <td>{{ $attendance->clock_out }} </td>
            <td>{{ $attendance->work_hours() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
     window.print();
</script>