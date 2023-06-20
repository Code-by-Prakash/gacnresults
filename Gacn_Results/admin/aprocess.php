<?php
require_once('includes/connection.php');
session_start();

if (isset($_POST['submit'])) {
    $userid = $_POST['userid'];
    $password = md5($_POST['password']); // Hash the password using MD5

    $query = "SELECT * FROM tbladmin WHERE Userid='$userid' AND Password='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_fetch_assoc($result)) {
        $_SESSION['admin'] = $userid;
        header("location: change-password.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password!";
        header("location: index.php");
        exit();
    }
} else {
    echo 'Something went wrong';
}
?>
