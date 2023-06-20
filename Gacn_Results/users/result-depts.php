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
  <?php include("includes/header-dept.php"); ?>
  <?php include("includes/sidebar-dept.php"); ?>
  <section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> Results</h3>
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
    <select class="form-control" name="exam" id="exam">
      <option value="">Select an exam month and year</option>
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
    <label for="batch">Batch:</label>
    <select name="batch" id="batch" class="form-control">
      <option value="">Select a batch</option>
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
    <label for="subject">Subject:</label>
    <select class="form-control" name="subject" id="subject">
      <option value="">Select a subject</option>
    </select>
  </div>

  <input type="submit" name="submit" class="btn btn-success" value="Submit">
 
</form>
<br>
<?php 


if (isset($_POST['submit'])) {
  $batch = $_POST['batch'];

  $years = explode('-', $batch);
  $batchStart = $years[0];
  $batchEnd = $years[1];
  
  $query = "SELECT DISTINCT tblstaffs.StaffId FROM tblstudents
  JOIN tblresults ON tblresults.StudentId = tblstudents.Userid
  JOIN tblsubjects ON tblresults.SubjectId = tblsubjects.SubjectId
  JOIN tblsubjectcombination ON tblsubjects.SubjectId = tblsubjectcombination.SubjectId
  JOIN tblclasses ON tblsubjectcombination.ClassId = tblclasses.ClassId AND tblstudents.ClassId = tblclasses.ClassId
  JOIN tblstaffs ON tblstaffs.StaffId = tblresults.StaffId
  WHERE tblstaffs.StaffUserid = '".$_SESSION['DUser']."'";

  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  $staffid = $row['StaffId'];
  
  if (isset($_POST['subject'])) {
    $subject_parts = explode(" (", $_POST['subject']);
    $subject_name = $subject_parts[0];
    $subject_id = '';

    if (isset($subject_parts[1])) {
        $subject_id = str_replace(")", "", $subject_parts[1]);
    }
  }

  if (isset($subject_name) && isset($subject_id)) {
    // Prepare and execute SQL query
    $sql = "SELECT  *,
    CASE 
      WHEN (tblresults.CIA + tblresults.ESE) >= tblsubjects.totalPass AND tblresults.ESE >= tblsubjects.esePass THEN 'Pass'
      ELSE 'Fail'
    END AS Result,
    (tblresults.CIA + tblresults.ESE) AS TotalMarks FROM tblstudents 
    JOIN tblresults ON tblresults.StudentId = tblstudents.Userid 
          JOIN tblsubjects ON tblresults.SubjectId = tblsubjects.SubjectId 
          JOIN tblsubjectcombination ON tblsubjects.SubjectId = tblsubjectcombination.SubjectId
          JOIN tblclasses ON tblsubjectcombination.ClassId = tblclasses.ClassId AND tblstudents.ClassId = tblclasses.ClassId
          JOIN tblstaffs ON tblstaffs.StaffId = tblresults.StaffId
          WHERE DATE_FORMAT(tblresults.MonthYear, '%b %Y') = '" . $_POST['exam'] . "' 
          AND tblstudents.`Batch Start` = '" . $batchStart . "' 
          AND tblstudents.`Batch End` = '" . $batchEnd . "' and tblclasses.ClassName='".$_POST['class']."' and tblsubjects.Year='".$_POST['year']."' and tblsubjects.SubjectName='".$subject_name."'
          AND tblstaffs.StaffId = '".$staffid."'";
    $result = $con->query($sql);

    // Check if any results were returned
    if ($result->num_rows > 0) {
      $exam = date("M Y", strtotime($_POST['exam']));

      echo '<table class="table table-striped">';
      echo '<tr><th>SUBJECT</th><td>' . $subject_name . ' (' . $subject_id . ')' . '</td></tr>';
      echo '<tr><th>EXAM</th><td>' . $exam . '</td></tr>';
      echo '<tr><th>Batch</th><td>' . $batch . '</td></tr>';


      $pass_count = 0;
      $fail_count = 0;
      $row_count = $result->num_rows;
      $max_mark = 0;
      $max_marks = array();
      $max_mark_name = '';
      $max_mark_reg = '';
      $max_mark_sql = "SELECT MAX(CIA + ESE) as MaxMark, tblstudents.Name, tblstudents.Userid FROM tblresults 
      JOIN tblstudents ON tblresults.StudentId = tblstudents.Userid 
      JOIN tblsubjects ON tblresults.SubjectId=tblsubjects.SubjectId 
      WHERE tblsubjects.SubjectName='" . $subject_name . "' 
      AND tblsubjects.SubjectId='" . $subject_id . "'";


      while ($row = $result->fetch_assoc()) {
          $class = $row['ClassName'];
          $year = $row['Year'];
          $sem = $row['Semester'];
          $batchstart = $row['Batch Start'];
          $batchend = $row['Batch End'];

          $total_marks = $row['TotalMarks'];

          if ($total_marks > $max_mark) {
              $max_mark = $total_marks;
              $max_marks = array(array($row['Name'], $row['Userid']));
          } else if ($total_marks == $max_mark) {
              array_push($max_marks, array($row['Name'], $row['Userid']));
          }

          if ($row['Result'] == 'Pass') {
              $pass_count++;
          } else {
              $fail_count++;
          }
          $pass_percent = ($pass_count / $row_count) * 100;
          $fail_percent = ($fail_count / $row_count) * 100;
      }

      echo '<tr><th>CLASS</th><td>' . $class . '&nbsp;' . $year . '&nbsp;Year</td></tr>';
      echo '<tr><th>SEMESTER</th><td>' . $sem . '</td></tr>';
      // echo '<tr><th>BATCH</th><td>' . $batchstart . ' - ' . $batchend . '</td></tr>';
      echo '<tr><th>TOTAL STUDENTS</th><td>' . $row_count . '</td></tr>';
      echo '<tr><th>PASSED STUDENTS</th><td>' . $pass_count . '/' . $row_count . ' (' . round($pass_percent, 2) . '%)</td></tr>';
      echo '<tr><th>FAILED STUDENTS</th><td>' . $fail_count . '/' . $row_count . ' (' . round($fail_percent, 2) . '%)</td></tr>';
      echo '<tr><th>HIGHEST MARK</th><td>' . $max_mark . ' (';

      foreach ($max_marks as $i => $student) {
          if ($i > 0) {
              echo ', '; // add a comma between the names of multiple students with the highest marks
          }
          echo $student[0] . ' - ' . $student[1]; // display the name and ID of the current student
      }

      echo ')</td></tr>';
      echo '</table>';
    } else {
      echo "Error: No results found.<br>";
    }
  }
}

