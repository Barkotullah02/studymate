<?php
include "validate.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin panel template by Barkotullah</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/cec-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style type="text/css">
        .profile-data{
            margin-left: 20px; 
            font-family: fantasy;
            font-size: 2rem;
            font-weight: bold;
        }
    </style>


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">NSU CEC ADMIN</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
           
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $full_name; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="settings.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav" style="height: 100%;">
                    <li>
                        <a href="#"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="message.php"><i class="fa fa-fw fa-envelope"></i> Messages</a>
                    </li>
                    <li>
                        <a href="new_admin.php"><i class="fa fa-fw fa-plus"></i> Add new admin</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-table"></i> Forms</a>
                    </li>
                    <li>
                        <a href="post_action.php"><i class="fa fa-edit"></i> Take action to a post</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Other actions <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="">Acvtions</a>
                            </li>

                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" style="background:#e1e0e0ba;">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="container py-4">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card shadow-lg rounded-4 overflow-hidden">
                                <div class="card-body text-center bg-light">
                                    <img
                                            src="admin_img/<?php echo htmlspecialchars($image); ?>"
                                            alt="User Photo"
                                            class="img-fluid rounded-circle border border-3 border-white shadow mb-3"
                                            style="width: 150px; height: 150px; object-fit: cover;"
                                    >
                                    <h4 class="mb-0"><?php echo htmlspecialchars($full_name); ?></h4>
                                    <p class="text-muted small mb-4">Role: <strong><?php echo htmlspecialchars($role); ?></strong></p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-person-fill text-primary fs-5 me-3"></i>
                                        <strong>Name:</strong>
                                        <span class="ms-auto text-secondary"><?php echo htmlspecialchars($full_name); ?></span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-person-badge-fill text-success fs-5 me-3"></i>
                                        <strong>Username:</strong>
                                        <span class="ms-auto text-secondary"><?php echo htmlspecialchars($db_username); ?></span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-shield-lock-fill text-warning fs-5 me-3"></i>
                                        <strong>User Role:</strong>
                                        <span class="ms-auto text-secondary"><?php echo htmlspecialchars($role); ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
