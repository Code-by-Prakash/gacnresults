<?php 
require_once('includes/connection.php');
session_start();
    if(isset($_POST['submit']))
       {
            $query="select * from tblstudents where Userid='".$_POST['suserid']."' and Password='".$_POST['spassword']."'and Department='".$_POST['depts']."'";
            $result=mysqli_query($con,$query);

            if(mysqli_fetch_assoc($result))
            {
                $_SESSION['SUser']=$_POST['suserid'];
                header("location:profile.php");
            }
            else
            {
                $error="";
                $_SESSION['error']=$error;
                header("location:index.php");
            }
       }
    else
    {
        echo 'Something went wrong';
    }

?>