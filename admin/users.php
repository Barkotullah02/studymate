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
                    <a href="#"><i class="fa fa-fw fa-envelope"></i> Messages</a>
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
                            <a href="">Actions</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <style>
        .search-container {
            position: relative;
        }

        .search-input {
            height: 50px;
            border-radius: 30px;
            padding-left: 35px;
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .search-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #888;
        }
    </style>

    <div id="page-wrapper" style="background:#e1e0e0ba;">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <br class="col-lg-12">
                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="search-container">
                                <input type="text" class="form-control search-input" id="searchid" placeholder="Search...">
                                <i class="fas fa-search search-icon"></i>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-8">
                        <div id="users">

                        </div>
                    </div>
                </div>
                <div class="container justify-content-center">
                <?php
                if (isset($_GET['userid'])) {
                    $users_id = $_GET['userid'];

                    // Fetch profile image & name
                    $getprofileimg   = "SELECT * FROM users WHERE user_id = $users_id";
                    $profileimgresult = mysqli_query($connection, $getprofileimg);
                    while ($row = mysqli_fetch_assoc($profileimgresult)) {
                        $profileimage = $row["image"];
                        $usersname    = $row["name"];
                    }

                    // Fetch detailed info
                    $userdetailsquery  = "SELECT * FROM userdetails WHERE user_id = $users_id";
                    $userdetailsresult = mysqli_query($connection, $userdetailsquery);
                    $userdetails       = mysqli_fetch_array($userdetailsresult);
                    ?>
                    <div class="container py-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="card shadow-lg rounded-4">
                                    <div class="card-header bg-white text-center border-0 pt-4">
                                        <img
                                                src="../users/<?php echo ($profileimage == null) ? 'male.png' : $profileimage; ?>"
                                                alt="<?php echo htmlspecialchars($usersname); ?>"
                                                class="rounded-circle shadow-sm mb-3 img-thumbnail"
                                                style="width: 130px; height: 130px; object-fit: cover;"
                                        >
                                        <h3 class="mb-1"><?php echo htmlspecialchars($usersname); ?></h3>
                                        <p class="text-muted fw-light"><?php echo htmlspecialchars($userdetails['job']); ?></p>
                                    </div>
                                    <ul class="list-group list-group-flush px-4">
                                        <li class="list-group-item d-flex align-items-start">
                                            <i class="bi bi-mortarboard-fill fs-4 text-primary me-3"></i>
                                            <div>
                                                <h6 class="mb-1">Education</h6>
                                                <p class="mb-0 text-secondary"><?php echo htmlspecialchars($userdetails['education']); ?></p>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-start">
                                            <i class="bi bi-briefcase-fill fs-4 text-success me-3"></i>
                                            <div>
                                                <h6 class="mb-1">Organisation</h6>
                                                <p class="mb-0 text-secondary"><?php echo htmlspecialchars($userdetails['company']); ?></p>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-start">
                                            <i class="bi bi-telephone-fill fs-4 text-info me-3"></i>
                                            <div>
                                                <h6 class="mb-1">Phone</h6>
                                                <p class="mb-0 text-secondary"><?php echo htmlspecialchars($userdetails['phone']); ?></p>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-start">
                                            <i class="bi bi-geo-alt-fill fs-4 text-danger me-3"></i>
                                            <div>
                                                <h6 class="mb-1">Address</h6>
                                                <p class="mb-0 text-secondary"><?php echo htmlspecialchars($userdetails['address']); ?></p>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-start">
                                            <i class="bi bi-flag-fill fs-4 text-warning me-3"></i>
                                            <div>
                                                <h6 class="mb-1">Country</h6>
                                                <p class="mb-0 text-secondary"><?php echo htmlspecialchars($userdetails['country']); ?></p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="card-body">
                                        <h6 class="mb-2"><i class="bi bi-chat-left-text-fill me-2"></i>About</h6>
                                        <p class="text-secondary small"><?php echo nl2br(htmlspecialchars($userdetails['about'])); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>

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

<script>
    $(document).ready(function(){
        $("#searchid").keyup(function(e){
            const regex = $('#searchid').val();
            $.ajax({
                url: 'search_id.php',
                type: 'POST',
                data: {
                    search: regex,
                },
                success: function(data){
                    $('#users').html(data);
                }
            });
        });
    });//document ready
</script>

<!-- JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
