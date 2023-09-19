<table>
    <thead>
        <tr>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Time from - Time To') }}</th>
            <th>{{ __('Start Time') }}</th>
            <th>{{ __('End Time') }}</th>
            <th>{{ __('Delay in minutes') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($breaks as $break)
            <tr>
                <td>{{ (new \Carbon\Carbon($break->created_at))->format("d/m/Y") }}</td>
                <td>{{ $break?->company_break?->start_time }} - {{ $break?->company_break?->end_time }}</td>
                <td>{{ $break->start_time }} </td>
                <td>{{ $break->end_time }} </td>
                <td>
                    @if(str_contains($break->diff,"-"))
                        0
                    @else
                        {{ $break->diff ?? 0 }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    window.print();
</script>