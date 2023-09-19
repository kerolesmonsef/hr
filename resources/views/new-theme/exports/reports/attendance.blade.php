<table border="1">
    @foreach($employeesAttendance as $attendance)
        @php
            $Employee_Join_date = DB::table('employees')->where('id',$attendance['id'])->value('Join_date_gregorian');
        @endphp
        <tr>
            <td>{{$attendance['name']}}</td>
            @foreach($attendance['status'] as $key => $status)
                <td>
                    @if(date("Y-m-d", strtotime(explode('-',$key)[0])) < date("Y-m-d" , strtotime($Employee_Join_date)) )
                        <span style="color:#1a1818!important"> <b> N </b> </span>
                    @elseif($status == 'P')
                        <span style="color:#28a745!important"> <b> P </b> </span>
                    @elseif(in_array( explode('-',$key)[1] , explode(',',$setting->week_vacations ?? '') ))
                        <span style="color:#424443!important"> <b> O </b> </span>
                    @elseif(in_array( date("Y-m-d", strtotime(explode('-',$key)[0])) , $holidays ?? '' ))
                        <span style="color:#377424!important"> <b> H </b> </span>
                    @elseif($status =='A')
                        <span style="color:#990001!important"> <b> A </b> </span>
                    @elseif($status =='V')
                        <span style="color:#786301!important"> <b> V </b> </span>
                    @elseif($status =='S')
                        <span style="color:#C09000!important"> <b> S </b> </span>
                    @elseif($status =='X')
                        <span style="color:#CC4025!important"> <b> X </b> </span>
                    @else
                        -
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
</table>

<script>
      print();
</script>