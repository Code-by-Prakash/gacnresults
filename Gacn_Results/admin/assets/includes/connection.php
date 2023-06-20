<?php

    $con=mysqli_connect('localhost','root','12345678','student');

    if(!$con)
    {
        die(' Please Check Your Connection'.mysqli_error($con));
    }
?>