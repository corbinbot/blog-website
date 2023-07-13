<?php
require('../includes/db.php');
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
  header('Location:index.php');
  exit();

}
if (isset($_POST['login'])) {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  // $username = filter_var($email, FILTER_SANITIZE_STRING);
  // $password = filter_var($password, FILTER_SANITIZE_STRING);

  $email = mysqli_real_escape_string($db, $email);
  $password = mysqli_real_escape_string($db, $password);

  $sql = "SELECT * FROM admin WHERE email=?";
  $stmt = $db->prepare($sql);

  $stmt->bind_param("s", $email);

  $stmt->execute();

  $result = $stmt->get_result();

  $data = $result->fetch_assoc();

  if ($data == null) {

    echo "<script>alert('Incorrect email or password !');</script>";

  } else if (
    $password != $data['password']
  ) {

    echo "<script>alert('Incorrect email or password !');</script>";

  } else {

    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $data['email'];
    header('Location:index.php');
    exit();

  }



  // $runQuery = mysqli_query($db, $query);
  // if (mysqli_num_rows($runQuery)) {
  //   $_SESSION['isUserLoggedIn'] = true;
  //   $_SESSION['email'] = $email;
  //   header('Location:index.php');
  // } else {
  //   echo "<script>alert('Incorrect email or password !');</script>";
  // }

}
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
        <link href="css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />

    </head>

    <body class="login-img3-body">

        <div class="container">

            <form action="login.php" class="login-form" method="post" autocomplete="off">
                <div class="login-wrap">
                    <p class="login-img"><i class="icon_lock_alt"></i></p>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon_profile"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Email" autofocus required>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>

                    <button class="btn btn-primary btn-lg btn-block" name="login" type="submit">Login</button>

                </div>
            </form>
            <div class="text-right">

            </div>
        </div>
        </div>


    </body>

</html>