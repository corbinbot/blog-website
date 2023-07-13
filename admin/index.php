<?php
require('../includes/db.php');
require('../includes/function.php');
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || !isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

$admin = getAdminInfo($db, $_SESSION['email']);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>3leadS - Admin Panel</title>

        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- bootstrap theme -->
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <!--external css-->
        <!-- font icon -->
        <link href="css/elegant-icons-style.css" rel="stylesheet" />
        <link href="css/font-awesome.min.css" rel="stylesheet" />
        <!-- full calendar css-->
        <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
        <link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
        <!-- owl carousel -->
        <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
        <!-- Custom styles -->
        <link rel="stylesheet" href="css/fullcalendar.css">
        <link href="css/widgets.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />
        <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">

    </head>

    <body>
        <!-- container section start -->
        <section id="container" class="">


            <header class="header dark-bg">
                <div class="toggle-nav">
                    <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom">
                        <i class="icon_menu"></i>
                    </div>
                </div>

                <!--logo start-->
                <a href="index.php" class="logo">3<span class="lite">leadS</span></a>


                <div class="top-nav notification-row">
                    <!-- notificatoin dropdown start-->
                    <ul class="nav top-menu">


                        <!-- task notificatoin end -->
                        <!-- inbox notificatoin start-->

                        <!-- inbox notificatoin end -->
                        <!-- alert notification start-->

                        <!-- alert notification end-->
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                                <span class="username"><?= $admin['full_name'] ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <li class="eborder-top">
                                    <a href="#"><i class="icon_profile"></i> My Account</a>
                                </li>
                                <li>
                                    <a href="../includes/logout.php"><i class="icon_key_alt"></i> Log Out</a>
                                </li>

                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                    <!-- notificatoin dropdown end-->
                </div>
            </header>
            <!--header end-->

            <!--sidebar start-->
            <aside>
                <div id="sidebar" class="nav-collapse ">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a class="" href="index.php">
                                <i class="icon_house_alt"></i>
                                <span>Add Post</span>
                            </a>
                        </li>
                        <li class="active">
                            <a class="" href="index.php?managepost">
                                <i class="icon_house_alt"></i>
                                <span>Manage Post</span>
                            </a>
                        </li>
                        <li class="active">
                            <a class="" href="index.php?managecategory">
                                <i class="icon_house_alt"></i>
                                <span>Manage Category</span>
                            </a>
                        </li>



                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->

            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <!--overview start-->


                    <!--/.row-->


                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <?php
                            if (isset($_GET['managepost'])) {
                                ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <section class="panel">
                                        <header class="panel-heading">
                                            Posts
                                        </header>

                                        <table class="table table-striped table-advance table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Post Title</th>
                                                    <th>Post Category</th>
                                                    <th>Post Date</th>
                                                    <th>Action</th>
                                                </tr>

                                                <?php
                                                    $posts = getAllPost($db);
                                                    $count = 1;
                                                    foreach ($posts as $post) {
                                                        ?>
                                                <tr>
                                                    <td><?= $count ?></td>
                                                    <td><?= $post['title'] ?></td>
                                                    <td><?= getCategory($db, $post['category_id']) ?></td>

                                                    <td><?= date('F jS, Y', strtotime($post['created_at'])) ?></td>


                                                    <td>
                                                        <div class="btn-group ">
                                                            <a class="btn btn-warning" style="margin-right:10px"
                                                                href="index.php?editpost&id=<?= $post['id'] ?>">Edit
                                                                <i class="icon_pencil-edit"></i></a>
                                                            <a class="btn btn-success" style="margin-right:10px"
                                                                href="index.php?editcomments&id=<?= $post['id'] ?>">Comments
                                                                <i class="arrow_carrot-2right"></i></a>
                                                            <a class="btn btn-danger"
                                                                href="../includes/removepost.php?id=<?= $post['id'] ?>">Remove
                                                                <i class="icon_close_alt2"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                        $count++;
                                                    }
                                                    ?>




                                            </tbody>
                                        </table>
                                    </section>
                                </div>
                            </div>

                            <?php
                            } else if (isset($_GET['editcomments'])) {
                                ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <section class="panel">
                                        <header class="panel-heading">
                                            Posts
                                        </header>

                                        <table class="table table-striped table-advance table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Comment</th>
                                                    <th>Post Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                <?php
                                                        $post_id = $_GET['id'];
                                                        $comments = getComments($db, $post_id);
                                                        $count = 1;
                                                        if (count($comments) < 1) {
                                                            echo '<div class="card-body"><p class="text-center card-text">No Comments..</p></div>';
                                                        }
                                                        foreach ($comments as $comment) {
                                                            ?>
                                                <tr>
                                                    <td><?= $count ?></td>
                                                    <td><?= $comment['name'] ?></td>
                                                    <td><?= $comment['email'] ?></td>
                                                    <td><?= $comment['comment'] ?></td>
                                                    <td><?= date('F jS, Y', strtotime($comment['created_at'])) ?></td>


                                                    <td>
                                                        <div class="btn-group">
                                                            <a class="btn btn-danger"
                                                                href="../includes/removecomment.php?id=<?= $comment['id'] ?>">Remove
                                                                <i class="icon_close_alt2"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                            $count++;
                                                        }
                                                        ?>

                                            </tbody>
                                        </table>
                                    </section>
                                </div>
                            </div>

                            <?php
                            } else if (isset($_GET['managecategory'])) {
                                ?>
                            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
                                id="myModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button aria-hidden="true" data-dismiss="modal" class="close"
                                                type="button">×</button>
                                            <h4 class="modal-title">Add New Category</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form role="form" method="post" action="../includes/addct.php">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Category Name</label>
                                                    <input type="text" name="category-name" class="form-control"
                                                        id="exampleInputEmail3" placeholder="Enter category name.."
                                                        required>
                                                </div>



                                                <button type="submit" name="addct" class="btn btn-primary">Add</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <section class="panel">
                                        <header class="panel-heading">
                                            Category - <a href="#myModal" data-toggle="modal" class="text-primary">
                                                Add New Category
                                            </a>
                                        </header>

                                        <table class="table table-striped table-advance table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Category Name</th>
                                                    <th>Action</th>

                                                </tr>

                                                <?php
                                                            $categories = getAllCategory($db);
                                                            $count = 1;
                                                            foreach ($categories as $ct) {
                                                                ?>
                                                <tr>
                                                    <td><?= $count ?></td>
                                                    <td><?= $ct['name'] ?></td>

                                                    <td>
                                                        <div class="btn-group">

                                                            <a class="btn btn-danger"
                                                                href="../includes/removect.php?id=<?= $ct['id'] ?>">Remove
                                                                <i class="icon_close_alt2"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                                $count++;
                                                            }
                                                            ?>

                                            </tbody>
                                        </table>
                                    </section>
                                </div>
                            </div>
                            <?php
                            } else if (isset($_GET['editpost'])) {

                                if (isset($_GET["id"])) {
                                    $post_id = $_GET['id'];
                                    $postQuery = "SELECT * FROM posts WHERE id=$post_id";
                                    $runPQ = mysqli_query($db, $postQuery);
                                    $num = mysqli_num_rows($runPQ);
                                    $post = mysqli_fetch_assoc($runPQ);
                                    if ($num > 0) {
                                        ?>
                            <div class="col-lg-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                        Edit Post
                                    </header>
                                    <div class="panel-body">
                                        <div class="form">
                                            <form action="../includes/editpost.php?id=<?php echo $post['id'] ?>"
                                                method="post" enctype="multipart/form-data" class="form-horizontal">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label>Post Title</label>
                                                        <input name="id" type="text" style="display:none"
                                                            value="<?php echo $post['id'] ?>">
                                                        <input type="text" class="form-control" name="post_title"
                                                            value="<?php echo $post['title'] ?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label>Post Header Keywords (Commma Seperated)</label>
                                                        <input type="text" value="<?php echo $post['keyword']; ?>"
                                                            class="form-control" name="post_keyword" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <div class="col-sm-12">
                                                        <label>Post Content</label>
                                                        <textarea class="form-control ckeditor" name="post_content"
                                                            rows="6"><?php echo $post['content'] ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <div class="col-sm-12">
                                                            <label>Select Post Category</label>

                                                            <select name="post_category" class="form-control">
                                                                <?php
                                                                                        $categories = getAllCategory($db);
                                                                                        foreach ($categories as $ct) {
                                                                                            ?>
                                                                <option value="<?= $ct['id'] ?>"><?= $ct['name'] ?>
                                                                </option>
                                                                <?php
                                                                                        }
                                                                                        ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <input style="margin:10px" type="submit" name="editpost"
                                                    class="btn btn-primary" value="Edit Post">
                                            </form>
                                        </div>
                                    </div>
                                </section>
                            </div>

                        </div>

                    </div>
                    <?php } else {
                                        echo "Invalid id";
                                    }
                                } else {
                                    echo "no related post";
                                }

                            } else {
                                ?>
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Add Post
                            </header>
                            <div class="panel-body">
                                <div class="form">
                                    <form action="../includes/addpost.php" method="post" enctype="multipart/form-data"
                                        class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Post Title</label>
                                                <input type="text" class="form-control" name="post_title" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Post Header Keywords (Commma Seperated)</label>
                                                <input type="text" class="form-control" name="post_keyword" required>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <div class="col-sm-12">
                                                <label>Post Content</label>
                                                <textarea class="form-control ckeditor" name="post_content"
                                                    rows="6"></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <div class="col-sm-12">
                                                    <label>Select Post Category</label>

                                                    <select name="post_category" class="form-control">
                                                        <?php
                                                                    $categories = getAllCategory($db);
                                                                    foreach ($categories as $ct) {
                                                                        ?>
                                                        <option value="<?= $ct['id'] ?>"><?= $ct['name'] ?>
                                                        </option>
                                                        <?php
                                                                    }
                                                                    ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <div class="col-sm-12">
                                                    <label>Upload Photos</label>

                                                    <input type="file" class="form-control" name="post_image[]"
                                                        accept="image/*" multiple />
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" name="addpost" class="btn btn-primary" value="Add Post">
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>

                    </div>

                    </div>
                    <?php
                            }
                            ?>

                    <!-- project team & activity end -->

                </section>

            </section>
            <!--main content end-->
        </section>
        <!-- container section start -->

        <!-- javascripts -->
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui-1.10.4.min.js"></script>
        <script src="js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
        <!-- bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <!-- nice scroll -->
        <script src="js/jquery.scrollTo.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
        <!-- charts scripts -->
        <script src="assets/jquery-knob/js/jquery.knob.js"></script>
        <script src="js/jquery.sparkline.js" type="text/javascript"></script>
        <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
        <script src="js/owl.carousel.js"></script>
        <!-- jQuery full calendar -->
        <<script src="js/fullcalendar.min.js">
            </script>
            <!-- Full Google Calendar - Calendar -->
            <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
            <!--script for this page only-->
            <script src="js/calendar-custom.js"></script>
            <script src="js/jquery.rateit.min.js"></script>
            <!-- custom select -->
            <script src="js/jquery.customSelect.min.js"></script>
            <script src="assets/chart-master/Chart.js"></script>

            <!--custome script for all page-->
            <script src="js/scripts.js"></script>
            <!-- custom script for this page-->
            <script src="js/sparkline-chart.js"></script>
            <script src="js/easy-pie-chart.js"></script>
            <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
            <script src="js/jquery-jvectormap-world-mill-en.js"></script>
            <script src="js/xcharts.min.js"></script>
            <script src="js/jquery.autosize.min.js"></script>
            <script src="js/jquery.placeholder.min.js"></script>
            <script src="js/gdp-data.js"></script>
            <script src="js/morris.min.js"></script>
            <script src="js/sparklines.js"></script>
            <script src="js/charts.js"></script>
            <script src="js/jquery.slimscroll.min.js"></script>
            <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
            <!-- custom form component script for this page-->
            <script src="js/form-component.js"></script>
            <script src="js/scripts.js"></script>


    </body>

</html>