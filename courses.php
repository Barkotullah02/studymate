<?php
session_start();
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
if (isset($_POST['addcourse'])){
    $title = escape_data($_POST['title']);
    $description = escape_data($_POST['description']);
    $price = $_POST['price'];
    $image = $_FILES['cover']['name'];
    $imgfile = $_FILES['cover']['tmp_name'];

    $courseQuery = "INSERT INTO courses (user_id, title, description, image, price) VALUES ($id, '$title', '$description', '$image', $price)";
    $savedQuery = mysqli_query($connection, $courseQuery);
    if ($savedQuery) {
        move_uploaded_file($imgfile, "img/coursecovers/$image");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="icon" href="img/sm-logo.png" type="image/png" />
    <title>Courses</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
      <!-- main css -->
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body>
    <!--================ Start Header Menu Area =================-->
    <header class="header_area white-header">
      <div class="main_menu">
        <div class="search_input" id="search_input_box">
          <div class="container">
            <form class="d-flex justify-content-between" method="" action="">
              <input
                type="text"
                class="form-control"
                id="search_input"
                placeholder="Search Here"
              />
              <button type="submit" class="btn"></button>
              <span
                class="ti-close"
                id="close_search"
                title="Close Search"
              ></span>
            </form>
          </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand" href="index.php">
              <img class="logo-2" style="height: 80px;"  src="img/sm-logo-bgwhite.png" alt="" />
            </a>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon-bar"></span> <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div
              class="collapse navbar-collapse offset"
              id="navbarSupportedContent"
            >
              <ul class="nav navbar-nav menu_nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about-us.php">About</a>
                </li>
                  <li class="nav-item active">
                      <a class="nav-link" href="courses.php">Courses</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="myposts.php">Problems</a>
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
                  <a class="nav-link" href="contact.php">Contact</a>
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

    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="overlay"></div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <div class="banner_content text-center">
                <h2>Courses</h2>
                <div class="page_link">
                  <a href="index.php">Home</a>
                  <a href="courses.php">Courses</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================ Start Popular Courses Area =================-->
    <div class="popular_courses section_gap_top">
      <div class="container">
        <div class="row justify-content-center">
            <div class="container col-sm-9">
                <div class="container" id="courseresult">
                </div>
                <?php if ($usermode == 'tutor'){ ?>
                <div class="container text-center"><h3><b>Add a course to be a tutor</b></h3></div>
                <form method="post" class="card p-5 mb-3 bg-light" action="courses.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Course title</label>
                        <input name="title" type="text" class="form-control" id="" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Price</label>
                        <input type="number" name="price" class="form-control" id="" placeholder="Price in usd">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Upload the cover of your course</label>
                        <input type="file" class="form-control-file" name="cover" id="">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Description</label>
                        <textarea name="description" class="form-control" id="" placeholder="Add the description about your course"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addcourse" class="form-control btn btn-success" value="ADD COURSE" id="" placeholder="Add the description about your course">
                    </div>
                </form>
                <?php } ?>
            </div>
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Our Recent Courses</h2>
              <p>
                Replenish man have thing gathering lights yielding shall you
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- single course -->
          <div class="col-lg-12">
            <div class="owl-carousel active_course">
                <?php
                    $getCoursesQuery = "SELECT courses.*, users.image AS user_img, users.name FROM courses JOIN users ON courses.user_id = users.user_id ORDER BY course_id DESC LIMIT 3";
                    $getCoursesQueryResult = mysqli_query($connection, $getCoursesQuery);
                    while ($courseRow = mysqli_fetch_assoc($getCoursesQueryResult)) {
                        $cover = $courseRow['image'];
                        $title = $courseRow['title'];
                        $description = $courseRow['description'];
                        $price = $courseRow['price'];
                        $tutorImage = $courseRow['user_img'];
                        $tutorName = $courseRow['name'];
                        $courseId = $courseRow['course_id'];
                ?>
                  <div class="single_course">
                    <div class="course_head">
                      <img class="img-fluid" src="img/coursecovers/<?php echo $cover; ?>" alt="" />
                    </div>
                    <div class="course_content">
                      <span class="price">$<?php echo $price; ?></span>
                      <h4 class="mb-3">
                        <a href="course-details.php?courseid=<?php echo $courseId; ?>"><?php echo $title; ?></a>
                      </h4>
                      <p>
                          <?php echo $description; ?>
                      </p>
                      <div
                        class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-4"
                      >
                        <div class="authr_meta">
                          <img style="height: 40px; width: 40px" src="users/<?php echo $tutorImage; ?>" alt="" />
                          <span class="d-inline-block ml-2"><?php echo $tutorName; ?></span>
                        </div>
                        <div class="mt-lg-0 mt-3">
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
    <!--================ End Popular Courses Area =================-->

    <!--================ Starts Course  Grid Area =================-->

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script>
                    $(document).ready(function(){
                        $('#search_input').keyup(function(){
                            const search = $('#search_input').val();
                            $.ajax({
                                url: "search.php",
                                type: "POST",
                                data: {
                                    post: 'search',
                                    search: search,
                                },
                                success: function(data){
                                    $('#courseresult').html(data);
                                }
                            });
                        });//#search
                    }); //document.ready();
                </script>
        <div class="col-lg-12 align-items-center row justify-content-center">
            <?php
            $getCoursesQuery = "SELECT courses.*, users.image AS user_img, users.name FROM courses JOIN users ON courses.user_id = users.user_id ORDER BY course_id DESC";
            $getCoursesQueryResult = mysqli_query($connection, $getCoursesQuery);
            while ($courseRow = mysqli_fetch_assoc($getCoursesQueryResult)) {
                $cover = $courseRow['image'];
                $title = $courseRow['title'];
                $description = $courseRow['description'];
                $price = $courseRow['price'];
                $tutorImage = $courseRow['user_img'];
                $tutorName = $courseRow['name'];
                $courseID = $courseRow['course_id'];
                ?>
                <div class="single_course d-inline-block col-sm-3" style="margin-bottom: 2.5%;">
                    <div class="course_head">
                        <img class="img-fluid" src="img/coursecovers/<?php echo $cover; ?>" alt="" />
                    </div>
                    <div class="course_content">
                        <span class="price">$<?php echo $price; ?></span>
                        <h4 class="mb-3">
                            <a href="course-details.php?courseid=<?php echo $courseID; ?>"><?php echo $title; ?></a>
                        </h4>
                        <p>
                            <?php echo $description; ?>
                        </p>
                        <div
                                class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-4"
                        >
                            <div class="authr_meta">
                                <img style="height: 40px; width: 40px" src="users/<?php echo $tutorImage; ?>" alt="" />
                                <span class="d-inline-block ml-2"><?php echo $tutorName; ?></span>
                            </div>
                            <div class="mt-lg-0 mt-3">
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!--================ End Starts Course  Grid Area =================-->

    <!--================ Start Registration Area =================-->
    <div class="section_gap registration_area">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-7">
              <div class="row clock_sec clockdiv" id="clockdiv">
                <div class="col-lg-12">
                  <h1 class="mb-3">Register Now</h1>
                  <p>
                    There is a moment in the life of any aspiring astronomer that
                    it is time to buy that first telescope. It’s exciting to think
                    about setting up your own viewing station.
                  </p>
                </div>
                <div class="col clockinner1 clockinner">
                  <h1 class="days">150</h1>
                  <span class="smalltext">Days</span>
                </div>
                <div class="col clockinner clockinner1">
                  <h1 class="hours">23</h1>
                  <span class="smalltext">Hours</span>
                </div>
                <div class="col clockinner clockinner1">
                  <h1 class="minutes">47</h1>
                  <span class="smalltext">Mins</span>
                </div>
                <div class="col clockinner clockinner1">
                  <h1 class="seconds">59</h1>
                  <span class="smalltext">Secs</span>
                </div>
              </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
              <div class="register_form">
                <h3>Courses for Free</h3>
                <p>It is high time for learning</p>
                <form
                  class="form_area"
                  id="myForm"
                  action="mail.html"
                  method="post"
                >
                  <div class="row">
                    <div class="col-lg-12 form_group">
                      <input
                        name="name"
                        placeholder="Your Name"
                        required=""
                        type="text"
                      />
                      <input
                        name="name"
                        placeholder="Your Phone Number"
                        required=""
                        type="tel"
                      />
                      <input
                        name="email"
                        placeholder="Your Email Address"
                        pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"
                        required=""
                        type="email"
                      />
                    </div>
                    <div class="col-lg-12 text-center">
                      <button class="primary-btn">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--================ End Registration Area =================-->

    <!--================ Start Feature Area =================-->
    <section class="feature_area section_gap">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Awesome Feature</h2>
              <p>
                Replenish man have thing gathering lights yielding shall you
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <div class="icon"><span class="flaticon-student"></span></div>
              <div class="desc">
                <h4 class="mt-3 mb-2">Scholarship Facility</h4>
                <p>
                  One make creepeth, man bearing theira firmament won't great
                  heaven
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <div class="icon"><span class="flaticon-book"></span></div>
              <div class="desc">
                <h4 class="mt-3 mb-2">Sell Online Course</h4>
                <p>
                  One make creepeth, man bearing theira firmament won't great
                  heaven
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <div class="icon"><span class="flaticon-earth"></span></div>
              <div class="desc">
                <h4 class="mt-3 mb-2">Global Certification</h4>
                <p>
                  One make creepeth, man bearing theira firmament won't great
                  heaven
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Feature Area =================-->

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
              <form
                target="_blank"
                action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                method="get"
                class="form-inline"
              >
                <input
                  class="form-control"
                  name="EMAIL"
                  placeholder="Your Email Address"
                  onfocus="this.placeholder = ''"
                  onblur="this.placeholder = 'Your Email Address'"
                  required=""
                  type="email"
                />
                <button class="click-btn btn btn-default">
                  <span>subscribe</span>
                </button>
                <div style="position: absolute; left: -5000px;">
                  <input
                    name="b_36c4fd991d266f23781ded980_aefe40901a"
                    tabindex="-1"
                    value=""
                    type="text"
                  />
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
          <div class="col-lg-4 col-sm-12 footer-social">
            <a href="#"><i class="ti-facebook"></i></a>
            <a href="#"><i class="ti-twitter"></i></a>
            <a href="#"><i class="ti-dribbble"></i></a>
            <a href="#"><i class="ti-linkedin"></i></a>
          </div>
        </div>
      </div>
    </footer>
    <!--================ End footer Area  =================-->



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.min.js"></script>

    <!-- Place this at the end of your HTML, before </body> -->


    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/owl-carousel-thumb.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/mail-script.js"></script>
    <!--gmaps Js-->
    <script src="js/gmaps.min.js"></script>
    <script src="js/theme.js"></script>
  </body>
</html>
