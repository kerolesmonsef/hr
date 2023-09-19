<table border="1">
    <thead>
    <tr>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Clock In') }}</th>
        <th>{{ __('Clock Out') }}</th>
        <th>{{ __('Shift Hours') }}</th>
        <th>{{ __('Employees N..') }}</th>
    </tr>
    </thead>
    <tbody>
   
    @foreach($shifts as $value => $shift)
        <tr>
            <td>{{ $shift['name' . $lang] }}</td>
            <td>{{ $shift['shift_starttime'] }}</td>
            <td>{{ $shift['shift_endtime'] }}</td>
            <td>{{ Carbon\Carbon::parse($shift->shift_endtime)->diffInMinutes(Carbon\Carbon::parse($shift->shift_starttime)) / 60 }} </td>
            <td>{{$shift->employees->count() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    print()
</script>