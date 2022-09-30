@extends('layout.default')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 230px;
        max-width: 550px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 79%;
        max-width: 150px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: rgb(40, 4, 104);
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #eacaca;
    }

    .highcharts-data-table tr:hover {
        background: #eef0f3;
    }

    input[type="number"] {
        min-width: 50px;
    }


</style>

@section('breadcrumb')
    <div class="row page-title align-items-center">
        <div class="col-sm-4 col-xl-6">
            <h4 class="mb-1 mt-0">Dashboard</h4>
        </div>
    </div>
@endsection

@section('content')
    @include('flash::message')

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body p-0">
                    <div class="media p-3">
                        {{-- {{ dd($results) }} --}}

                        <div id="dom-target" style="display: none;">
                            <?php
                            $inactiveLoans = $results->inactiveLoans;
                            echo htmlspecialchars($inactiveLoans);
                            ?>
                        </div>

                        <div id="dom-target-2" style="display: none;">
                            <?php
                            $paidLoans = $results->paidLoans;
                            echo htmlspecialchars($paidLoans);
                            ?>
                        </div>
                        <div id="dom-target-3" style="display: none;">
                            <?php
                            $rejectedLoans = $results->rejectedLoans;
                            echo htmlspecialchars($rejectedLoans);
                            ?>
                        </div>
                        <div id="dom-target-4" style="display: none;">
                            <?php
                            $activeLoans = $results->activeLoans;
                            echo htmlspecialchars($activeLoans);
                            ?>
                        </div>


                        <div class="media-body">
                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">Active Accounts</span>
                            <h2 class="mb-0">{{ $results->activeAccounts }}</h2>
                        </div>
                        <div class="align-self-center">
                            <div id="today-new-customer-chart" class="apex-charts"></div>
                            {{-- <span class="text-success font-weight-bold font-size-13"><i class='uil uil-arrow-up'></i>
                                25.16%</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body p-0">
                    <div class="media p-3">
                        <div class="media-body">
                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">Active Loans</span>
                            <h2 class="mb-0">{{ $results->activeLoans }}</h2>
                        </div>
                        <div class="align-self-center">
                            <div id="today-new-visitors-chart" class="apex-charts"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body p-0">
                    <div class="media p-3">
                        <div class="media-body">
                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">Repaid Loans</span>
                            <h2 class="mb-0">{{ number_format($results->paidLoans) }}</h2>
                        </div>
                        <div class="align-self-center">
                            <div id="today-revenue-chart" class="apex-charts"></div>
                            {{-- <span class="text-success font-weight-bold font-size-13"><i class='uil uil-user'></i>
                                Users</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body p-0">
                    <div class="media p-3">
                        <div class="media-body">
                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">Inactive Accounts</span>
                            <h2 class="mb-0">{{ number_format($results->inactiveAccounts) }}</h2>
                        </div>
                        <div class="align-self-center">
                            <div id="today-product-sold-chart" class="apex-charts"></div>
                            {{-- <span class="text-danger font-weight-bold font-size-13"><i class='uil uil-user-times'></i>
                                Users</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <body>
        <div class="body">

            <div class="container">
                <div class="row" style="overflow:scroll; height:350px;">
                    <div class="col-6" >
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                        </figure>
                    </div>
                    <div class="col-6">
                        <figure class="highcharts-figure">
                            <div id="container_2"></div>
                        </figure>
                    </div>
                </div>
            </div>


        </div>
    </body>
@endsection

@section('script')
    <script>
        var div_inactive_loans = document.getElementById("dom-target");
        var inactiveLoans = div_inactive_loans.textContent;

        var div_paidLoans = document.getElementById("dom-target-2");
        var paidLoans = div_paidLoans.textContent;

        var div_rejectedLoans = document.getElementById("dom-target-3");
        var rejectedLoans = div_rejectedLoans.textContent;


        var div_activeLoans = document.getElementById("dom-target-4");
        var activeLoans = div_activeLoans.textContent;

        aLoans = parseInt(activeLoans);

        rLoans = parseInt(rejectedLoans);

        ploans = parseInt(paidLoans);

        iLoans = parseInt(inactiveLoans)

        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Pie-Chart Summary of The Loans Application Module'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Loan Status',
                colorByPoint: true,
                data: [{
                    name: 'Active Loans',
                    y: aLoans,
                    sliced: true,
                    selected: true
                }, {
                    name: 'New Loans',
                    y: iLoans
                }, {
                    name: 'Repaid Loans',
                    y: ploans
                }, {
                    name: 'Rejected Loans',
                    y: rLoans
                }]
            }]
        });
        Highcharts.chart('container_2', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'line'
            },
            title: {
                text: 'Line Graph Representation of Loaning Module'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Loan Status',
                colorByPoint: true,
                data: [{
                    name: 'Active Loans',
                    y: aLoans,
                    sliced: true,
                    selected: true
                }, {
                    name: 'New Loans',
                    y: iLoans
                }, {
                    name: 'Repaid Loans',
                    y: ploans
                }, {
                    name: 'Rejected Loans',
                    y: rLoans
                }]
            }]
        });
    </script>
@endsection
