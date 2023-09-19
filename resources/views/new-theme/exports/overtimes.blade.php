<table>
    <thead>
    <tr>
        <th>{{__('Title')}}</th>
        <th>{{__('Number Of Days')}}</th>
        <th>{{__('Hours')}}</th>
        <th>{{__('Amount')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($overtimes as $value => $overtime)
        <tr>
            <td>{{ $overtime->title }}</td>
            <td>{{ $overtime->number_of_days }}</td>
            <td>{{ $overtime->hours }}</td>
            <td>{{  auth()->user()->priceFormat($overtime->rate) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>