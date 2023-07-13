<?php
require('includes/db.php');
require('includes/function.php');
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
        <script src="https://www.google.com/recaptcha/api.js" async defer>
        </script>
    </head>

    <body class="home layout_changer">
        <?php include_once('navbar.php'); ?>
        <div>
            <div class="container main-container m-auto mt-3">
                <style>
                .linktooltips-container {
                    background-color: #030303;
                    color: #ffffff;
                    padding: 5px 30px;
                    border-radius: 10px;

                }
                </style>



                <?php
                $title = str_replace("-", " ", $_GET['title']);
                $post_id = $_GET['id'];
                $postQuery = "SELECT * FROM posts WHERE `title`='$title'";
                $runPQ = mysqli_query($db, $postQuery);
                $post = mysqli_fetch_assoc($runPQ);
                ?>
                <script>
                document.title = "Blog: <?php echo $title ?>";
                </script>
                <div class="card mb-3 post-div">
                    <div class="">

                        <div class="card-body">
                            <div class="top-div">
                                <div class="left-div">
                                    <h3 class="card-title"><?= $post['title'] ?></h3>
                                    <span class="bg-primary ">Posted on
                                        <?= date('F jS, Y', strtotime($post['created_at'])) ?></span>

                                    <h5 style="">
                                        <?php echo str_replace(",", " |", $post['keyword']) ?></h5>
                                </div>
                                <div class="copylink-containter">
                                    <?php
                                    $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                                    ?>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $actual_link ?>"
                                        target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?text=YOUR_TEXT&url=<?php echo $actual_link ?>"
                                        target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a
                                        href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $actual_link ?>">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                    <a href="#"><i class="fa fa-copy"
                                            onclick="navigator.clipboard.writeText(window.location.href);alert('Link Copied')"></i></a>

                                </div>
                            </div>
                            <div class="border-bottom mt-3"></div>
                            <?php

                            if (@getPostThumb($db, $post['id']) != "" || @getPostThumb($db, $post['id']) != null) {
                                ?>

                            <img src="images1/<?= getPostThumb($db, $post['id']) ?>" alt="...">
                            <?php } ?>
                            <p class="card-text"><?= $post['content'] ?>
                            </p>

                            <hr>
                            <div class="comment-section">
                                <div class="comment-box">
                                    <h3>Submit a Comment</h3>
                                    <p>Your email address will not be published. <br>Required fields are marked with '*'
                                    </p>
                                    <form action="includes/add_comment.php" method="post">
                                        <div class="mb-3">
                                            <label for="namefield" class="form-label">Name *</label>
                                            <input type="text" class="form-control" name="name" id="namefield"
                                                aria-describedby="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Email *</label>
                                            <input type="email" class="form-control" name="email"
                                                id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Comment *</label>
                                            <textarea type="text" class="form-control" rows="3" name="comment"
                                                id="exampleInputPassword1" required></textarea>
                                        </div>
                                        <div class="g-recaptcha"
                                            data-sitekey="6LfScCsUAAAAAHrKfR8QlwwHls8eqAixaBoHZWyn">
                                        </div>
                                        <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                        <input type="hidden" name="title" value="<?= $title ?>">
                                        <button type="submit" name="addcomment" class="btn btn-primary">Add
                                            Comment</button>
                                    </form>
                                </div>

                                <?php
                                if (isset($_GET['id'])) {
                                    ?>
                                <div class="comment-card mb-3">
                                    <h3 class="card-header">Comments</h3>
                                    <?php
                                        $comments = getComments($db, $post_id);
                                        if (count($comments) < 1) {
                                            echo '<div class="card-body"><p class="text-center card-text">No Comments..</p></div>';
                                        }
                                        foreach ($comments as $comment) {
                                            ?>
                                    <div class="cards" style="padding: 10px;">
                                        <h5 class="" style="">Name: <strong><?= $comment['name'] ?></strong></h5>
                                        <span class="text-secondary">
                                            <small>Date:
                                                <strong><?= date('F jS, Y', strtotime($comment['created_at'])) ?></strong>
                                            </small></span>
                                        <p style="" class="card-text">Comment:
                                            <strong><?= $comment['comment'] ?></strong>
                                        </p>
                                    </div>
                                    <?php
                                        }
                                        ?>

                                </div>
                                <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>


                    <!-- Button trigger modal -->


                    <!-- Modal -->








                </div>
                <?php include_once('includes/sidebar.php'); ?>

            </div>




            <?php include_once('footer.php'); ?>
            <style>
            .rc-anchor-normal {
                display: flex;
                flex-direction: column;
                /* height: 74px; */
                width: 70%;
            }
            </style>
            <!--End pagewrapper-->
            <!--Scroll to top-->
            <div class="scroll-to-top scroll-to-target" data-target="html">
                <span class="fa fa-angle-up"></span>
            </div>
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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
                crossorigin="anonymous">
            </script>

    </body>

</html>