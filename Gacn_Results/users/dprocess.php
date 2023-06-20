<?php 
 require_once('includes/connection.php');
session_start();
    if(isset($_POST['submit']))
       {    
            
            $query="select * from tblstaffs where StaffUserid='".$_POST['duserid']."' and Password='".$_POST['dpassword']."' and Department='".$_POST['ddepts']."'";
            $result=mysqli_query($con,$query);

            $row = mysqli_fetch_assoc($result);
            if($row)
            {  
                
                $_SESSION['DUser']=$_POST['duserid'];
                $user= $row['Usertype'];
                if ($user == 'hod')
                { header("location:profile-hod.php");
            }
            elseif ($user == 'staff') {
                header("location:profile-dept.php");
            } 
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
