<?php
include 'db_connection.php';
include 'validation.php';

date_default_timezone_set("Asia/Dhaka");
function escape_data($data){
    include 'db_connection.php';

    $data = trim($data);

    $data = stripslashes($data);

    $data = htmlspecialchars($data);

    $data = mysqli_real_escape_string($connection, $data);


    return $data;

}
if (isset($_POST['post'])) {
    $title = escape_data($_POST['title']);
    $subjectid = escape_data($_POST['subject']);
    $subjectid = intval($subjectid);
    $description = escape_data($_POST['details']);
    $tmp_problemimage = $_FILES['problemimage']['tmp_name'];
    $problemimage = escape_data($_FILES['problemimage']['name']);
    $userid = intval($id);
    $post_time = date('Y-m-d h:i:s');

    $postQuery = "INSERT INTO `problems`(`student_id`, `subject_id`, `title`, `description`, `posted_at`, `problem_img`) VALUE ($userid, $subjectid, '$title', '$description', '$post_time', '$problemimage')";
    $result = mysqli_query($connection, $postQuery);
    move_uploaded_file($tmp_problemimage, "img/problems/$problemimage");

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
    <title>My Posts | StudyMate</title>
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
    <header class="header_area">
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
            <a class="navbar-brand logo_h" href="index.php"
              ><img style="width: 80px;" src="img/sm-logo-new.png" alt=""
            /></a>
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
                <li class="nav-item submenu dropdown active">
                  <a
                    href="#"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                    role="button"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >Daily Update</a
                  >
                  <ul class="dropdown-menu">
                    <li class="nav-item">
                      <a class="nav-link" href="myposts.php">My Posts</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="single-post.php"
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

    <!--================ Start Home Banner Area =================-->
    <section class="home_banner_area">
      <div class="banner_inner">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="banner_content text-center">
                <p class="text-uppercase">
                  Best online education service In the world
                </p>
                <h2 class="text-uppercase mt-4 mb-5">
                  One Step Ahead This Season
                </h2>
                <div>
                  <a href="#" class="primary-btn2 mb-3 mb-sm-0">learn more</a>
                  <a href="#" class="primary-btn ml-sm-3 ml-0">see course</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================Blog Area =================-->
    <section class="blog_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">
                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <p style="text-align: center; color: #d39e00; font-size: 120%; font-weight: bold;">
                                        Post a problem<br>
                                        <span style="font-size: 70%; color: rgba(255,0,0,0.73); text-align: center;">The admins of StudyMate reserves all right to remove your post at any time</span>
                                    </p>
                                    <form action="myposts.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Select a subject</label>
                                            <div class="col-sm-10">
                                                <select name="subject" id="subject" required>
                                                    <option value="" selected disabled>Select a subject</option>
                                                    <?php
                                                    $getSubjectQuery = mysqli_query($connection, "SELECT * FROM subjects");
                                                    while ($row = mysqli_fetch_assoc($getSubjectQuery)) {
                                                        $subject_id = $row['subject_id'];
                                                        $subject_name = $row['name'];
                                                    ?>
                                                        <option class="form-control" value="<?php echo $subject_id; ?>"><?php echo $subject_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" class="form-control" id="" placeholder="Enter the title for your problem" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <textarea name="details" class="form-control" id="" required>Enter your problem description here.</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-6 col-form-label">Enter an image related to your problem</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="" style="display: inline-block; padding: 10px 20px; cursor: pointer; background-color: rgba(189,156,74,0.58); color: #1c0a0a; border-radius: 6px; font-size: 16px; transition: background-color 0.3s ease;" id="problemimage" name="problemimage">
                                            </div>
                                            <script>
                                                document.getElementById("problemimage").addEventListener("change", function () {
                                                    const fileInput = this;
                                                    const file = fileInput.files[0];
                                                    const errorText = document.getElementById("fileError");

                                                    if (file && !file.type.startsWith("image/")) {
                                                        errorText.textContent = "Only image files are allowed!";
                                                        fileInput.value = ""; // clear the invalid file
                                                    } else {
                                                        errorText.textContent = ""; // clear previous errors
                                                    }
                                                });
                                            </script>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <input type="submit" name="post" value="POST" class="btn btn-outline-warning col-sm-2 col-form-label" >
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </article>
                        <?php
                        $problemsql = $problemsql = mysqli_query($connection, " SELECT problems.*, 
                                                                                            users.name AS student_name, 
                                                                                            subjects.name AS subject_name 
                                                                                        FROM problems 
                                                                                        JOIN users ON problems.student_id = users.user_id 
                                                                                        JOIN subjects ON problems.subject_id = subjects.subject_id order by problems.problem_id DESC");

                        while ($row = mysqli_fetch_assoc($problemsql)) {
                            $problem_id = $row['problem_id'];
                            $problem_title = $row['title'];
                            $problem_description = $row['description'];
                            $postedate = $row['posted_at'];
                            $problem_image = $row['problem_img'];
                            $student_name = $row['student_name'];
                            $subject_name = $row['subject_name'];
                            ?>

                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <ul class="blog_meta list">
                                        <li><a href="#"><?php echo $student_name; ?><i class="ti-user"></i></a></li>
                                        <li><a href="#"><?php echo $postedate; ?><i class="ti-calendar"></i></a></li>
                                        <li><a href="#"><?php echo $subject_name; ?><i class="ti-eye"></i></a></li>
                                        <li><a href="#">View Profile<i class="ti-user"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="img/problems/<?php echo $problem_image; ?>" alt="">
                                    <div class="blog_details">
                                        <a href="single-post.php">
                                            <h2><?php echo $problem_title; ?></h2>
                                        </a>
                                        <p><?php echo $problem_description; ?></p>
                                        <a href="single-post.php?problemid=<?php echo $problem_id; ?>" class="blog_btn">View More</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php } ?>
                        <hr>
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