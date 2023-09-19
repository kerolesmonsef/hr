<table border="1">
    <tr>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Start Date') }}</th>
        <th>{{ __('End Date') }}</th>
        <th>{{ __('Employees N..') }}</th>
        <th>@lang('Done')</th>
        <th>@lang('Left')</th>
        <th>@lang('Status')</th>
    </tr>

    @foreach ($evaluations as $value => $evaluation)
        <tr data-row-key="{{ $value }}" class="ant-table-row ant-table-row-level-0">
            <td>
                {{ $evaluation->title }}
            </td>
            <td>
                {{ $evaluation->start_date }}
            </td>
            <td>
                {{ $evaluation->end_date }}
            </td>
            <td>
                
                {{ $evaluation->childs_count }}
            </td>
            <td>
                
                {{ $evaluation->done_childs_count }}
            </td>
            <td>
                
                {{ $evaluation->childs_count - $evaluation->done_childs_count }}
            </td>
            <td>
                
                @php
                    $status_attr = $evaluation->get_status();
                @endphp
                <div class="buttonS2 {{ $status_attr['class'] }}">{{ $status_attr['status'] }}</div>
            </td>
        </tr>

    @endforeach

</table>

<script>
    print();
</script>