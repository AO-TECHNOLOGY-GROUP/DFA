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


@section('content')
@include('flash::message')

<h5>ACCOUNT SUMMARY</h5>
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body p-0">
                <div class="media p-3">
                    <div id="dom-target" style="display: none;">

                    </div>

                    <div id="dom-target-2" style="display: none;">

                    </div>
                    <div id="dom-target-3" style="display: none;">

                    </div>
                    <div id="dom-target-4" style="display: none;">

                    </div>
                    <div class="media-body">

                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Total Accounts <br>
                            Opened</span>
                    </div>
                    <div class="align-self-center">
                        <div id="today-new-customer-chart" class="apex-charts"></div>
                        <span class="text-success font-weight-bold font-size-20"><i class='uil uil-align-center-v'></i>
                            {{  $acc_success  }}</span>
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
                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Pending Accounts</span>
                    </div>
                    <div class="align-self-center">
                        <div id="today-new-customer-chart" class="apex-charts"></div>
                        <span class="text-success font-weight-bold font-size-20"><i class='uil uil-align-center-v'></i>
                            {{   $acc_pending }}</span>
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
                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Accounts Rejected</span>
                    </div>
                    <div class="align-self-center">
                        <div id="today-new-customer-chart" class="apex-charts"></div>
                        <span class="text-success font-weight-bold font-size-20"><i class='uil uil-align-center-v'></i>
                            {{    $acc_rejected }}</span>
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
                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Accounts Partially
                            <br>Approved</span>
                    </div>
                    <div class="align-self-center">
                        <div id="today-new-customer-chart" class="apex-charts"></div>
                        <span class="text-success font-weight-bold font-size-20"><i class='uil uil-align-center-v'></i>
                            {{     $acc_partiallyapproved }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<h5>LOANS SUMMARY</h5>
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body p-0">
                <div class="media p-3">
                    <div id="dom-target" style="display: none;">

                    </div>

                    <div id="dom-target-2" style="display: none;">

                    </div>
                    <div id="dom-target-3" style="display: none;">

                    </div>
                    <div id="dom-target-4" style="display: none;">

                    </div>
                    <div class="media-body">

                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Loans Approved</span>
                    </div>
                    <div class="align-self-center">
                        <div id="today-new-customer-chart" class="apex-charts"></div>
                        <span class="text-success font-weight-bold font-size-20"><i class='uil uil-align-center-v'></i>
                            {{  $acc_success  }}</span>
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
                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Pending Loans</span>
                    </div>
                    <div class="align-self-center">
                        <div id="today-new-customer-chart" class="apex-charts"></div>
                        <span class="text-success font-weight-bold font-size-20"><i class='uil uil-align-center-v'></i>
                            {{   $acc_pending }}</span>
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
                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Loans Rejected</span>
                    </div>
                    <div class="align-self-center">
                        <div id="today-new-customer-chart" class="apex-charts"></div>
                        <span class="text-success font-weight-bold font-size-20"><i class='uil uil-align-center-v'></i>
                            {{    $acc_rejected }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<body>

    <div class="row" style="overflow:scroll; height:350px;">
        <div class="col-6">
            <canvas id="bar-chart-grouped" width="790" height="450"></canvas>
        </div>

        <div class="col-6">
            <canvas id="pie-chart" width="790" height="450"></canvas>
        </div>
</div>

<div class="col-md-6 col-xl-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="media p-3">
                    <div class="media-body">
                        <span class="text-muted text-uppercase font-size-12 font-weight-bold"></span>
                    </div>
                    <div class="align-self-center">
                        <div id="today-new-customer-chart" class="apex-charts"></div>
                        <span class="text-success font-weight-bold font-size-20"><i class='uil uil-align-center-v'></i>
                            {{   $acc_pending }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
new Chart(document.getElementById("bar-chart-grouped"), {
    type: 'bar',
    data: {
        labels: ["January", "March", "June", "September", "December"],
        datasets: [{
            label: "Accounts",
            backgroundColor: "#3e95cd",
            data: [ {{$acc_success}}, 22, 0, 38, 22]
        }, {
            label: "Loans",
            backgroundColor: "#8e5ea2",
            data: [2, 57, 67, 74, 2]
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Account and Loan Statistics'
        }
    }
});


new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
        labels: ["Accounts", "Loans"],
        datasets: [{
            label: "Account and Loan Summary",
            backgroundColor: ["#3e95cd", "#8e5ea2"],
            data: [3, 8]
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Account and Loans Summary'
        }
    }
});
</script>
@endsection