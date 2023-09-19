<table border="1">
    <thead>
    <tr>
        <th>{{ __('Code') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Date') }}</th>
        <th>{{ __('Job Title') }}</th>
        <th>{{ __('Amount') }}</th>
        <th>{{ __('Status') }}</th>
    </tr>
    </thead>
    <tbody>
    @php
        $status_class_array = [
            'approved' => 'success',
            'pending' => 'pending',
            'rejected' => 'danger',
        ];
        
        $status_translate_array = [
            'approved' => __('Approved'),
            'pending' => __('Pending'),
            'rejected' => __('Rejected'),
        ];
    @endphp
    @foreach($loans as $value => $loan)
        <tr>
            <td> {{ auth()->user()->employeeIdFormat($loan->employee->id) }}</td>
            <td> {{ app()->isLocale('ar') ? $loan->employee->name_ar : $loan->employee->name }}</td>
            <td>{{ $loan -> start_date }}</td>
            <td>{{ $loan->employee->jobtitle ? $loan->employee->jobtitle['name' . $lang] : 'N/A' }}</td>
            <td>{{ $loan -> amount }}</td>
            <td>{{ $status_translate_array[$loan->status] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    print();
</script>