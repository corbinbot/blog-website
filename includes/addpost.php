<?php
require('db.php');
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || !isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}
if (isset($_POST['addpost'])) {
    $ptitle = mysqli_real_escape_string($db, $_POST['post_title']);
    $pcontent = mysqli_real_escape_string($db, $_POST['post_content']);
    $pkeyword = mysqli_real_escape_string($db, $_POST['post_keyword']);

    $cid = $_POST['post_category'];
    $query = "INSERT INTO posts (title,content,keyword, category_id) VALUES('$ptitle','$pcontent','$pkeyword',$cid)";
    $run = mysqli_query($db, $query);
    $post_id = mysqli_insert_id($db);
    echo '<PRE>';
    $image_name = $_FILES['post_image']['name'];
    $img_tmp = $_FILES['post_image']['tmp_name'];
    print_r($image_name);
    print_r($img_tmp);

    foreach ($image_name as $index => $img) {
        if (move_uploaded_file($img_tmp[$index], "../images1/$img")) {
            $query = "INSERT INTO images (post_id,image) VALUES($post_id,'$img')";
            $run = mysqli_query($db, $query);
        }
    }

    header('location:../admin/index.php?managepost');


}
?>