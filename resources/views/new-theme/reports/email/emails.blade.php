@foreach ($employeesEmails as $employee)
<tr>
    <td>
        <div class="userTabl user">
            <img src="/new-theme/icons/all/user.svg" />
        </div>
    </td>
    <td> {{ \Auth::user()->employeeIdFormat($employee->id) }} </td>
    <td>{{ $employee['name' . $lang] }}</td>
    <td>{{ $employee['email'] }}</td>
</tr>
@endforeach