<table border="1">
    <thead>
    <tr>
        <th>{{ __('Code') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Date') }}</th>
        <th>{{ __('Start') }}</th>
        <th>{{ __('End') }}</th>
        <th>{{ __('Job Title') }}</th>
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
    @foreach($requests as $value => $request)
        <tr>
            <td>{{ auth() -> user()->employeeIdFormat($request->employee->id)  }}</td>
            <td>{{ app()->isLocale('ar') ?  $request -> employee -> name_ar : $request -> employee -> name }}</td>
            <td>{{ $request -> date }}</td>
             <td>{{ $request -> start }}</td>
              <td>{{ $request -> end }}</td>
            <td>{{ $request->employee->jobtitle ? $request->employee->jobtitle['name'.$lang] : "N/A" }}</td>
            <td>{{   $status_translate_array[$request -> status] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    window.print();
</script>