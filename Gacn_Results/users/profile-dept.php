<?php
session_start();
require_once('includes/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <style>
        img {
            display: block;
            margin: 0 auto;
            max-width: 90%;
            padding: 0;
        }


        .branding {
            font-weight: bold;
            line-height: 25px;
            letter-spacing: 1px;
            color: white;
            margin-top: 0;
            max-width: 30%;
            margin-left: auto;
            margin-right: auto;
            background-color: #04AA6D;
            text-align: center;
            font-size: 12px;
            border-bottom-right-radius: 4% 100%;
            border-bottom-left-radius: 4% 100%;
        }

        @media (min-width: 768px) {
            .branding {
                line-height: 25px;
                letter-spacing: 1px;
                max-width: 50%;
                font-size: 12px;
            }
        }

        @media (min-width: 992px) {
            .branding {
                line-height: 25px;
                letter-spacing: 1px;
                max-width: 38%;
                font-size: 12px;
            }
        }

        @media (max-width: 768px) {
            .branding {
                line-height: 15px;
                letter-spacing: 1px;
                max-width: 60%;
                font-size: 8px;
            }
        }

        @media (max-width: 420px) {
            .branding {
                line-height: 10px;
                letter-spacing: 1px;
                max-width: 60%;
                font-size: 6px;
            }
        }

        @media (max-width: 336px) {
            .branding {
                line-height: 8px;
                letter-spacing: 1px;
                max-width: 50%;
                font-size: 4px;
            }
        }
        
  table {
    border-collapse: collapse;
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto;
  }
  
  th, td {
    text-align: left;
    padding: 8px;
  }
  
  th {
    width: 30%;
    font-weight: bold;
  }
  
  td {
    width: 40%;
  }
  
  tr:nth-child(even) {
    background-color: #04AA6D;
  }
  tr:nth-child(odd) {
    background-color:rgb(0, 120, 175);
  }
 
  /* Optional: Add borders to the table */
  th, td {
    border: 1px solid black;
    
  }
  

 
    </style>
</head>

<body>
    <section id="container">
        <?php include("includes/header-dept.php"); ?>
        <?php include("includes/sidebar-dept.php"); ?>
        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i> Profile info</h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                        <?php $query=mysqli_query($con,"select * from tblstaffs where staffUserId='".$_SESSION['DUser']."'");
 while($row=mysqli_fetch_array($query)) 
 {
 ?>      
 <h4 class="mb"><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo htmlentities($row['staffName']);?>'s Profile</h4>
    <h5><b>Last Updated at :</b>&nbsp;&nbsp;<?php echo htmlentities($row['updationDate']);?></h5>
                      <form class="form-horizontal style-form" method="post" name="profile" >
                      <table class="table table-striped">
                      
  <tr>
    <th>NAME</th>
    <td><?php echo  htmlentities($row['staffName']); ?></td>
  </tr>
  <tr>
    <th>DEPARTMENT</th>
    <td><?php echo  htmlentities($row['Department']); ?></td>
  </tr>
  <tr>
    <th>PROFESSION</th>
    <td><?php echo htmlentities($row['Usertype']); ?></td>
  </tr>
  <tr>
    <th>ID</th>
    <td><?php echo htmlentities($row['StaffId']); ?></td>
  </tr>
  <tr>
    <th>EMAIL ID</th>
    <td><?php echo  htmlentities($row['emailId']); ?></td>
  </tr>
  <tr>
    <th>MOBILE</th>
    <td><?php echo  htmlentities($row['mobile']); ?></td>
  </tr>
  <tr>
    <th>GENDER</th>
    <td><?php echo  htmlentities($row['gender']); ?></td>
  </tr>
</table>
 
<?php } ?>
<div class="form-group">
<div class="col-sm-10" >
<a  class="btn btn-primary"  href="edit-profile-dept.php">Edit Profile </a>
</div>
</div>

                           
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- js placed at the end of the document so the pages load faster -->

    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


   
</body>


</html>