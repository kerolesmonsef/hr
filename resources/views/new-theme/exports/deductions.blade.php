<table>
    <thead>
    <tr>
        <th>{{__('Code')}}</th>
        <th>{{__('Name')}}</th>
        <th>{{__('Job Title')}}</th>
        <th>{{__('Department')}}</th>
        <th>{{__('Deduction Percent')}}</th>
        <th>{{__('Date')}}</th>
        <th>{{__('Reason')}}</th>
    </tr>
    </thead>
    <tbody>
        @foreach($deductions as $value => $deduction)
            <tr>
                <td>{{ \Auth::user()->employeeIdFormat($deduction->employee ? $deduction->employee->id : 'N/A') }}</td>
                <td>{{ $deduction->employee ? $deduction->employee->{'name'.$lang} : 'N/A' }} </td>
                <td>{{ ($deduction->employee && $deduction->employee->jobtitle ? $deduction->employee->jobtitle['name' . $lang] : 'N/A') }}</td>
                <td>{{ ($deduction->employee && $deduction->employee->department ? $deduction->employee->department['name' . $lang] : 'N/A')  }}</td>
                <td>{{$deduction->percent ?? 0}} %</td>
                <td>{{$deduction->date}}</td>
                <td>{{$deduction->title}}</td>
            </tr>
        @endforeach
    </tbody>
</table>