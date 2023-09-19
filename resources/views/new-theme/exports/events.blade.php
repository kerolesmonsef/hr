<table border="1">
    <tr>
        <td>title</td>
        <td>start date</td>
        <td>end date</td>
        <td>description</td>
    </tr>
    @foreach($events as $event)
        <tr>
            <td>{{$event->title}}</td>
            <td>{{$event->start_date}}</td>
            <td>{{$event->end_date}}</td>
            <td>{{$event->description}}</td>

        </tr>
    @endforeach
</table>
<script>
    window.print();
</script>