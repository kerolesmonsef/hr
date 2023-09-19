<table>
    <thead>
    <tr><th>{{__('Allowance Option')}}</th>
        <th>{{__('Title')}}</th>
        <th>{{__('Amount')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($allowances as $value => $allowance)
        <tr>
            <td>{{ $allowance->allowance_option() ? $allowance->allowance_option()['name'.$lang] : 'N/A' }} </td>
            <td>{{ $allowance->title }}</td>
            <td>{{  auth()->user()->priceFormat($allowance->amount) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>