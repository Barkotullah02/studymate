<?php
include "db_connection.php";
include "validate.php";

if (isset($_POST['update'])) {

    $password = $_POST['password'];


    /*
    * Updating user data if the password matches
    */
    if ($password == $db_password) {

        $username = $_POST['username'];
        $fullName = $_POST['full_name'];
        $image = $_FILES['image']['name'];
        $tmp_image = $_FILES['image']['tmp_name'];

        $username = mysqli_real_escape_string($connection, $username);
        $fullName = mysqli_real_escape_string($connection, $fullName);
        $image = mysqli_real_escape_string($connection, $image);

        $query = "UPDATE admin_user SET ";
        $query .= "username = '$username', ";
        $query .= "full_name = '$fullName' ";
        $query .= "WHERE password = '$password'";

        $update = mysqli_query($connection, $query);

        if (empty($image)) {

            echo "Image not entered";
        }
        
        else if (!empty($image)) {

        /*
        * Updating image if image had entered
        */

        $img_query = "UPDATE admin_user SET ";
        $img_query .= "image = '$image' ";
        $img_query .= "WHERE password = '$password'";

        $img_update = mysqli_query($connection, $img_query);

        move_uploaded_file($tmp_image, "admin_img/$image");
        }

        

    }

    else if($password != $db_password){

        echo "Failed to update";

    }


    
}

if (isset($_POST['delete_password'])) {

    $delete_password = $_POST['delete_password'];


    /*
    * Updating user data if the password matches
    */
    if ($delete_password == $db_password) {
        $delete = "DELETE FROM admin_user ";
        $delete .= "WHERE password = '$delete_password' ";

        $delete_query = mysqli_query($connection, $delete);
        header("Location: logout.php");
    }

    else if($delete_password != $db_password){

        echo "Failed to delete";

    }
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
                        <a href="#"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
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
                        <div class="container-fluid col-xs-12">
                            <form action="settings.php" method="post" enctype="multipart/form-data" class="form-group">
                            <label for="full_name" >Full name</label>
                            <input class="form-control" value="<?php echo $full_name; ?>" type="text" name="full_name"><br>
                            <label for="image" >Update image</label>
                            <input class="form-control" type="file" name="image"><br>
                            <label for="username" >Update username</label>
                            <input class="form-control" value="<?php echo $db_username; ?>" type="text" name="username"><br>
                            <label for="password" >Enter your password to update data</label>
                            <input class="form-control" placeholder="password" type="password" name="password"><br>
                            <input class="form-control btn btn-primary" value="UPDATE DATA" type="submit" name="update"><br>
                        </form>
                        <form action="settings.php" method="post" class="form-group">
                            <label for="password" >Enter your password to delete account</label>
                            <input class="form-control" placeholder="password" type="password" name="delete_password"><br>
                            <input class="btn btn-danger" value="DELETE ACCOUNT" type="submit" name="delete"><br>
                        </form>
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
