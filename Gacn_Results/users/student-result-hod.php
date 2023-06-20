<?php
session_start();
ob_start();
require_once('includes/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Results</title>
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

    th,
    td {
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
      background-color: rgb(0, 120, 175);
    }

    /* Optional: Add borders to the table */
    th,
    td {
      border: 1px solid black;

    }
  </style>
</head>

<body>
<section id="container">
  <?php include("includes/header-hod.php"); ?>
  <?php include("includes/sidebar-hod.php"); ?>
  <section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> Results (By Reg no)</h3>
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Semester Exam Results</h4>
            <div class="row mt">
              <div class="col-lg-12">
                <div class="form-panel">
                  <form action="student-result-hod.php" method="post">
                    <div class="input-group mb-3 col-lg-12">
                      <input name="regno" id="regno" class="form-control" placeholder="Enter student's registration number...">
                    </div>
                    <br>
                    <button type="submit" name="submit-reg" class="btn btn-success">Submit</button>
                  </form>
             
            <?php
            if (isset($_POST['submit-reg'])) {
              $regno = $_POST['regno'];
              $sql = "SELECT * FROM tblstudents 
                          JOIN tblresults ON tblresults.StudentId = tblstudents.Userid 
                          JOIN tblsubjects ON tblresults.SubjectId=tblsubjects.SubjectId 
                          JOIN tblsubjectcombination on tblsubjects.SubjectId=tblsubjectcombination.SubjectId
                          JOIN tblclasses on tblsubjectcombination.ClassId=tblclasses.ClassId AND tblstudents.ClassId=tblclasses.ClassId
                          JOIN tblstaffs on tblresults.StaffId=tblstaffs.StaffId 
                          WHERE tblstudents.Userid='$regno' AND tblstaffs.Department=tblstudents.Department";
              $result = $con->query($sql);
              // Check if any results were returned
              if ($result->num_rows == 0) {
                echo "<br><p style='color:red;'>Student does not exist!</p>";
              } else {
                // Store the registration number in a session variable
                $_SESSION['regno'] = $regno;

                // Redirect to the appropriate page based on the form details
                header("Location: student-result-regno-hod.php");
                exit(); // Terminate the current script
              }
            }
            ?>
               </div>
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
  <script src="assets/js/bootstrap.min.js"></script>

 
</body>

</html>