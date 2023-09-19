<table>
    <thead>
    <tr>
        <th>{{__('Title')}}</th>
        <th>{{__('Number Of Days')}}</th>
        <th>{{__('Start Date')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($absences as $value => $absence)
        <tr>
            <td>{{ $absence->leave != null ? (app()->isLocale('en') ?  $absence->leave->leaveType->title :  $absence->leave->leaveType->title_ar )  : '' }}</td>
            <td>{{ $absence->number_of_days }}</td>
            <td>{{ $absence->start_date }}</td>
        </tr>
    @endforeach
    </tbody>
</table>