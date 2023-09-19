<table>
    <thead>
    <tr>
        <th>{{__('Deduction options')}}</th>
        <th>{{__('Title')}}</th>
        <th>{{__('Deduction Percent')}}</th>
        <th>{{__('Amount')}}</th>
        <th>{{__('Date')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($saturationdeductions as $value => $saturationdeduction)
        <tr>
            <td>{{ $saturationdeduction->deduction_option() ? $saturationdeduction->deduction_option()['name'.$lang] : 'N/A' }}</td>
            <td>{{ $saturationdeduction->title }}</td>
            <td>{{ $saturationdeduction->percent }} %</td>
            <td>{{ auth()->user()->priceFormat( $saturationdeduction->amount) }}</td>
            <td>{{ auth()->user()->dateFormat($saturationdeduction->date)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>