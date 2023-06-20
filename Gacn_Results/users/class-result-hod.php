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
<section id="container">
  <?php include("includes/header-hod.php"); ?>
  <?php include("includes/sidebar-hod.php"); ?>
  <section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> Results (Class wise)</h3>
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Semester Exam Results</h4>
            <div class="row mt">
              <div class="col-lg-12">
                <div class="form-panel">
                <form method="post" action="">
  <div class="form-group">
    <label for="exam">Exam:</label>
    <select name="exam" id="exam" class="form-control">
      <option value="">Select an exam</option>
      <?php
       

        // select data from database
        $query = "SELECT DISTINCT DATE_FORMAT(MonthYear, '%b %Y') AS MonthYear 
                  FROM tblresults ";

        $result = mysqli_query($con, $query);

        // loop through results and create options
        while ($row = mysqli_fetch_array($result)) {
          echo "<option value='" . $row['MonthYear'] . "'>" . $row['MonthYear'] . "</option>";
        }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="class">Class:</label>
    <select name="class" id="class" class="form-control">
      <option value="">Select a class</option>
    </select>
  </div>

  <div class="form-group">
    <label for="year">Year:</label>
    <select name="year" id="year" class="form-control">
      <option value="">Select a year</option>
    </select>
  </div>

  <div class="form-group">
    <label for="batch">Batch:</label>
    <select name="batch" id="batch" class="form-control">
      <option value="">Select a batch</option>
    </select>
  </div>

  <input type="submit" name="submit" class="btn btn-success" value="Submit">
</form>
<br>

<?php 

