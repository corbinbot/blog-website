<?php
require('db.php');
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || !isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}
if (isset($_POST['editpost'])) {
    $ptitle = mysqli_real_escape_string($db, $_POST['post_title']);
    $pcontent = mysqli_real_escape_string($db, $_POST['post_content']);
    $pkeyword = mysqli_real_escape_string($db, $_POST['post_keyword']);
    $pcategory = mysqli_real_escape_string($db, $_POST['post_category']);
    $cid = $_POST['id'];
    $query = "UPDATE `posts` SET `content`='$pcontent', `title`='$ptitle', `keyword`='$pkeyword', `category_id`='$pcategory' WHERE `id`='$cid'";
    $run = mysqli_query($db, $query);
    $num = $run->num_rows;
    if ($num > 0) {
        echo "<script>alert('invalid ID given')</script>";
    }


    header('location:../admin/index.php?managepost');


}
?>