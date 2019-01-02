<?php 
require_once 'connection.php';

if (!logged()) {
    header('location: login.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Digital Bus</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="../vendor/styles.CSS">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Dashboard</a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="account.php">Accounts</a>
                                </li>
                                <li>
                                    <a href="user.php">Registration</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-road fa-fw"></i> Route<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="route.php">Manage</a>
                                </li>
                                <li>
                                    <a href="fare.php">Fare</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="bus.php"><i class="fa fa-car fa-fw"></i> Bus</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-text-o fa-fw"></i> Report<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="report.php">Bus Transaction</a>
                                </li>
                                <li>
                                    <a href="voucher_report.php">Voucher Transaction</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Bus Information</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bus Registration
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <form role="form" action="bus_registration.php" method="POST">
                                        <!--<div class="alert alert-primary" role="alert">
                                        </div>-->
                                        <?php 
                                        if (isset($_SESSION['duplicate'])) {
                                            echo '<div class="alert alert-danger" role="alert">
                                                Bus ID already used.
                                            </div>';

                                        }
                                        unset($_SESSION['duplicate']);
                                         ?>
                                        <div class="form-group">
                                            <label>Bus ID</label>
                                            <input class="form-control" placeholder="Enter Bus ID" name="busid">
                                        </div>
                                        <div class="form-group">
                                            <label>Bus Plate No</label>
                                            <input class="form-control" placeholder="Enter Bus Plate No" name="busplate">
                                        </div>
                                        <!--
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="form-control" name="role">
                                                
                                            </select>
                                        </div>-->
                                        <input type="submit" value="Submit" class="btn btn-primary btn-block">
                                        <input type="reset" value="Reset" class="btn btn-default btn-block">
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-8">
                                    <div class="panel panel-default">
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="col-table table-responsive">
                                                <div class="table-responsive-md">
                                                     <?php require('show_bus.php') ?>
                                                    <!-- /.table-responsive -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bus Route Assignment
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <form role="form" action="bus_route_registration.php" method="POST">
                                        <!--<div class="alert alert-primary" role="alert">
                                        </div>-->
                                        <?php 
                                        if (isset($_SESSION['duplicate2'])) {
                                            echo '<div class="alert alert-danger" role="alert">
                                                Terjadi Kesalahan.
                                            </div>';

                                        }
                                        unset($_SESSION['duplicate2']);
                                         ?>
                                        <div class="form-group">
                                            <label>Bus ID</label>
                                            <select class="form-control" name="bus_id_route">
                                                <?php 
                                                    require ('connection.php');
                                                    error_reporting(E_PARSE);

                                                    $sql_showbusid_route = "SELECT * FROM bus  ORDER BY bus_id + 0 ";
                                                    $result_showbusid_route = $conn->query($sql_showbusid_route);

                                                    if ($result_showbusid_route->num_rows > 0) {
                                                        while ($row = $result_showbusid_route->fetch_assoc()) {
                                                             echo '<option value="'.$row["bus_id"].'">'.$row[bus_id].' ('.$row['plate_no'].')</option>';
                                                         }
                                                    }else{
                                                        echo 'Error';
                                                    }

                                                    mysqli_free_result($result_showbusid_route);
                                                    mysqli_close($conn)
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Route</label>
                                            <select class="form-control" name="route">
                                                <?php 
                                                    require ('connection.php');
                                                    error_reporting(E_PARSE);

                                                    $sql_showroute = "SELECT * FROM route ORDER BY route_id";
                                                    $result_showroute = $conn->query($sql_showroute);

                                                    if ($result_showroute->num_rows > 0) {
                                                        while ($row = $result_showroute->fetch_assoc()) {
                                                             echo '<option value="'.$row["route_id"].'">'.$row[route_start].' - '.$row[route_end].'</option>';                                                        }
                                                    }else{
                                                        echo 'Error';
                                                    }

                                                    mysqli_free_result($result_showroute);
                                                    mysqli_close($conn);

                                                ?>
                                            </select>
                                        </div>
                                        <input type="submit" value="Submit" class="btn btn-primary btn-block">
                                        <input type="reset" value="Reset" class="btn btn-default btn-block">
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-8">
                                    <div class="panel panel-default">
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="col-table table-responsive">
                                                <div class="table-responsive-md">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Bus ID</th>
                                                                <th>Bus Plate</th>
                                                                <th>Route Start</th>
                                                                <th>Route End</th>
                                                                <th>Fare</th>
                                                                <th>QR Code</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                require ('connection.php');
                                                                error_reporting(E_PARSE);

                                                                $sql_showbus_nroute = "SELECT bus.bus_id,bus.route_id, bus.plate_no, route.route_start, route.route_end, busfare.fare FROM bus JOIN route ON bus.route_id=route.route_id JOIN busfare ON route.fare_id = busfare.fare_id WHERE bus.route_id IS NOT NULL ORDER BY bus.bus_id +0 ASC";
                                                                $result_showbusnroute = $conn->query($sql_showbus_nroute);

                                                                $errorCorrectionLevel = 'H';
                                                                $matrixPointSize = 8;
                                                                $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'QR'.DIRECTORY_SEPARATOR;
                                                                $PNG_WEB_DIR = 'QR/'; 
                                                                
                                                                if ($result_showbusnroute->num_rows > 0) {
                                                                    while ($row = $result_showbusnroute->fetch_assoc()) {
                                                                        $filename = $PNG_WEB_DIR.basename(md5(($row[bus_id].$row[route_id]).'|'.$errorCorrectionLevel.'|'.$matrixPointSize));
                                                                        //$temp = $PNG_WEB_DIR.basename($filename);
                                                                        //md5(($row[bus_id].$row[route_id]).'|'.$errorCorrectionLevel.'|'.$matrixPointSize)
                                                                        //$PNG_WEB_DIR.basename(md5(($row[bus_id].$row[route_id]).'|'.$errorCorrectionLevel.'|'.$matrixPointSize)).'.png
                                                                        echo '<tr>
                                                                        <td>'.$row[bus_id].'</td>
                                                                        <td>'.$row[plate_no].'</td>
                                                                        <td>'.$row[route_start].'</td>
                                                                        <td>'.$row[route_end].'</td>
                                                                        <td>'.$row[fare].'</td>
                                                                        <td><img src="'.$PNG_WEB_DIR.basename($filename).'.png" height="100px" /></td>
                                                                        <td><a href="'.$PNG_WEB_DIR.basename($filename).'.png" download class="btn btn-success">Download</a></td>
                                                                        </tr>';
                                                                    }
                                                                }else{
                                                                    echo '<tr>
                                                                    <td> No Data </td><td> No Data </td><td> No Data </td><td> No Data </td><td> No Data </td><td> No Data </td><td> No Data </td></tr>';
                                                                }

                                                                mysqli_free_result($result_showbusnroute);
                                                                mysqli_close($conn);

                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <!-- /.table-responsive -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
