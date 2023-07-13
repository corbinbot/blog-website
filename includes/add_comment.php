<?php
require('db.php');
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || !isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}
if (isset($_POST['addcomment'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $comment = mysqli_real_escape_string($db, $_POST['comment']);
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $recaptcha = $_POST['g-recaptcha-response'];

    //     // Put secret key here, which we get
//     // from google console
//     $secret_key = 'your_secret_key';

    //     $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
//         . $secret_key . '&response=' . $recaptcha;

    //     // Making request to verify captcha
//     $response = file_get_contents($url);

    //     // Response return by google is in
// // JSON format, so we have to parse
// // that json
//     $response = json_decode($response);

    // Checking, if response is true or not
    if ($recaptcha) {
        $query = "INSERT INTO comments(comment,name,email,post_id) VALUES('$comment','$name',$email,$post_id)";
        if (mysqli_query($db, $query)) {
            header("location:../post.php?title=$title&id=$post_id");
        } else {
            echo "comment not added!";
        }
    } else {
        echo '<script>alert("Error in Google reCAPTACHA");
        window.history.back();
        </script>';

    }


}
?>