@extends('admin-master')

@section('title', 'Reports Dashboard')

@section('header_link')
<title></title>
<!-- Latest CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
@endsection

@section('content_title', 'Reports Dashboard')

@section('content')

<div class="container">
    <div class="row" style="margin-top: 10px;">
        <div class="col-md-6">
            <div class="chart-container" style="border: 2px solid #b2b3b5;">
                <div class="pie-chart-container">
                    <canvas id="pie-chart"></canvas>
                </div>
            </div>
            <!-- javascript -->
            <script>
                $(function() {
                    //get the pie chart canvas
                    var cData = JSON.parse(`<?php echo $chart_data; ?>`);
                    var ctx = $("#pie-chart");

                    //pie chart data
                    var data = {
                        labels: cData.label,
                        datasets: [{
                            label: "Users Count",
                            data: cData.data,
                            backgroundColor: [
                                "#DEB887",
                                "#A9A9A9",
                                "#DC143C",
                                "#F4A460",
                                "#2E8B57",
                                "#1D7A46",
                                "#CDA776",
                            ],
                            borderColor: [
                                "#CDA776",
                                "#989898",
                                "#CB252B",
                                "#E39371",
                                "#1D7A46",
                                "#F4A460",
                                "#CDA776",
                            ],
                            borderWidth: [1, 1, 1, 1, 1, 1, 1]
                        }]
                    };

                    //options
                    var options = {
                        responsive: true,
                        title: {
                            display: true,
                            position: "top",
                            text: "Day Wise User Registration",
                            fontSize: 18,
                            fontColor: "#111"
                        },
                        legend: {
                            display: false,
                            position: "bottom",
                            labels: {
                                fontColor: "#333",
                                fontSize: 16
                            }
                        }
                    };

                    //create Pie Chart class object
                    var chart1 = new Chart(ctx, {
                        type: "bar",
                        data: data,
                        options: options
                    });
                });
            </script>
        </div>

        <div class="col-md-6">
            <div class="chart-container" style=" border: 2px solid #b2b3b5;">
                <div class="pie-chart-container">
                    <canvas id="Active-user-chart"></canvas>
                </div>
            </div>
            <!-- javascript -->
            <script>
                $(function() {
                    //get the pie chart canvas
                    var cData = JSON.parse(`<?php echo $isEmailVerified_data; ?>`);
                    var ctx = $("#Active-user-chart");

                    //pie chart data
                    var data = {
                        labels: cData.label,
                        datasets: [{
                            label: "Users Count",
                            data: cData.data,
                            backgroundColor: [
                                "#6f42c1",
                                "#3d788a",
                                "#80643e",
                                "#E39371",
                                "#1D7A46",
                                "#F4A460",
                                "#CDA776",
                            ],
                            borderColor: [
                                "#6f42c1",
                                "#3d788a",
                                "#80643e",
                                "#F4A460",
                                "#2E8B57",
                                "#1D7A46",
                                "#CDA776",
                            ],
                            borderWidth: [1, 1, 1, 1, 1, 1, 1]
                        }]
                    };

                    //options
                    var options = {
                        responsive: true,
                        title: {
                            display: true,
                            position: "top",
                            text: "User Account Verification",
                            fontSize: 18,
                            fontColor: "#111"
                        },
                        legend: {
                            display: true,
                            position: "bottom",
                            labels: {
                                fontColor: "#333",
                                fontSize: 16
                            }
                        }
                    };

                    //create Pie Chart class object
                    var chart2 = new Chart(ctx, {
                        type: "pie",
                        data: data,
                        options: options
                    });
                });
            </script>
        </div>
    </div>
</div>
@endsection