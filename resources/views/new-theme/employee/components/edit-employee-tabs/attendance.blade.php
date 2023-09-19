<div class="tab-pane show active" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
    <div class="row mb-4">
        <div class="col-12 col-lg-6">
            <div class="sectionS1">
                <div class="flex align between mb-3 options">
                    <div class='purchasesContent flex align gap-5'>
                        <h3>{{__('Attendance Summary')}}</h3>
                    </div>
                    <div style="width: 145px">
                        <div class="inputS1 noHeight">
                            <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg" />
                            <input type="text" value="{{$carbonyear}}/{{$carbonmonth}}" placeholder="07/2023" name="datepicker"
                                class="datePickerMonth datePickerSelect" autocomplete="off" style="height: 35px">
                        </div>
                    </div>
                </div>
                <div class="salesPurchasesWrapper">
                    <canvas id="attendanceSummary" style='width: 100%; height: 278px'></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class='sectionS1 mb-4'>
                <div class='headerTitle'>{{__('Delays')}}</div>
                <div class='attendanceCard flex'>
                    <div class='content'>
                        <div class='number'>{{ $employee->getEmployeeDelays(0, 15,$carbonmonth,$carbonyear) }} </div>
                        <div class='description'>0-15 {{__('MIN')}}</div>
                    </div>
                    <div class='content'>
                        <div class='number'>{{ $employee->getEmployeeDelays(16, 30,$carbonmonth,$carbonyear) }}</span></div>
                        <div class='description'>16-30 {{__('MIN')}}</div>
                    </div>
                    <div class='content'>
                        <div class='number'>{{ $employee->getEmployeeDelays(31, 60,$carbonmonth,$carbonyear) }}</span></div>
                        <div class='description'>31-60 {{__('MIN')}}</div>
                    </div>
                    <div class='content'>
                        <div class='number'>{{ $employee->getEmployeeDelays(61, null,$carbonmonth,$carbonyear) }}</div>
                        <div class='description'>61-... {{__('MIN')}}</div>
                    </div>
                </div>
            </div>
            <div class='sectionS1 mb-4'>
                <div class='headerTitle'>{{__('Attendance OverTime')}}</div>
                <div class='attendanceCard flex'>
                    <div class='content'>
                        <div class='number'>{{ $employee->getEmployeeOverTimes(0, 15) }}</span></div>
                        <div class='description'>0-15 {{__('MIN')}}</div>
                    </div>
                    <div class='content'>
                        <div class='number'>{{ $employee->getEmployeeOverTimes(16, 30) }}</span></div>
                        <div class='description'>16-30 {{__('MIN')}}</div>
                    </div>
                    <div class='content'>
                        <div class='number'>{{ $employee->getEmployeeOverTimes(31, 60) }}</div>
                        <div class='description'>31-60 {{__('MIN')}}</div>
                    </div>
                    <div class='content'>
                        <div class='number'>{{ $employee->getEmployeeOverTimes(61, null) }}</div>
                        <div class='description'>61-... {{__('MIN')}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class='sectionS2'>
        <div class="head withBorder flex align between">
            <h3 class='small'>{{__('Attendance History')}}</h3>
            <div class='flex align gap-3'>

                <div class="" style="width: 145px; margin: 22px; margin-inline-start: auto">
                    <div class="inputS1">
                        <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg" />
                        <input type="text" value="{{$carbonyear}}/{{$carbonmonth}}" placeholder="07/2023" name="datepicker"
                            class="datePickerMonth datePickerSelect" autocomplete="off" style="height: 35px">
                    </div>
                </div>

                <button class='buttonS2  withBorder'>
                    <img src="{{ asset('new-theme/icons/all/print.svg') }}" class="iconImg" />
                    {{__('Print')}}
                </button>

                <a href="{{ Route('attendancereport.export',[$carbonmonth.'-'.$carbonyear]) }}?employee={{$employee->id}}">
                    <button class='buttonS2 withBorder'>
                        <img src="{{ asset('new-theme/icons/all/download.svg') }}" class="iconImg" />
                        {{__('Export')}}
                    </button>
                </a>

            </div>
        </div>

        <div class="pieChartLabel content">
            <div class="row">
                
                <div class="col-12 col-lg-3">
                    <div class="analyticsCard">
                        <div class="number">
                            <div class="boxColor" style="background: #98B37C"></div> {{__('Present')}} =  P
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="analyticsCard">
                        <div class="number">
                            <div class="boxColor" style="background: #C78394"></div> {{__('Weekend')}} = W
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="analyticsCard">
                        <div class="number">
                            <div class="boxColor" style="background: #FFA800"></div> {{__('Absent With Permission')}}= A
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="analyticsCard">
                        <div class="number">
                            <div class="boxColor" style="background: #FF3D00"></div> {{__('Absent Without Permission')}} = X
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="analyticsCard">
                        <div class="number">
                            <div class="boxColor" style="background: #61A2AF"></div> {{__('Holiday')}} = H
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="analyticsCard">
                        <div class="number">
                            <div class="boxColor" style="background: #E75894"></div> {{__('Leaves')}} = L
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        

        <div class="tableS1 scroll">
            <table>
                <thead>
                    <tr>
                        <th>
                            {{__('Name')}}
                        </th>
                        @foreach ($dates as $date)
                            <th>{{ explode('/', $date)[2] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeesAttendance as $attendance)
                        <tr>
                            <td>{{ $attendance['name'] }}</td>
                            @foreach ($attendance['status'] as $key => $status)
                                <td>
                                    @if ($status == 'P')
                                        <span style="color:#98B37C!important"> <b> P
                                            </b> </span>
                                    @elseif(in_array(explode('-', $key)[1], explode(',', $setting->week_vacations ?? '')))
                                        <span style="color:#C78394!important"> <b> W
                                            </b> </span>
                                    @elseif(in_array(date('Y-m-d', strtotime(explode('-', $key)[0])), $holidays ?? []))
                                        <span style="color:#61A2AF!important"> <b> H
                                            </b> </span>
                                    @elseif($status == 'A')
                                        <span style="color: #FFA800 !important"> <b> A
                                            </b> </span>
                                    @elseif($status == 'V')
                                        <span style="color:#E75894!important"> <b> L
                                            </b> </span>
                                    @elseif($status == 'S')
                                        <span style="color:#C09000!important"> <b> S
                                            </b> </span>
                                    @elseif($status == 'X')
                                        <span style="color:#FF3D00!important"> <b> X
                                            </b> </span>
                                    @else
                                        -
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@push("script")
    <script src="{{ asset("js/chart.js") }}"></script>

    <script>
        const cta = document.getElementById("attendanceSummary");

        let xValues   = ["Delays", "Over Time", "Absence", "Leaves"];
        let yValues   = [{{ $lateHours }}, {{ $ovetimeHours }}, {{ $absencesCount }}, {{ $totalLeave }}];
        let barColors = ["#98B37C", "#C78394", "#61A2AF", "#FFA800"];

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "World Wine Production 2018"
                }
            }
        });

        new Chart(cta, {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                barPercentage: 1,
                plugins: {
                    legend: {
                        display: false,
                        align: "end",
                        labels: {
                            usePointStyle: true,
                            pointStyle: "circle",
                            boxWidth: 8,
                            boxHeight: 8,
                        },
                    },
                },
                scales: {
                    xAxes: [{
                        categoryPercentage: 0.0,
                        barPercentage: 0.0,
                    }, ],
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>
    <script>
        $(".datePickerSelect").change(function() {
            window.location.href = window.location.href.split('?')[0] + "?date=" + $(this).val();
        })
    </script>
@endpush
