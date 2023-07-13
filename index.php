<?php
require('includes/db.php');
include('includes/function.php');

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$post_per_page = 9;
$result = ($page - 1) * $post_per_page;

// $result = 0
// $result = 5;
// $result = 10

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />

        <!-- <html lang="en" > -->
        <link rel="canonical" href="https://www.3leads.com/" />
        <title>
            Blogs
        </title>

        <!-- Stylesheets -->
        <link href="css/font-awesome.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/revolution-slider.css" rel="stylesheet" />
        <link href="css/slider-setting.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/new-styles.css" rel="stylesheet" />
        <link type="text/css" rel="stylesheet" id="jssDefault" href="css/theme-2.css" />
        <!-- Responsive -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link href="css/responsive.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
    </head>

    <body class="home layout_changer">
        <div class="page-wrapper body_wrapper">
            <!-- Preloader -->
            <!--  <div class="preloader"></div>-->
            <!-- Main Header / Header Style One-->
            <?php
            include_once("navbar.php");

            ?>

            <div>
                <div style="margin:20px">
                    <?php
                    include_once("filter.php");

                    ?>
                    <div class=" main-container m-auto">
                        <div class="default-service-block col-lg-4 col-md-6 col-sm-6 col-xs-12">

                            <?php
                            if (isset($_POST['search'])) {
                                $keyword = $_POST['word'];
                                $postQuery = "SELECT * FROM posts WHERE title LIKE '%$keyword%' ORDER BY id DESC LIMIT $result,$post_per_page";
                            } else {

                                if (isset($_GET['filter'])) {
                                    if ($_GET['filter'] == 'all') {
                                        $postQuery = "SELECT * FROM posts ORDER BY id DESC LIMIT $result,$post_per_page";
                                    } else {
                                        $id = $_GET['filter'];
                                        $postQuery = "SELECT * FROM posts WHERE category_id=$id ORDER BY id DESC LIMIT $result,$post_per_page";
                                    }
                                } else {
                                    $postQuery = "SELECT * FROM posts ORDER BY id DESC LIMIT $result,$post_per_page";
                                }
                            }

                            $runPQ = mysqli_query($db, $postQuery);
                            while ($post = mysqli_fetch_assoc($runPQ)) {
                                ?>
                                <div class="card item mb-3">
                                    <a href="post.php?title=<?= str_replace(" ", "-", $post['title']); ?>&id=<?= $post['id']; ?>"
                                        style="text-decoration:none;color:black">
                                        <div class="row g-0">

                                            <div>
                                                <div class="card-body">
                                                    <?php

                                                    if (@getPostThumb($db, $post['id']) != "" || @getPostThumb($db, $post['id']) != null) {
                                                        ?>

                                                        <img src="images1/<?= getPostThumb($db, $post['id']) ?>"
                                                            alt="Blog Image">
                                                        <?php

                                                    }
                                                    ?>


                                                    <h4 class="card-title">
                                                        <?= mb_strimwidth($post['title'], 0, 150, '...') ?></h4>
                                                    <p style="">
                                                        <?php echo mb_strimwidth(str_replace(",", " |", $post['keyword']), 0, 150, '...') ?>
                                                    </p>
                                                    <!-- <p class="card-text text-truncate">
                                                    <?= mb_strimwidth($post['content'], 0, 100, '...'); ?></p> -->
                                                    <p class="card-text"><small class="text-muted">Posted on
                                                            <?= date('F jS, Y', strtotime($post['created_at'])) ?></small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>


                        </div>
                        <?php
                        // include_once('includes/sidebar.php');
                        ?>

                    </div>
                    <?php
                    if (isset($_GET['search'])) {
                        $keyword = $_GET['search'];
                        $q = "SELECT * FROM posts WHERE title LIKE '%$keyword%'";

                    } else {
                        $q = "SELECT * FROM posts";

                    }
                    $r = mysqli_query($db, $q);
                    $total_posts = mysqli_num_rows($r);
                    $total_pages = ceil($total_posts / $post_per_page);

                    ?>
                    <nav class="navigation" aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <?php
                            if ($page > 1) {
                                $switch = "";
                            } else {
                                $switch = "disabled";
                            }
                            if ($page < $total_pages) {
                                $nswitch = "";
                            } else {
                                $nswitch = "disabled";
                            }
                            ?>
                            <li class="page-item <?= $switch ?>">
                                <a class="page-link" href="?<?php if (isset($_GET['search'])) {
                                    echo "search=$keyword&";
                                } ?>page=<?= $page - 1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <?php
                            for ($opage = 1; $opage <= $total_pages; $opage++) {
                                ?>
                                <li class="page-item"><a class="page-link" href="?<?php if (isset($_GET['search'])) {
                                    echo "search=$keyword&";
                                } ?>page=<?= $opage ?>"><?= $opage ?></a></li>

                                <?php
                            }
                            ?>

                            <li class="page-item <?= $nswitch ?>">
                                <a class="page-link" href="?<?php if (isset($_GET['search'])) {
                                    echo "search=$keyword&";
                                } ?>page=<?= $page + 1 ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--End Main Header -->
                <!--Main Slider-->

                <?php
                include_once("footer.php");

                ?>
            </div>
            <!--End pagewrapper-->
            <!--Scroll to top-->
            <div class="scroll-to-top scroll-to-target" data-target="html">
                <span class="fa fa-angle-up"></span>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
                integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
                crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
                integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
                crossorigin="anonymous"></script>
            <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
            <script src="js/jquery.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jQuery.style.switcher.min.js"></script>
            <script src="js/jquery.appear.js"></script>
            <script src="js/jquery-ui.js"></script>
            <script src="js/revolution.min.js"></script>
            <script src="js/jquery.fancybox.pack.js"></script>
            <script src="js/jquery.fancybox-media.js"></script>
            <script src="js/owl.js"></script>
            <script src="js/wow.js"></script>
            <script src="js/appear.js"></script>
            <script src="js/smoothscroll.js"></script>
            <script src="js/isotope.js"></script>
            <script src="js/script.js"></script>
            <script>
                $(".testi").owlCarousel({
                    loop: true,

                    items: 4,

                    margin: 30,

                    nav: 0,

                    smartSpeed: 1500,

                    autoplay: true,

                    autoPlaySpeed: 500,

                    autoPlayTimeout: 500,

                    autoplayHoverPause: true,

                    responsive: {
                        0: {
                            items: 1,
                        },
                        992: {
                            items: 2,
                        },
                        1200: {
                            items: 2,
                        },
                    },
                });

                var acc = document.getElementsByClassName("accordion");

                var i;

                for (i = 0; i < acc.length; i++) {
                    acc[i].addEventListener("click", function () {
                        this.classList.toggle("active");

                        var panel = this.nextElementSibling;

                        if (panel.style.display === "block") {
                            panel.style.display = "none";
                        } else {
                            panel.style.display = "block";
                        }
                    });
                }
            </script>
    </body>

</html>