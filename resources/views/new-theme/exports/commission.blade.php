<table>
    <thead>
    <tr>
        <th>{{__('Title')}}</th>
        <th>{{__('Amount')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($commissions as $value => $commission)
        <tr>
            <td>{{ $commission->title }}</td>
            <td>{{ auth()->user()->priceFormat($commission->amount) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>