<canvas id="attendanceSummary" style='width: 100%; height: 300px'></canvas>

<script>
    function ready(fn){
        if(typeof $ !== "undefined") { 
            return $(fn);
        }
        window.addEventListener('load', fn);
    }

    ready(function () {
        const cta = document.getElementById("attendanceSummary");

        var chartBar = new Chart(cta, {
            type: "bar",
            data: {
                labels: {!! json_encode($days,true) !!},
                datasets: [{
                        label: "{{__('Attendance')}}",
                        data: @json($attendanceChartArr),
                        backgroundColor: "#61A2AF",
                    },
                    {
                        label: "{{__('Permission')}}",
                        data: @json($permissionChartArr),
                        backgroundColor: "#98B37C",
                    },
                    {
                        label: "{{__('Vacation')}}",
                        data: @json($vacationChartArr),
                        backgroundColor: "#C78394",
                    },
                    {
                        label: "{{__('Employee Late')}}",
                        data: @json($lateChartArr),
                        backgroundColor: "#FFA800",
                    },
                    {
                        label: "{{__('Overtime')}}",
                        data: @json($overtimeChartArr),
                        backgroundColor: "#E75894",
                    },
                ],
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
    });
</script>
