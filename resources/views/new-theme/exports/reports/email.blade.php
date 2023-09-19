<table>
    <thead>
        <tr>
            <th> {{__('Code')}} </th>
            <th> {{__('Name')}} </th>
            <th> {{__('Email')}} </th>
        </tr>
    </thead>
    <tbody>
        @foreach($employeesEmails as $employee)
            <tr>
                <td> {{ \Auth::user()->employeeIdFormat($employee->id) }} </td>
                <td>{{ $employee['name' . $lang] }}</td>
                <td>{{ $employee['email'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>