<table>
    <thead>
    <tr>
         <th>{{ __('Name') }}</th>
        <th>{{ __('Documents N..') }}</th>
        <th>{{ __('Date') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $value => $category)
        <tr>
            <td> {{ app() -> isLocale('en') ? $category -> name : $category -> name_ar }} </td>
            <td> {{ $category -> documents -> count() }} </td>
            <td> {{ $category -> date }} </td>
        </tr>
    @endforeach
    </tbody>
</table>