<table border="1">
    <thead>
    <tr>
       <th>{{ __('Code') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Job Title') }}</th>
        <th>{{ __('Date') }}</th>       
        <th>{{ __('Start') }}</th>
         <th>{{ __('End') }}</th>
         <th>{{ __('Time') }}</th>
        <th>{{ __('Status') }}</th>
    </tr>
    </thead>
    <tbody>
    @php
        $status_translate_array = [
            'approved' => __('Approved'),
            'pending'  => __('Pending'),
            'rejected' => __('Rejected'),
        ];
    @endphp
    @foreach($overtimerequests as $value => $overtimerequest)
        <tr>
            @php
                $hours = Carbon\Carbon::parse( $overtimerequest -> start)->diffInHours(Carbon\Carbon::parse( $overtimerequest -> end));
            @endphp
            <td>{{ auth() -> user()->employeeIdFormat($overtimerequest->employee?->id)  }}</td>
            <td>{{ app()->isLocale('ar') ?  $overtimerequest -> employee -> name_ar : $overtimerequest-> employee -> name }}</td>
            <td>{{ $overtimerequest->employee->jobtitle ?  $overtimerequest->employee->jobtitle['name'.$lang] : "N/A" }}</td>
            <td>{{ $overtimerequest-> date }}</td>
            <td>{{ $overtimerequest-> start }}</td>
            <td>{{ $overtimerequest-> end }}</td>
            <td>{{ $hours  }} {{ $hours > 1 ? __('Hours') : __('Hour') }} <p>{{ __('From') . ' ' . $overtimerequest->start . ' ' . __('To') . ' ' . $overtimerequest -> end }}</td>
            <td>{{   $status_translate_array[$overtimerequest-> status] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    window.print();
</script>