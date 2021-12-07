<!DOCTYPE html>
<html>

<head>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<body>
    <div class="row">
        <div class="col-md-2">
            <div class="d-flex flex-column flex-shrink-0 bg-light vh-100" style="width: 100px;">
                <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                    <li class="nav-item"> <a href="{{url('admin-dashboard')}}" class="nav-link  py-3 border-bottom"> <i class="fa fa-dashboard"></i> <small>Dashboard</small> </a> </li>
                    <li> <a href="{{url('report')}}" class="nav-link  py-3 border-bottom"> <i class="fa fa-first-order"></i> <small>Report</small> </a> </li>
                    <li> <a href="#" class="nav-link py-3 border-bottom"> <i class="fa fa-cog"></i> <small>Settings</small> </a> </li>
                    <li> <a href="{{ url('user-login-report')}}" class="nav-link active py-3 border-bottom"> <i class="fa fa-bookmark"></i> <small>User Login History</small> </a> </li>
                    <li> <a href="{{ route('admin-logout')}}" class="nav-link py-3 border-bottom"> <img src="image/logo.png" alt="mdo" width="24" height="24" class="rounded-circle"> <small>Logout</small> </a> </li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
            <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
            <div class="container">
                <div class="row header" style="text-align:center;color:green">
                    <h3>User Login an Logout History</h3>
                </div>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>System Name</th>
                            <th>Login Time</th>
                            <th>Logout Time</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Samso Nigore</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2018/04/25</td> 
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5">njdnkf</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>

</html>