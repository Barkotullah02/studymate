<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$otplifetime = 180;

function sendOTP() {
    $otp = rand(1000, 9999);
    $_SESSION['otp'] = $otp;

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'twostep.studymate@gmail.com';
        $mail->Password = 'rahpybchgvcqyhmg'; // Use app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mailto = $_SESSION['email'];

        $mail->setFrom('twostep.studymate@gmail.com', 'StudyMate');
        $mail->addAddress($mailto, $_SESSION['name']);

        $mail->isHTML(true);
        $mail->Subject = 'OTP for login to StudyMate';
        $mail->Body = '<b>Do not share this OTP with anyone</b><br><h2 style="background: #d39e00; color: #002a80; text-align: center;">' . $otp . '</h2>';
        $mail->AltBody = 'Your OTP is: ' . $otp;

        $mail->send();

        $_SESSION['otpcreatedat'] = time();
    } catch (Exception $e) {
        echo "Email failed: {$mail->ErrorInfo}";
    }
}

if (
    !isset($_SESSION['otp']) ||
    !isset($_SESSION['otpcreatedat']) ||
    (time() - $_SESSION['otpcreatedat']) > $otplifetime ||
    (isset($_GET['resend']) && $_GET['resend'] == 1)
) {
    sendOTP();
}

if (!$_SESSION['twostep'] && isset($_SESSION['otpcreatedat']) && (time() - $_SESSION['otpcreatedat']) > $otplifetime) {
    session_unset();
    session_destroy();
    session_start(); // restart for future use
    echo "<br><b style='color:red;'>OTP expired. Please try again.</b>";
}

// ✅ Handle form submission
if (isset($_POST['verify'])) {
    $eotp = $_POST['num1'] . $_POST['num2'] . $_POST['num3'] . $_POST['num4'];
    $realOtp = $_SESSION['otp'] ?? '';

    // Debugging output
    echo "<br>Entered OTP: '" . $eotp . "'";
    echo "<br>Session OTP: '" . $realOtp . "'";
    echo "<br>Type of Entered OTP: " . gettype($eotp);
    echo "<br>Type of Session OTP: " . gettype($realOtp);

    if (trim($eotp) === trim((string)$realOtp)) {
        unset($_SESSION['otp']);
        $_SESSION['twostep'] = true;
        header("Location: index.php");

    } else {
        echo "<br><b style='color:red;'>Incorrect OTP. Please try again.</b>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="img/sm-logo-new.png" rel="icon" type="image/png">
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Two step verification | StudyMate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body{margin-top:20px;
            background:#f6f9fc;
        }
        .icon-circle[class*=text-] [fill]:not([fill=none]), .icon-circle[class*=text-] svg:not([fill=none]), .svg-icon[class*=text-] [fill]:not([fill=none]), .svg-icon[class*=text-] svg:not([fill=none]) {
            fill: currentColor!important;
        }
        .svg-icon-xl>svg {
            width: 3.25rem;
            height: 3.25rem;
        }

        .hover-lift-light {
            transition: box-shadow .25s ease,transform .25s ease,color .25s ease,background-color .15s ease-in;
        }
        .mt-4 {
            margin-top: 1.5rem!important;
        }
        .w-100 {
            width: 100%!important;
        }
        .btn-group-lg>.btn, .btn-lg {
            padding: 0.8rem 1.85rem;
            font-size: 1.1rem;
            border-radius: 0.3rem;
        }
        .btn-purple {
            color: #fff;
            background-color: #6672e8;
            border-color: #6672e8;
        }

        .text-center {
            text-align: center!important;
        }
        .py-4 {
            padding-top: 1.5rem!important;
            padding-bottom: 1.5rem!important;
        }
        .form-control-lg {
            min-height: calc(1.5em + 1rem + 2px);
            padding: 0.5rem 1rem;
            font-size: 1.25rem;
            border-radius: 0.3rem;
        }
        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #1e2e50;
            background-color: #f6f9fc;
            background-clip: padding-box;
            border: 1px solid #dee2e6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>
</head>
<body>
<div class="row justify-content-center mt-7">
    <div class="col-lg-5 text-center">
        <a href="index.html">
            <img src="assets/img/svg/logo.svg" alt="">
        </a>
        <form action="twostep.php" method="post">
            <div class="card mt-5">
                <div class="card-body py-5 px-lg-5">
                    <div class="svg-icon svg-icon-xl text-purple">
                       <img style="height: 150px;" src="img/sm-logo-new.png" alt="" class="svg-icon svg-icon-lg">
                    </div>
                    <h3 class="fw-normal text-dark mt-4">
                        2-step verification
                    </h3>
                    <p class="mt-4 mb-1">
                        We sent a verification code to your email.
                    </p>
                    <p>
                        Please enter the code in the field below.
                    </p>

                    <div  class="row mt-4 pt-2">
                        <div class="col">
                            <input name="num1" type="text" class="form-control form-control-lg text-center py-4" maxlength="1" autofocus="">
                        </div>
                        <div class="col">
                            <input name="num2" type="text" class="form-control form-control-lg text-center py-4" maxlength="1">
                        </div>
                        <div class="col">
                            <input name="num3" type="text" class="form-control form-control-lg text-center py-4" maxlength="1">
                        </div>
                        <div class="col">
                            <input name="num4" type="text" class="form-control form-control-lg text-center py-4" maxlength="1">
                        </div>
                    </div>

                    <input type="submit" name="verify" class="btn btn-purple btn-lg w-100 hover-lift-light mt-4" value="Verifiy"/>
                </div>
            </div>
        </form>

        <p class="text-center text-muted mt-4">
            Didn't receive it?
            <a href="twostep.php?resend=1" class="text-decoration-none ms-2">
                Resend code
            </a>
        </p>
    </div>
</div>

<script>
    const inputs = document.querySelectorAll('input.form-control-lg');

    inputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            const value = input.value;
            if (value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', (e) => {
            if ((e.key === 'Backspace' || e.key === 'Delete') && input.value === '' && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">



</script>
</body>
</html>

