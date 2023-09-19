<table>
    <thead>
        <tr>
            <th>{{__('Code')}}</th>
            <th>{{__('Name')}} </th>
            <th>{{__('Job Title')}} </th>
            <th>{{__('Department')}} </th>
            <th>{{__('employee_shifts')}} </th>
            <th>{{__('Salary')}} </th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
            <tr>
                <td> {{ \Auth::user()->employeeIdFormat($employee->id) }}</td>
                <td> {{ $employee['name' . $lang] }} </td>
                <td> {{ ($employee->jobtitle ? $employee->jobtitle['name' . $lang] : 'N/A') }} </td>
                <td> {{ ($employee->department ? $employee->department['name' . $lang] : 'N/A')  }} </td>
                <td> {{ ($employee->shifts ? $employee->shifts['name' . $lang] : 'N/A')  }} </td>
                <td> {{ \Auth::user()->priceFormat($employee->salary) }} </td>
            </tr>
        @endforeach
    </tbody>
</table>