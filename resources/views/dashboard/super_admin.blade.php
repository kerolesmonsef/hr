@extends('layouts.admin')
@section('page-title')
    {{__('Dashboard')}}
@endsection

@section('content')
@if(session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<!--begin::Row-->
<div class="row gy-5 g-xl-8 mb-xl-10">
    <!--begin::Col-->
    <div class="col-xl-12">
        <!--begin::Mixed Widget 3-->
        <div class="card card-xl-stretch mb-xl-8">
            <!--begin::Beader-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1"></span>
                    <span class="text-muted fw-semibold fs-7"></span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body p-0 d-flex flex-column">
                <!--begin::Stats-->
                <div class="card-p pt-5 bg-body flex-grow-1">
                    <canvas style="height: -webkit-fill-available;" class="flot-chart-content" id="flot-dashboard-chart"></canvas>
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 3-->
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->

@endsection

@push('script-page')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script>
        const ctx    = document.getElementById('flot-dashboard-chart').getContext('2d');
        var companies    = <?php echo $companies; ?>;
        var companyEmployeesCount = <?php echo $companyEmployeesCount; ?>;

        const myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: companies,
                datasets: [{
                    label: "",
                    fill: !0,
                    backgroundColor: "rgba(156,204,101,.45)",
                    borderColor: "rgba(156,204,101,1)",
                    pointBackgroundColor: "rgba(156,204,101,1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(156,204,101,1)",
                    data: companyEmployeesCount,
                }, ],
            },
            options: {
                animations: {
                radius: {
                    duration: 400,
                    easing: 'linear',
                    loop: (context) => context.active
                }
                },
                hoverRadius: 12,
                hoverBackgroundColor: 'yellow',
                interaction: {
                mode: 'nearest',
                intersect: false,
                axis: 'x'
                },
                plugins: {
                    tooltips: {
                    callbacks: {
                        label: function(e, r) {
                            return " $ " + e.yLabel;
                        },
                    },
                },
                }
            },
        });
    </script>
@endpush

