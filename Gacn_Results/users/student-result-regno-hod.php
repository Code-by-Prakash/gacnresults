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

    /* Table border */
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td,
    thead {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }


    /* Table row background colors */
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    /* Table header background color */
    th {
      background-color: #ccc;
    }

    /* Total row background color */
    .total-row {
      background-color: #333;
      color: #fff;
    }

    /* Total row font style */
    .total-row strong {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <?php
  // Check if the registration number is stored in the session
  if (isset($_SESSION['regno'])) {
    $regno = $_SESSION['regno'];
  }
  ?>
  <section id="container">
    <?php include("includes/header-hod.php"); ?>
    <?php include("includes/sidebar-hod.php"); ?>
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Results for
          <?php echo "$regno " ?>
          
        </h3>

        <div class="text-left">
          <a href="student-result-hod.php" class="btn btn-primary">
            <i class="fa fa-chevron-circle-left"></i>  Back
          </a>
        </div>

        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">





              <h4 class="mb"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Semester Exam Results</h4>
              <div class="row mt">
                <div class="col-lg-12">
                  <div class="form-panel">
                    <?php
                    $sql1 = "SELECT * FROM tblstudents where tblstudents.Userid='$regno'";
                    $result1 = $con->query($sql1);

                    // Check if any results were returned
                    if ($result1->num_rows > 0) {
                      $row = $result1->fetch_assoc();
                      $student_name = $row['Name'];
                      $deg = $row['Degree & Branch'];
                      $batch = ($row['Batch Start']) . "-" . ($row['Batch End']);
                      ?>
                      <div class="text-center">
                        <div class="text-center">
                          <h4><i class="fa fa-user"></i> STUDENT PROFILE</h4>
                          <table class="table table-striped">
                            <tbody>
                              <tr>
                                <th>Student Name</th>
                                <td>
                                  <?php echo $student_name; ?>
                                </td>
                              </tr>
                              <tr>
                                <th>Degree</th>
                                <td>
                                  <?php echo $deg; ?>
                                </td>
                              </tr>
                              <tr>
                                <th>Batch</th>
                                <td>
                                  <?php echo $batch; ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mt">
                <div class="col-lg-12">
                  <div class="form-panel">
                    <h4 class="mb bg-primary text-white text-center"><i class="fa fa-pencil-square-o"></i> Results</h4>
                    <ul class="nav nav-tabs justify-content-center" id="myTabs">
  <li class="nav-item <?php if (!isset($_GET['page']) || $_GET['page'] == 'exam-result') echo 'active'; ?>">
    <a class="nav-link" href="?page=exam-result">Exam-wise</a>
  </li>
  <li class="nav-item <?php if (isset($_GET['page']) && $_GET['page'] == 'sem-result') echo 'active'; ?>">
    <a class="nav-link" href="?page=sem-result">Semester-wise</a>
  </li>
  <li class="nav-item <?php if (isset($_GET['page']) && $_GET['page'] == 'sub-result') echo 'active'; ?>">
    <a class="nav-link" href="?page=sub-result">Subject-wise</a>
  </li>
</ul>



                    <?php
                    if (isset($_GET['page'])) {
                      $page = $_GET['page'];
                      if ($page === 'exam-result') {
                        include('exam-result.php');
                      } elseif ($page === 'sem-result') {
                        include('sem-result.php');
                      } elseif ($page === 'sub-result') {
                        include('sub-result.php');
                      }
                    } else {
                      include('exam-result.php');
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
  <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
  <script src="assets/js/jquery.scrollTo.min.js"></script>
  <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="assets/js/bootstrap.min.js"></script>
    
</body>

</html>