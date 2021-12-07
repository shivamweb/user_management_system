<!DOCTYPE html>
<html>

<head>
    <title>Reports</title>
    <!-- Latest CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div class="">
        <div class="row">
            <div class="col-md-2">
                <div class="d-flex flex-column flex-shrink-0 bg-light vh-100" style="width: 100px;">
                    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                        <li class="nav-item"> <a href="{{url('admin-dashboard')}}" class="nav-link  py-3 border-bottom"> <i class="fa fa-dashboard"></i> <small>Dashboard</small> </a> </li>
                        <li> <a href="{{url('report')}}" class="nav-link active py-3 border-bottom"> <i class="fa fa-first-order"></i> <small>Report</small> </a> </li>
                        <li> <a href="#" class="nav-link py-3 border-bottom"> <i class="fa fa-cog"></i> <small>Settings</small> </a> </li>
                        <li> <a href="{{ url('user-login-report')}}" class="nav-link py-3 border-bottom"> <i class="fa fa-bookmark"></i> <small>User Login History</small> </a> </li>
                        <li> <a href="{{ route('admin-logout')}}" class="nav-link py-3 border-bottom"> <img src="image/logo.png" alt="mdo" width="24" height="24" class="rounded-circle"> <small>Logout</small> </a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-5">
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

                    <div class="col-md-5">
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
        </div>
    </div>
</body>

</html>