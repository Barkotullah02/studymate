<?php
ob_start();
session_start();
include 'validation.php';
include 'db_connection.php';
date_default_timezone_set("Asia/Dhaka");

function escape_data($data){
    include 'db_connection.php';

    $data = trim($data);

    $data = stripslashes($data);

    $data = htmlspecialchars($data);

    $data = mysqli_real_escape_string($connection, $data);


    return $data;

}

$getproblemresult = null;
$problemid = null;

if (isset($_GET['problemid'])) {
    $problemid = $_GET['problemid'];
    $getproblemquery = "SELECT problems.*, users.name AS student_name, subjects.name AS subject_name FROM problems  JOIN users ON problems.student_id = users.user_id JOIN subjects ON problems.subject_id = subjects.subject_id where problem_id = $problemid";
    $getproblemresult = mysqli_query($connection, $getproblemquery);

    if (isset($_POST['postcomment'])) {
        $comment = escape_data($_POST['comment']);
        $comment_by = $_SESSION['id'];
        $commented_for = $problemid;
        $comment_time = date('Y-m-d h:i:s');

        $commentquery = "INSERT INTO comments(problem_id, student_id, comment, comment_time) VALUES ($commented_for, $comment_by, '$comment', '$comment_time')";
        $commentresult = mysqli_query($connection, $commentquery);
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
    <link rel="icon" href="img/sm-logo-new.png" type="image/png" />
    <title>Problem Details</title>
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
              <img style="height: 80px;" class="logo-2" src="img/sm-logo-bgwhite.png" alt="" />
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
                  <?php if ($usermode == 'tutor'){ ?>
                    <li class="nav-item submenu dropdown">
                      <a
                        href="#"
                        class="nav-link dropdown-toggle"
                        data-toggle="dropdown"
                        role="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                        >Pages</a
                      >
                      <ul class="dropdown-menu">
                        <li class="nav-item">
                          <a class="nav-link" href="courses.php">Courses</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="course-details.php"
                            >Course Details</a
                          >
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="elements.php">Elements</a>
                        </li>
                      </ul>
                    </li>
                  <?php } ?>

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
                <li class="nav-item submenu dropdown active">
                  <a
                    href="#"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                    role="button"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >Daily Updates</a
                  >
                  <ul class="dropdown-menu">
                    <li class="nav-item">
                      <a class="nav-link" href="myposts.php">My Posts</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="single-blog.html"
                        >Post Details</a
                      >
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
                <h2>Blog Details</h2>
                <div class="page_link">
                  <a href="index.php">Home</a>
                  <a href="myposts.php">My Posts</a>
                  <a href="single-post.php">Post Details</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Blog Area =================-->

    <section class="blog_area single-post-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                        <?php

                        while ($row = mysqli_fetch_assoc($getproblemresult)) {
                            $problem_id = $row['problem_id'];
                            $problem_title = $row['title'];
                            $problem_description = $row['description'];
                            $postedate = $row['posted_at'];
                            $problem_image = $row['problem_img'];
                            $student_name = $row['student_name'];
                            $subject_name = $row['subject_name'];
                            ?>
                        <div class="col-lg-12">
                            <div class="feature-img">
                                <img class="img-fluid" src="img/problems/<?php echo $problem_image; ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3  col-md-3">
                            <div class="blog_info text-right">
                                <div class="post_tag">
                                    <a class="active" href="#"><?php echo $subject_name; ?></a>
                                </div>
                                <ul class="blog_meta list">
                                    <li><a href="#"><?php echo $student_name; ?><i class="ti-user"></i></a></li>
                                    <li><a href="#"><?php echo $postedate; ?><i class="ti-calendar"></i></a></li>
                                    <li><a href="#">06 Comments<i class="ti-comment"></i></a></li>
                                </ul>
                                <ul class="social-links">
                                    <li><a href="#"><i class="ti-facebook"></i></a></li>
                                    <li><a href="#"><i class="ti-twitter"></i></a></li>
                                    <li><a href="#"><i class="ti-github"></i></a></li>
                                    <li><a href="#"><i class="ti-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h2><?php echo $problem_title; ?></h2>
                            <p class="excert">
                                <?php echo $problem_description; ?>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="comments-area">
                        <h4>Comments</h4>
                        <?php
                            $getcommentquery = "SELECT comments.*, users.name AS users_name, users.image AS image FROM comments  JOIN users ON comments.student_id = users.user_id WHERE comments.problem_id = $problemid  ORDER BY comments.comment_time DESC";
                            $getcommentresult = mysqli_query($connection, $getcommentquery);

                            while ($getcommentrow = mysqli_fetch_assoc($getcommentresult)) {
                            $comment_id = $getcommentrow['comment_id'];
                            $comment = $getcommentrow['comment'];
                            $users_name = $getcommentrow['users_name'];
                            $users_image = $getcommentrow['image'];
                            $comment_time = $getcommentrow['comment_time'];
                        ?>
                        <div class="comment-list left-padding">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img style="width: 50px;" src="users/<?php echo $users_image; ?>" alt="">
                                    </div>
                                    <div class="desc">
                                        <h5><a href="#"><?php echo $users_name; ?></a></h5>
                                        <p class="date"><?php echo $comment_time; ?></p>
                                        <p class="comment">
                                            <?php echo $comment; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="comment-list left-padding">

                        </div>
                    </div>
                    <div class="comment-form">
                        <h4>Leave a Reply</h4>
                        <form action="single-post.php?problemid=<?php echo $problemid; ?>" method="POST">
                            <div class="form-group">
                                <textarea class="form-control mb-10" rows="5" name="comment" placeholder="Messege"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                            </div>
                            <input type="submit" name="postcomment" href="#" class="primary-btn btn" value="Post Comment">
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Posts">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="ti-search"></i></button>
                                </span>
                            </div><!-- /input-group -->
                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Popular Posts</h3>
                            <?php
                            $popular_problemsaql = "SELECT p.*, COUNT(c.comment_id) AS comment_count
                                                                        FROM problems p
                                                                        JOIN comments c ON p.problem_id = c.problem_id
                                                                        GROUP BY p.problem_id, p.title
                                                                        ORDER BY comment_count DESC
                                                                        LIMIT 5;
                                                                        ";
                            $popular_problemresult = mysqli_query($connection, $popular_problemsaql);
                            while ($popularRow = mysqli_fetch_assoc($popular_problemresult)) {
                                $p_problem_id = $popularRow['problem_id'];
                                $p_problem_title = $popularRow['title'];
                                $p_postedate = $popularRow['posted_at'];
                                $p_problem_image = $popularRow['problem_img'];
                                ?>
                                <div class="media post_item">
                                    <img style="width: 100px" src="img/problems/<?php echo $p_problem_image; ?>" alt="post">
                                    <div class="media-body">
                                        <a href="single-post.php?problemid=<?php echo $p_problem_id; ?>">
                                            <h3><?php echo $p_problem_title; ?></h3>
                                        </a>
                                        <p><?php echo $p_postedate; ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget ads_widget">
                            <a href="#"><img class="img-fluid" src="img/sm-logo.png" alt=""></a>
                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Post Subjects</h4>
                            <ul class="list cat-list">
                                <?php
                                $get_subject_sql = "SELECT s.name AS name, COUNT(p.problem_id) AS problem_count
                                                                        FROM problems p
                                                                        JOIN subjects s ON p.subject_id = s.subject_id
                                                                        GROUP BY s.subject_id, s.name
                                                                        ORDER BY problem_count DESC;
                                                                        ";
                                $get_subjectresult = mysqli_query($connection, $get_subject_sql);
                                while ($subjectRow = mysqli_fetch_assoc($get_subjectresult)) {
                                    $subject_name = $subjectRow['name'];
                                    $problem_count = $subjectRow['problem_count'];

                                    ?>
                                    <li>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p><?php echo $subject_name; ?></p>
                                            <p><?php echo $problem_count; ?></p>
                                        </a>
                                    </li>
                                <?php } ?>
                                <div class="br"></div>
                        </aside>
                        <aside class="single-sidebar-widget newsletter_widget">
                            <h4 class="widget_title">Newsletter</h4>
                            <p>
                                Here, I focus on a range of items and features that we use in life without
                                giving them a second thought.
                            </p>
                            <div class="form-group d-flex flex-row">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="ti-email" aria-hidden="true"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email"
                                           onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'">
                                </div>
                                <a href="#" class="bbtns">Subcribe</a>
                            </div>
                            <p class="text-bottom">You can unsubscribe at any time</p>
                            <div class="br"></div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

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
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <i class="ti-heart" aria-hidden="true"></i> by <a href="" target="_blank">Barkotullah Opu</a>
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