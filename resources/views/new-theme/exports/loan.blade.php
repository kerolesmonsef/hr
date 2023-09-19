<table>
    <thead>
    <tr>
        <th>{{__('Loan Options')}}</th>
        <th>{{__('Title')}}</th>
        <th>{{__('Reason')}}</th>
        <th>{{__('Loan Amount')}}</th>
        <th>{{__('Pay Date')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($loans as $value => $loan)
        <tr>
            <td>{{!empty($loan->loan_option()) ? $loan->loan_option()->name: 'N/A' }}</td>
            <td>{{ $loan->title }}</td>
            <td>{{ $loan->reason }}</td>
            <td>{{ auth()->user()->priceFormat($loan->discount_monthly) }}</td>
            <td>{{ auth()->user()->dateFormat($loan->date) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>