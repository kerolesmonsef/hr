<table border="1">
    <thead>
    <tr>
        <th>{{ __('Job Title') }}</th>
        <th>{{ __('Publish Date') }}</th>
         <th>{{ __('End Date') }}</th>
        <th>{{ __('Applications N...') }}</th>
        <th>{{ __('Status') }}</th>
    </tr>
    </thead>
    <tbody>
    
    @foreach($offers as $value => $offer)
        <tr>
            <td>{{ $offer -> title }} </td>
            <td>{{ $offer -> start_date }}</td>
            <td>{{ $offer -> end_date }}</td>
            <td>{{ $offer -> job_requests ->count() }}</td>
            <td>{{ $offer -> get_status() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    print();
</script>