if (isset($_POST['submit']))
{
    
 
    // select department from the database
    $query = "SELECT * FROM `tblstaffs` WHERE `StaffUserid` = '".$_SESSION['DUser']."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $department = $row['Department'];
    
    
    // Prepare and execute SQL query
    $sql = "SELECT tblstudents.UserId,Name,
    SUM(CASE WHEN tblresults.CIA + tblresults.ESE >= tblsubjects.totalPass AND tblresults.ESE >= tblsubjects.esePass THEN 1 ELSE 0 END) AS PassCount,
    SUM(CASE WHEN tblresults.CIA + tblresults.ESE < tblsubjects.totalPass OR tblresults.ESE < tblsubjects.esePass THEN 1 ELSE 0 END) AS FailCount,
    (tblresults.CIA + tblresults.ESE) AS TotalMarks,
    CASE 
        WHEN (tblresults.CIA + tblresults.ESE) >= tblsubjects.totalPass AND tblresults.ESE >= tblsubjects.esePass THEN 'Pass'
        ELSE 'Fail'
    END AS Result
    FROM tblstudents 
    JOIN tblresults ON tblresults.StudentId = tblstudents.Userid 
    JOIN tblsubjects ON tblresults.SubjectId=tblsubjects.SubjectId 
    JOIN tblsubjectcombination ON tblsubjects.SubjectId=tblsubjectcombination.SubjectId
    JOIN tblclasses ON tblsubjectcombination.ClassId=tblclasses.ClassId AND tblstudents.ClassId=tblclasses.ClassId 
    JOIN tblstaffs ON tblstaffs.StaffId=tblresults.StaffId
    WHERE DATE_FORMAT(tblresults.MonthYear, '%b %Y') = '".$_POST['exam']."' AND tblclasses.ClassName ='".$_POST['class']."' 
    AND tblsubjects.Year='".$_POST['year']."' AND tblstudents.Department='".$department."'
     AND CONCAT(tblstudents.`Batch Start`, '-', tblstudents.`Batch End`)='".$_POST['batch']."'
    GROUP BY tblstudents.UserId";

$result = mysqli_query($con, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
  $exam=date("M Y", strtotime($_POST['exam']));
      
  echo "<table class='table table-striped'>";
  echo "<tr><th>CLASS</th><td>" . $_POST['class'] .' - '.$_POST['year'].' Year'. "</td></tr>";
  echo "<tr><th>BATCH</th><td>" .$_POST['batch'] . "</td></tr>";
  echo "<tr><th>EXAM</th><td>" . $exam . "</td></tr>";
  
  
    // Initialize pass and fail counters
    $passCount = 0;
    $failCount = 0;
    $row_count = $result->num_rows;
    $passedStudents = array();
    $failedStudents = array();
    // Loop through the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the student passed all the subjects
        if ($row["FailCount"] == 0) {
            $passCount++;
            $passedStudents[] = $row;
        } else {
            $failCount++;
            $failedStudents[] = $row;
        }
        
    }
    
    // Calculate the total count of students
    $totalCount = $passCount + $failCount;
    $pass_percent = ($passCount / $row_count) * 100;
    $fail_percent = ($failCount / $row_count) * 100;  
    // Output the results
    echo "<tr><th>TOTAL STUDENTS</th><td>" . $totalCount.'/'.$row_count;
    echo "<tr><th>ALL CLEARED STUDENTS</th><td>". $passCount . '/'.$row_count.' ('.$pass_percent.'%'.')'."<br>";
    echo "<tr><th>FAILED STUDENTS</th><td>" . $failCount  .'/'.$row_count.' ('.$fail_percent.'%'.')'."<br>";
    echo "</table>";
    ?>
<div class="inline-block-container">
    <?php
    if ($passCount > 0) {
        echo '<table class="table table-striped">';
        echo '<thead><tr><th colspan="2" style="text-align:center">All Clear Students List</th></tr><tr>
        <th  style="text-align:center;">Reg.No</th><th style="text-align:center;">Name</th></tr></thead>';
        echo '<tbody>';
        foreach ($passedStudents as $student) {
            echo '<tr><td>' . $student['UserId'] . '</td><td>' . $student['Name'] . '</td></tr>';
        }
        echo '</tbody></table>';
    }
    ?>
</div>

<div class="inline-block-container">
    <?php
    if ($failCount > 0) {
        echo '<table class="table table-striped">';
        echo '<thead><tr><th colspan="2"style=" text-align:center">Failed Students List
        </th></tr><tr><th style="text-align:center;">Reg.No</th><th style="text-align:center;">Name</th></tr></thead>';
        echo '<tbody>';
        foreach ($failedStudents as $student) {
            echo "<tr><td>" . $student['UserId'] . "</td><td>" . $student['Name'] . "</td></tr>";
        }
        echo "</table>";
    }
    ?>
</div>
  <?php
  }

   else {
    echo "No results found.";
}
// Close the connection
mysqli_close($con);
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
<script>
 
  $('#exam').on('change', function() {
    var MonthYear = $(this).val();
    if (MonthYear != '') {
      $.ajax({
        url: 'getclasses.php',
        type: 'post',
        data: {exam: MonthYear},
        success: function(response) {
          $('#class').html(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('An error occurred while processing your request: ' + errorThrown);
        }
      });
    } else {
      $('#class').html('<option value="">Select a class</option>');
      $('#year').html('<option value="">Select a year</option>');
      $('#batch').html('<option value="">Select a batch</option>');
    }
  });
 
  $('#class').on('change', function() {
    var ClassName = $(this).val();
    if (ClassName != '') {
      $.ajax({
        url: 'getyear.php',
        type: 'post',
        data: {class: ClassName},
        success: function(response) {
          $('#year').html(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('An error occurred while processing your request: ' + errorThrown);
        }
      });
    } else {
      $('#year').html('<option value="">Select a year </option>');
      $('#batch').html('<option value="">Select a batch</option>');
    }
  });
  
  $('#year').on('change', function() {
  var ExamMonthYear = $('#exam').val();
  var ClassName = $('#class').val();
  var Year = $(this).val();
  if (ExamMonthYear != '' && ClassName != '' && Year != '') {
    $.ajax({
      url: 'getbatch.php',
      type: 'post',
      data: {exam: ExamMonthYear, class: ClassName, year: Year},
      success: function(response) {
       
        $('#batch').html(response);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('An error occurred while processing your request: ' + errorThrown);
      }
    });
  } else {
    $('#batch').html('<option value="">Select a batch</option>');
  }
});


</script>

  <!-- js placed at the end of the document so the pages load faster -->

  <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
  <script src="assets/js/jquery.scrollTo.min.js"></script>
  <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="assets/js/bootstrap.min.js"></script>

 
</body>

</html>