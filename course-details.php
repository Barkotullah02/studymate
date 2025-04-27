<?php
session_start();
include 'validation.php';
include 'db_connection.php';
$price = null;
$tutorImage = null;
$tutorName = null;
$coursedetails = null;
$courseid = null;
$tutorid = null;
if (isset($_GET['courseid'])) {
    $courseid = $_GET['courseid'];
    $getCourseQuery = "SELECT courses.*, users.user_id, users.image AS user_img, users.name FROM courses JOIN users ON courses.user_id = users.user_id where course_id = $courseid";
    $coursedetails = mysqli_query($connection, $getCourseQuery);
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
    <link rel="icon" href="img/sm-logo-new.png" type="image/png" />
    <title>Courses Details</title>
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
              <img class="logo-2" style="height: 80px" src="img/sm-logo-bgwhite.png" alt="" />
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
                  <li class="nav-item">
                      <a class="nav-link" href="myposts.php">Problems</a>
                  </li>
                  <li class="nav-item active">
                      <a class="nav-link" href="courses.php">Courses</a>
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
                <h2>Course Details</h2>
                <div class="page_link">
                  <a href="index.php">Home</a>
                  <a href="courses.php">Courses</a>
                  <a href="course-details.html">Courses Details</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================ Start Course Details Area =================-->
    <section class="course_details_area section_gap">
        <div class="container">
            <div class="row">
                <?php
                while ($courseRow = mysqli_fetch_assoc($coursedetails)) {
                    $cover = $courseRow['image'];
                    $title = $courseRow['title'];
                    $description = $courseRow['description'];
                    $price = $courseRow['price'];
                    $tutorImage = $courseRow['user_img'];
                    $tutorName = $courseRow['name'];
                    $courseId = $courseRow['course_id'];
                    $tutorid = $courseRow['user_id'];
                    ?>
                    <div class="col-lg-8 course_details_left">
                        <div class="main_image">
                            <img class="img-fluid" src="img/coursecovers/<?php echo $cover; ?>" alt="">
                        </div>
                        <div class="content_wrapper">
                            <h4 class="title">Objectives</h4>
                            <div class="content">
                                <p><h2><b><?php echo $title; ?></b></h2></p>
                                <?php echo $description; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>


                <div class="col-lg-4 right-contents">
                    <ul>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Trainer’s Name</p>
                                <span class="or"><?php echo $tutorName; ?></span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Course Fee </p>
                                <span>$<?php echo $price; ?></span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Available Seats </p>
                                <span>50</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Schedule </p>
                                <span>2.00 pm to 4.00 pm</span>
                            </a>
                        </li>
                    </ul>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <button class="primary-btn2 text-uppercase enroll rounded-0 text-white">Enroll the course</button>

                    <script>
                        $(document).ready(function(){
                            let
                        });//document ready
                    </script>


                    <h4 class="title">Reviews</h4>
                    <div class="content">
                        <div class="review-top row pt-40">
                            <div class="col-lg-12">
                                <h6 class="mb-15">Provide Your Rating</h6>
                                <div class="d-flex flex-row reviews justify-content-between">
                                    <span>Quality</span>
                                    <div class="star">
                                        <i class="ti-star rs checked"></i>
                                        <i class="ti-star rs checked"></i>
                                        <i class="ti-star rs checked"></i>
                                        <i class="ti-star rs"></i>
                                        <i class="ti-star rs"></i>
                                    </div>
                                    <span>Outstanding</span>
                                </div>
                            </div>
                        </div>
                        <style>
                            .rs:hover {
                                cursor: pointer;
                            }
                        </style>
                        <script>
                            $(document).ready(function () {
                                $('.rs').on('click', function () {
                                    let index = $(this).index(); // get the index of the clicked star

                                    // First remove 'checked' from all
                                    $('.rs').removeClass('checked');

                                    // Add 'checked' to all previous + current stars
                                    $('.rs').each(function (i) {
                                        if (i <= index) {
                                            $(this).addClass('checked');
                                        }
                                    });
                                });

                                $('#submitRating').on('click', function (evt) {
                                    evt.preventDefault();
                                    let feedback = $('#feedback').val();
                                    let rating = $('.rs.checked').length;
                                    $.ajax({
                                        url: 'review.php',
                                        type: 'POST',
                                        data: {
                                            courseid: '<?php echo $_GET['courseid']; ?>',
                                            review: 'review',
                                            feedback: feedback,
                                            rating: rating
                                        },
                                        success: function (data) {
                                            $('.clearfeedback').html(data);
                                        }
                                    });
                                });
                            });
                        </script>
                        <div class="clearfeedback"></div>

                        <div class="feedeback">
                            <h6>Your Feedback</h6>
                            <textarea name="feedback" class="form-control" cols="10" rows="10" id="feedback"></textarea>
                            <div class="mt-10 text-right">
                                <a href="#" class="primary-btn2 text-right rounded-0 text-white" id="submitRating">Submit</a>
                            </div>
                        </div>
                        <div class="comments-area mb-30">
                            <?php
                            $rating = null;
                            $feedback = null;
                            $getReviewQuery = "SELECT reviews.*, users.user_id, users.name, users.image FROM reviews JOIN users ON reviews.student_id = users.user_id WHERE course_id = $courseid";
                            $getReviewQueryResult = mysqli_query($connection, $getReviewQuery);
                            while ($reviewRow = mysqli_fetch_assoc($getReviewQueryResult)) {
                                $name = $reviewRow['name'];
                                $image = $reviewRow['image'];
                                $feedback = $reviewRow['feedback'];
                                $rating = $reviewRow['rating'];
                                $userId = $reviewRow['user_id'];
                                ?>
                            <div class="comment-list">
                                <div class="single-comment single-reviews justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            <img width="60px" src="users/<?php echo $image; ?>" alt="">
                                        </div>
                                        <input type="hidden" class="reviewer-id" value="<?php echo $userId; ?>">
                                        <input type="hidden" id="currentUserId" value="<?php echo $id; ?>"
                                        <div class="desc">
                                            <h5><a href="#" class="reviewer"><?php echo $name; ?></a>
                                                <div class="star">
                                                    <?php for ($i = 1; $i <= 5; $i++){ ?>
                                                        <span class="ti-star <?php echo ($i <= $rating) ? 'checked' : ''; ?>"></span>
                                                    <?php } ?>
                                                </div>
                                            </h5>
                                            <p class="comment">
                                                <?php echo $feedback; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <script>
                            $(document).ready(function () {
                                const currentUser = $('#currentUserId').val();
                                let isReviewed = false;

                                $('.reviewer-id').each(function () {
                                    if ($(this).val() == currentUser) {
                                        isReviewed = true;
                                        return false; // exit early if matched
                                    }
                                });

                                if (isReviewed) {
                                    $('#submitRating').css('visibility', 'hidden');
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Course Details Area =================-->

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