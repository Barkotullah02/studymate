<?php
include 'db_connection.php';
include 'validation.php';

function escape_data($data){
    include 'db_connection.php';

    $data = trim($data);

    $data = stripslashes($data);

    $data = htmlspecialchars($data);

    $data = mysqli_real_escape_string($connection, $data);


    return $data;

}

if (isset($_POST['update'])) {
    $uimgname = escape_data($_FILES['updateimg']['name']);
    $uimgfile = $_FILES['updateimg']['tmp_name'];

    if(!empty($uimgname)){
        $updateimgquery = "UPDATE users set image = '$uimgname' WHERE user_id = $id";
        $updateimgresult = mysqli_query($connection, $updateimgquery);

        move_uploaded_file($uimgfile, "users/$uimgname");

    }
    $about  = escape_data($_POST['about']);
    $phone = escape_data($_POST['contact']);
    $address = escape_data($_POST['address']);
    $job = escape_data($_POST['job']);
    $country = escape_data($_POST['country']);
    $organisation = escape_data($_POST['organisation']);
    $education = escape_data($_POST['education']);

    $updateuserprofilequery = "UPDATE userdetails SET about = '$about',
                       education = '$education',
                       country = '$country',
                       phone = '$phone',
                       address = '$address',
                       job = '$job',
                       company = '$organisation' where user_id = $id";
    $updateuserprofileresult = mysqli_query($connection, $updateuserprofilequery);

    //echo $uimgname . $about . $phone . $address . $job . $country . $organisation . $education;

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="img/sm-logo.png" type="image/png" />
    <title>StudyMate | Studying is easier now</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
<!--================ Start Header Menu Area =================-->
<header class="header_area">
    <div class="main_menu">
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form class="d-flex justify-content-between" method="" action="">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here" />
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="index.php"><img style="width: 80px;" src="img/sm-logo-new.png" alt="" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about-us.php">About</a>
                        </li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="courses.php">Courses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="course-details.php">Course Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="elements.php">Elements</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">Daily Updates</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="myposts.php">My Posts</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="single-post.php">Post Details</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                   aria-expanded="false"><?php echo $username; ?></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="profilesettings.php">Profile Settings</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link search" id="search">
                                <i class="ti-search"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<!--================ End Header Menu Area =================-->

<div style="height: 130px;"></div>

    <div class="container">
        <div class="row gy-4 gy-lg-0">
            <div class="col-12 col-lg-4 col-xl-3">
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="card widget-card border-light shadow-sm">
                            <div class="card-header text-bg-primary">Welcome, <?php echo $username; ?></div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <?php
                                    $profileimage = "";
                                    $getprofileimg = "SELECT image FROM users WHERE user_id = $id";
                                    $profileimgresult = mysqli_query($connection, $getprofileimg);
                                    while($row = mysqli_fetch_assoc($profileimgresult)){
                                        $profileimage = $row["image"];
                                        ?>

                                    <img style="width: 100px;" src="users/<?php if($profileimage == null){echo "male.png";} else{echo $profileimage;}?>" class="img-fluid rounded-circle" alt="Luna John">
                                    <?php } ?>
                                </div>
                                <h5 class="text-center mb-1"><?php echo $username; ?></h5>
                                <?php
                                $userdetailsquery = "SELECT * FROM userdetails WHERE user_id=$id";
                                $userdetailsresult = mysqli_query($connection, $userdetailsquery);
                                $userdetails = mysqli_fetch_array($userdetailsresult);
                                ?>
                                <p class="text-center text-secondary mb-4"><?php echo $userdetails['job']; ?></p>
                                <ul class="list-group list-group-flush mb-4">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <h6 class="m-0">Followers</h6>
                                        <span>7,854</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <h6 class="m-0">Following</h6>
                                        <span>5,987</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <h6 class="m-0">Friends</h6>
                                        <span>4,620</span>
                                    </li>
                                </ul>
                                <div class="d-grid m-0">
                                    <button class="btn btn-outline-primary" type="button">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card widget-card border-light shadow-sm">
                            <div class="card-header text-bg-primary">Social Accounts</div>
                            <div class="card-body">
                                <a href="https://www.instagram.com/xoaifa/" target="_blank" class="d-inline-block bg-dark link-light lh-1 p-2 rounded">
                                    <i class="fa-brands fa-instagram" style="color: white"></i>
                                </a>
                                <a href="https://x.com/OnlymeOpu" target="_blank" class="d-inline-block bg-dark link-light lh-1 p-2 rounded">
                                    <i class="fa-brands fa-x-twitter" style="color: white"></i>
                                </a>
                                <a href="https://www.facebook.com/Only.meOpu" target="_blank" class="d-inline-block bg-dark link-light lh-1 p-2 rounded">
                                    <i class="fa-brands fa-facebook" style="color: white"></i>
                                </a>
                                <a href="https://www.linkedin.com/in/barkotullahopu/" target="_blank" class="d-inline-block bg-dark link-light lh-1 p-2 rounded">
                                    <i class="fa-brands fa-linkedin" style="color: white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card widget-card border-light shadow-sm">
                            <div class="card-header text-bg-primary">About Me</div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush mb-0">
                                    <li class="list-group-item">
                                        <h6 class="mb-1">
                                            <span class="bii bi-mortarboard-fill me-2"></span>
                                            Education
                                        </h6>
                                        <span>BS Computer Science</span>
                                    </li>
                                    <li class="list-group-item">
                                        <h6 class="mb-1">
                                            <span class="bii bi-geo-alt-fill me-2"></span>
                                            Location
                                        </h6>
                                        <span>Dhaka</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 col-xl-9">
                            <div class="t" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab">
                                <form action="profilesettings.php" method="post" enctype="multipart/form-data" class="row gy-3 gy-xxl-4">
                                    <div class="col-12 col-md-6">
                                        <label for="inputFirstName" class="form-label">Change your profile image</label>
                                        <input type="file" name="updateimg" class="form-control" id="inputImg">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="inputFirstName" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="inputFirstName" value="<?php echo $username; ?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="inputEducation" class="form-label">Education</label>
                                        <input type="text" name="education" class="form-control" id="inputEducation" value="<?php echo $userdetails['education'];?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="inputJob" class="form-label">Job</label>
                                        <input type="text" name="job" class="form-control" id="inputJob" value="<?php echo $userdetails['job'];?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="inputCompany" class="form-label">Organisation</label>
                                        <input type="text" name="organisation" class="form-control" id="inputOrganisation" value="<?php echo $userdetails['company'];?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="inputPhone" class="form-label">Phone</label>
                                        <input type="tel" name="contact" class="form-control" id="inputPhone" value="<?php echo $userdetails['phone']?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmail" value="<?php echo $useremail; ?>" disabled>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="inputAddress" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="inputAddress" value="<?php echo $userdetails['address']; ?>">
                                    </div>
                                    <div class="col-12 col-md-6 mt-3">
                                        <label for="inputCountry" class="form-label">Country</label>
                                        <select name="country" style="height: 80px !important; overflow-y: auto !important;" class="form-select" id="inputCountry">
                                            <option value="<?php echo $userdetails['country']; ?>" selected><?php echo $userdetails['country']; ?></option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Åland Islands">Åland Islands</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">French Southern Territories</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-leste">Timor-leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Viet Nam</option>
                                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="inputAbout" class="form-label">About</label>
                                        <textarea class="form-control" name="about" id="inputAbout"><?php echo $userdetails['about'] ?></textarea>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <input type="submit" name="update" class="btn btn-outline-warning" value="Update Profile">
                                    </div>
                                </form>


                                <div class="container text-center">
                                    <b>My posts</b>
                                    <table class="table">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Posted At</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                    <?php
                                    $postquery = "SELECT * FROM problems WHERE problems.student_id = $id ORDER BY problem_id DESC";
                                    $postresult = mysqli_query($connection, $postquery);
                                    while ($postrow = mysqli_fetch_assoc($postresult)) {
                                        $serial = $postrow['problem_id'];
                                        $title = $postrow['title'];
                                        $date = $postrow['posted_at'];
                                        ?>
                                        <tbody>
                                        <tr>
                                            <th scope="row"><?php echo $serial; ?></th>
                                            <td><?php echo $title; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td><a href="delete.php?serial=<?php echo $serial; ?>">Delete Post</a></td>
                                        </tr>

                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>




<div style="height: 80px;"></div>







<!--================ Start footer Area  =================-->
<footer class="footer-area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-6 single-footer-widget">
                <h4>Top Products</h4>
                <ul>
                    <li><a href="#">Managed Website</a></li>
                    <li><a href="#">Manage Reputation</a></li>
                    <li><a href="#">Power Tools</a></li>
                    <li><a href="#">Marketing Service</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 single-footer-widget">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">Jobs</a></li>
                    <li><a href="#">Brand Assets</a></li>
                    <li><a href="#">Investor Relations</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 single-footer-widget">
                <h4>Features</h4>
                <ul>
                    <li><a href="#">Jobs</a></li>
                    <li><a href="#">Brand Assets</a></li>
                    <li><a href="#">Investor Relations</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 single-footer-widget">
                <h4>Resources</h4>
                <ul>
                    <li><a href="#">Guides</a></li>
                    <li><a href="#">Research</a></li>
                    <li><a href="#">Experts</a></li>
                    <li><a href="#">Agencies</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6 single-footer-widget">
                <h4>Newsletter</h4>
                <p>You can trust us. we only send promo offers,</p>
                <div class="form-wrap" id="mc_embed_signup">
                    <form target="_blank"
                          action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                          method="get" class="form-inline">
                        <input class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''"
                               onblur="this.placeholder = 'Your Email Address'" required="" type="email" />
                        <button class="click-btn btn btn-default">
                            <span>subscribe</span>
                        </button>
                        <div style="position: absolute; left: -5000px;">
                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text" />
                        </div>

                        <div class="info"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row footer-bottom d-flex justify-content-between">
            <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved by <a href="https://www.linkedin.com/in/barkotullahopu/" target="_blank">Barkotullah Opu</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            <div class="col-lg-4 col-sm-12 footer-social text-center">
                <a href="#"><i class="ti-facebook"></i></a>
                <a href="#"><i class="ti-twitter"></i></a>
                <a href="#"><i class="ti-dribbble"></i></a>
                <a href="#"><i class="ti-linkedin"></i></a>
            </div>
        </div>
    </div>
</footer>
<!--================ End footer Area  =================-->



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
