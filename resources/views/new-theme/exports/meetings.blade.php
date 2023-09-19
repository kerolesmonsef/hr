<table border="1">
    <tr>
        <td>title</td>
        <td>date</td>
        <td>time</td>
        <td>note</td>
        <td>url</td>
        <td>duration</td>
        <td>location</td>
    </tr>
    @foreach($meetings as $meeting)
        <tr>
            <td>{{$meeting->title}}</td>
            <td>{{$meeting->date}}</td>
            <td>{{$meeting->time}}</td>
            <td>{{$meeting->note}}</td>
            <td>{{$meeting->url}}</td>
            <td>{{$meeting->duration}}</td>
            <td>{{$meeting->location}}</td>
        </tr>
    @endforeach
</table>
<script>
    window.print();
</script>