// Close the database connection
$con->close();
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
        url: 'getbatch-dept.php',
        type: 'post',
        data: {exam: MonthYear},
        success: function(response) {
          $('#batch').html(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('An error occurred while processing your request: ' + errorThrown);
        }
      });
    } else {
      $('#batch').html('<option value="">Select a batch</option>');
      $('#class').html('<option value="">Select a class</option>');
     $('#year').html('<option value="">Select a year</option>');
      $('#subject').html('<option value="">Select a subject</option>');
    }
  });


  $('#batch').on('change', function() {
  var MonthYear = $('#exam').val();
  var Batch = $(this).val();
  if (MonthYear != '' && Batch != '') {
    $.ajax({
      url: 'getclass-dept.php',
      type: 'post',
      data: {exam: MonthYear, batch: Batch},
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
      $('#subject').html('<option value="">Select a subject</option>');
  }
});

 
$('#class').on('change', function() {
  var MonthYear = $('#exam').val();
  var Batch = $('#batch').val();
  var Class = $(this).val();
  if (MonthYear != '' && Batch != '') {
    $.ajax({
      url: 'getyear-dept.php',
      type: 'post',
      data: {exam: MonthYear, batch: Batch, class: Class},
      success: function(response) {
       
        $('#year').html(response);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('An error occurred while processing your request: ' + errorThrown);
      }
    });
  } else {
     $('#year').html('<option value="">Select a year</option>');
      $('#subject').html('<option value="">Select a subject</option>');
  }
});

 
$('#year').on('change', function() {
  var MonthYear = $('#exam').val();
  var Batch = $('#batch').val();
  var Class = $('#class').val();
  var Year = $(this).val();
  if (MonthYear != '' && Batch != ''  && Class != '') {
    $.ajax({
      url: 'getsub-dept.php',
      type: 'post',
      data: {exam: MonthYear, batch: Batch, class: Class, year: Year},
      success: function(response) {
       
        $('#subject').html(response);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('An error occurred while processing your request: ' + errorThrown);
      }
    });
  } else {
    
      $('#subject').html('<option value="">Select a subject</option>');
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