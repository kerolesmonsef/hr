<table>
    <thead>
    <tr>
        <th>{{__('Title')}}</th>
        <th>{{__('Amount')}}</th>
        <th>{{__('Date')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($otherpayments as $value => $otherpayment)
        <tr>
            <td>{{ $otherpayment->title }}</td>
            <td>{{  auth()->user()->priceFormat($otherpayment->amount) }}</td>
            <td>{{  auth()->user()->dateFormat($otherpayment->date) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>