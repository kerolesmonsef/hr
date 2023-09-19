<table border="1">
    <thead>
    <tr>
        <th>{{ __('Code') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Date') }}</th>
        <th>{{ __('Job Title') }}</th>
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
    @foreach($permissions as $value => $permission)
        <tr>
            @php
                $hours = Carbon\Carbon::createFromFormat('h:i a' , $permission -> to)->diffInHours(Carbon\Carbon::createFromFormat('h:i a' , $permission -> from));
            @endphp
            <td>{{ auth() -> user()->employeeIdFormat($permission->employee->id)  }}</td>
            <td>{{ app()->isLocale('ar') ?  $permission -> employee -> name_ar : $permission -> employee -> name }}</td>
            <td>{{ $permission -> date }}</td>
            <td>{{ $permission->employee->jobtitle ? $permission->employee->jobtitle['name'.$lang] : "N/A" }}</td>
            <td>{{ $hours  }} {{ $hours > 1 ? __('Hours') : __('Hour') }} <p>{{ __('From') . ' ' . $permission->from . ' ' . __('To') . ' ' . $permission -> to }}</td>
            <td>{{   $status_translate_array[$permission -> status] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    window.print();
</script>