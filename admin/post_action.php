<?php
include "db_connection.php";
include "validate.php";

$query = "SELECT reports.*, problems.title, problems.problem_img FROM reports JOIN problems ON problems.problem_id = reports.problem_id WHERE reports.problem_id is not null";

$data = mysqli_query($connection, $query);
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
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Messages</a>
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
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="users.php"><i class="fa fa-fw fa-user"></i> Users</a>
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
                        <a href="add_post.php"><i class="fa fa-fw fa-desktop"></i> ADD post</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Other actions <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="add_new_user.php">Add new user</a>
                            </li>
                            <li>
                                <a href="edit_home.php">Edit Homepage</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" style="background:#e1e0e0ba;">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <br class="col-lg-12">
                        <div class="text-center"><b style="color: #ffffff;"><h3>Reports From Problems</h3></b></div>
                        <table class="table">
                            <tr>
                               <th>Problem Title</th><th>Report</th><th class="">ACTION</th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_assoc($data)) {
                                $problemid = $row['problem_id'];
                                $report = $row['description'];
                                $title = $row['title'];
                                ?>

                                <tr>
                                    <td><?php echo $title; ?></td><td><?php echo $report; ?></td><td colspan="2"><a style="" href="delete.php?problemid=<?php echo $problemid;?>"><button class="btn btn-danger" name="delete">DELETE</button></a></td>
                                </tr>

                            <?php } ?>
                        </table
                       <br>
                        <div class="text-center"><b style="color: #ffffff;"><h3>Reports From Courses</h3></b></div>
                        <table class="table">
                            <tr>
                                <th>Problem Title</th><th>Report</th><th class="">ACTION</th>
                            </tr>
                            <?php
                            $courseQuery = "SELECT reports.*, courses.title FROM reports JOIN courses ON courses.course_id = reports.course_id WHERE reports.course_id is not null";
                            $coursereports = mysqli_query($connection, $courseQuery);
                            while ($courseRow = mysqli_fetch_assoc($coursereports)) {
                                $courseid = $courseRow['course_id'];
                                $report = $courseRow['description'];
                                $title = $courseRow['title'];
                                ?>

                                <tr>
                                    <td><?php echo $title; ?></td><td><?php echo $report; ?></td><td colspan="2"><a style="" href="delete.php?courseid=<?php echo $courseid;?>"><button class="btn btn-danger" name="delete">DELETE</button></a></td>
                                </tr>

                            <?php } ?>
                        </table>
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
