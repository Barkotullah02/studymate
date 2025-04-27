<?php


include "db_connection.php";
session_start();



if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    function escape($data){

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;

    }

    $username = escape($username);
    $password = escape($password);

    $query = "SELECT * FROM admin_user WHERE username = '{$username}'";


    $data = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($data)) {

        $db_username = $row['username'];
        $db_password = $row['password'];
        $full_name = $row['full_name'];
        $role = $row['role'];
        $image = $row['image'];
        // code...


    }
    /*

    * Validating entered data whether it is correct or wrong;
    * Case 1: empty username; Case 2: empty password; Case 3: username & password same as db; Case 4: data missmatch;

    */
    if (empty($username)) {
        header("Location: admin_login.php");
        // code...
    }
    else if (empty($password)) {
        header("Location: admin_login.php");
        // code...
    }

    else if (empty($username) && empty($password)) {
        header("Location: admin_login.php");
        // code...
    }
    else if ($username == $db_username && $password == $db_password) {

        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['image'] = $image;
        $_SESSION['full_name'] = $full_name;
        $_SESSION['role'] = $role;


        header("Location: index.php");
        // code...
    }
    else if(($username != $db_username && $password != $db_password)){

        header("Location: admin_login.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <title>Login to NSU-CEC admin panel</title>

    <style type="text/css">
        body{
            background: #adacac;
            font-family: monospace;
        }
        .form-group{
            margin-top: 10rem;
            width: 50%;
            margin-left: 25%;
            box-shadow: 1px 1px 1px 1px gray;
            padding: 15px;
            background: #a0a8a9;
        }
        @media only screen and (max-width: 720px) {
            .form-group {
                margin-top: 10rem;
                width: 70%;
                margin-left: 15%;
                box-shadow: 1px 1px 1px 1px gray;
                padding: 15px;
                background: #a0a8a9;
            }
    </style>
</head>
<body>

<div class="box" style="height: 5rem;">
    <form class="form-group" action="admin_login.php" method="post">
        <label for="username">Enter username</label>
        <input placeholder="USERNAME" class="form-control" type="text" name="username"><br>
        <label for="password">Enter password</label>
        <input placeholder="PASSWORD" class="form-control" type="password" name="password"><br>
        <p>One click and get access to the admin panel</p>
        <input class="form-control btn btn-primary" type="submit" name="login" value="LOGIN">
    </form>
</div>

</body>
</html>