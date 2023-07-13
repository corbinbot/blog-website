<?php
require 'db.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || !isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM submenu WHERE id=$id";
    mysqli_query($db, $query);
    header('location:../admin/index.php?managemenu');
}

?>