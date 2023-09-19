<table border="1">
    <thead>
    <tr>
        <th>{{__('Code')}}</th>
        <th>{{__('Employee Name')}}</th>
        <th>{{__('Branch')}}</th>
        <th>{{__('Department')}}</th>
        <th>{{__('Job Title')}}</th>
        <th>{{__('Date')}}</th>
        <th>{{__('Overall Rating')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($performances as $value => $performance)
        <tr>
            <td>{{ auth()->user()->employeeIdFormat($performance->employee->id) }}</td>
            <td>{{ $performance->employee ? $performance->employee['name' . $lang] : 'N/A' }}</td>
            <td>{{ $performance->employee->branch ? $performance->employee->branch['name' . $lang] : 'N/A' }}</td>
            <td>{{ $performance->employee->department ? $performance->employee->department['name' . $lang] : 'N/A' }}</td>
            <td>{{ $performance->employee->jobtitle ? $performance->employee->jobtitle['name' . $lang] : 'N/A' }}</td>
            <td>{{ $performance->date}}</td>
            <td>{{ $performance->rate ?? 0}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    print()
</script>