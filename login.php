<?php
   if(isset($_POST['signup'])){
    $name = $_POST['signupName'];
    $email = $_POST['signupEmail'];
    $password = $_POST['signupPass'];
    $re_pass = $_POST['re_pass'];

    echo $name;
    echo $email;
    echo $password;
    echo $re_pass;

    // if($password == $re_pass){
    //     // Hash the password
    //     $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //     // Database connection
    //     $conn = new mysqli('localhost', 'root', '', 'user_registration');

    //     // Check connection
    //     if ($conn->connect_error) {
    //         die("Connection failed: " . $conn->connect_error);
    //     }

    //     // Insert user data into database
    //     $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        
    //     if ($conn->query($sql) === TRUE) {
    //         echo "New record created successfully";
    //     } else {
    //         echo "Error: " . $sql . "<br>" . $conn->error;
    //     }

    //     // Close connection
    //     $conn->close();
    // } else {
    //     echo "Passwords do not match!";
    // }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>
    <link rel="icon" href="img/sm-logo.png" type="image/x-icon">

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Font Awesome CDN (latest version) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-xX2J+BeJ3cN9CwUoF3lM2J+K3Z+g1A3F5EyP8Dd8cld+w1w7tybT1U2R8T8qvv7D1uOoFq9zFiScuIpVYz3grg==" crossorigin="anonymous"/>


    <!-- Main css -->
    <link rel="stylesheet" href="css/userlsstyle.css">
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
                                <input type="text" name="signinName" id="your_name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="signinPassword" id="your_pass" placeholder="Password"/>
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
</body>
</html>