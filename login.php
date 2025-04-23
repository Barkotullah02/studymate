<?php
session_start();
ob_start();
$_SESSION['uemail'] = '';
$_SESSION['uname'] = '';
$_SESSION['umode'] = '';
$_SESSION['uimage'] = '';
include 'db_connection.php';
function escape_data($data){
    include 'db_connection.php';

    $data = trim($data);

    $data = stripslashes($data);

    $data = htmlspecialchars($data);

    $data = mysqli_real_escape_string($connection, $data);


    return $data;

}

   if(isset($_POST['signup'])){
    $name = escape_data($_POST['signupName']);
    $email = escape_data($_POST['signupEmail']);
    $password = escape_data($_POST['signupPass']);
    $re_pass = escape_data($_POST['re_pass']);
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    echo $name;
    echo $email;
    echo $password;
    echo $re_pass;

     if($password == $re_pass){
         // Hash the password


         // Insert user data into database
         $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_pass')";
        
         $result = mysqli_query($connection, $sql);

         $connection->close();
     } else {
         echo "Passwords do not match!";
     }
   }
   if (isset($_POST['signin'])) {
       $is_valid = false;
       $email = escape_data($_POST['signinEmail']);
       $password = escape_data($_POST['signinPassword']);
       $query = "SELECT * FROM users WHERE email = '$email'";
       $result = mysqli_query($connection, $query);


       while ($row = mysqli_fetch_assoc($result)) {
           $db_password = $row['password'];
           if (password_verify($password, $db_password)) {
               $is_valid = true;
               $_SESSION['id'] = $row['user_id'];
               $_SESSION['email'] = $row['email'];
               $_SESSION['name'] = $row['name'];
               $_SESSION['umode'] = $row['mode'];
               $_SESSION['uimage'] = $row['image'];
               $_SESSION['twostep'] = false;
               header('Location: twostep.php');
           }
       }
       if ($is_valid) {
           echo "Login Successful!";
       }
       else{
           echo "Login Failed!";
       }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User signup | login | StudyMate</title>
    <link rel="icon" href="img/sm-logo.png" type="image/x-icon">

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Font Awesome CDN (latest version) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-xX2J+BeJ3cN9CwUoF3lM2J+K3Z+g1A3F5EyP8Dd8cld+w1w7tybT1U2R8T8qvv7D1uOoFq9zFiScuIpVYz3grg==" crossorigin="anonymous"/>


    <!-- Main css -->
    <link rel="stylesheet" href="css/userlsstyle.css">
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="main">
        <!-- Sign up form -->
        <section class="signup" style="display: none;">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="post" class="register-form" id="register-form" action="login.php">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input class="input" type="text" name="signupName" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input class="input" type="email" name="signupEmail" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input class="input" type="password" name="signupPass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input class="input" type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="img/sm-logo.png" alt="sing up image"></figure>
                        <span onclick="signin()" class="signup-image-link" style="cursor: pointer;">I am already member</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="img/sm-logo.png" alt="sing up image"></figure>
                        <span onclick="signup()" class="signup-image-link" style="cursor: pointer;">Create an account</span>
                    </div>
                    <script>
                        function signup() {
                            document.querySelector('.signup').style.display = 'block';
                            document.querySelector('.sign-in').style.display = 'none';
                        }
                        function signin() {
                            document.querySelector('.signup').style.display = 'none';
                            document.querySelector('.sign-in').style.display = 'block';
                        }
                    </script>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <form method="POST" class="register-form" id="login-form" action="login.php">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="signinEmail" id="your_name" placeholder="Your Email" required/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="signinPassword" id="your_pass" placeholder="Password" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/owl-carousel-thumb.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/mail-script.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="js/gmaps.min.js"></script>
    <script src="js/theme.js"></script>
</body>
</html>