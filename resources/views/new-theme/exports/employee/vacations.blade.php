<table>
    <thead>
        <tr>
            <th>{{__('Name')}}</th>
            @foreach (\App\Models\LeaveType::all() as $leaveType)
                <th>{{ $leaveType->{'title' . $lang} }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $employee->name }}</td>
            @foreach (\App\Models\LeaveType::all() as $leaveType)
                <td>
                    <?php
                    $com = 0;
                    $leaves = \App\Models\Leave::query()
                        ->where('employee_id', $employee->id)
                        ->where('leave_type_id', $leaveType->id)
                        ->get()
                        ->each(function (\App\Models\Leave $leave) use (&$com) {
                            $start = new \Carbon\Carbon($leave->start_date);
                            $end = new \Carbon\Carbon($leave->end_date);
                            $com += $start->diffInDays($end);
                        });
                    
                    ?>
                    {{ $com }} @lang('Days')

                </td>
            @endforeach
        </tr>
    </tbody>
</table>