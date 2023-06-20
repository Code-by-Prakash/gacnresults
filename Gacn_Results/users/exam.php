<?php
session_start();
require_once('includes/connection.php');

// Handle registration number submission
if (isset($_POST['submit-reg'])) {
  $_SESSION['regno'] = $_POST['regno'];
  header("Location: exam.php"); // Redirect to exam page
  exit();
}


$regno = $_SESSION['regno'];

?>

<!DOCTYPE html>
<html>

<head>
  <title>Form Page</title>
</head>

<body>
  <form action="exam.php" method="post">
    <div class="input-group mb-3 col-lg-12">
      <input name="regno" id="regno" class="form-control" placeholder="Enter student's registration number...">
    </div>
    <br>
    <button type="submit" name="submit-reg" class="btn btn-success">Submit</button>
  </form>
  
  <?php
  // Check if registration number is set
  if (isset($regno)) {
    ?>
    <form class="form-horizontal style-form" method="post" name="result" enctype="multipart/form-data">
      <div class="dropdown">
        <select class="form-control" name="exam" id="exam">
          <option value="">-- Select the exam month and year --</option>
          <?php
          // Prepare and execute SQL query to fetch exam month and year options
          $query = "SELECT DISTINCT DATE_FORMAT(MonthYear, '%b %Y') AS MonthYear FROM tblresults WHERE `tblresults`.`StudentId` ='" . $regno . "'";
          $result = mysqli_query($con, $query);

          // Loop through results and create options
          while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row['MonthYear'] . "'>" . $row['MonthYear'] . "</option>";
          }
          ?>
        </select>
        <br> <button type="submit" name="submit-exam" class="btn btn-success">Submit</button>
      </div>
    </form>
    <?php
  }

  // Handle exam submission
  if (isset($_POST['submit-exam'])) {
    $exam = $_POST['exam'];
    // Prepare and execute SQL query to fetch exam results
    $sql = "SELECT * FROM tblstudents 
            JOIN tblresults ON tblresults.StudentId = tblstudents.Userid 
            JOIN tblsubjects ON tblresults.SubjectId=tblsubjects.SubjectId 
            JOIN tblsubjectcombination on tblsubjects.SubjectId=tblsubjectcombination.SubjectId
            JOIN tblclasses on tblsubjectcombination.ClassId=tblclasses.ClassId AND tblstudents.ClassId=tblclasses.ClassId
            WHERE DATE_FORMAT(tblresults.MonthYear, '%b %Y')='" . $exam . "' and tblstudents.Userid='" . $regno . "'ORDER BY tblsubjects.Semester ASC, tblsubjects.Part ASC, tblsubjects.SubjectId ASC";

   $result = mysqli_query($con, $sql);

    // Check if any results were returned
    if (mysqli_num_rows($result) > 0) {
      // Output the exam results
      echo "<h3>EXAM: " . $exam . "</h3>";
      ?>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Semester</th>
            <th>Subject Code</th>
            <th>Part</th>
            <th>Subject Name</th>
            <th>CIA</th>
            <th>ESE</th>
            <th>Total</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = $result->fetch_assoc()) {
            // Retrieve relevant data from the result row
            $semester = $row["Semester"];
            $subject_code = $row["SubjectId"];
            $part = $row["Part"];
            $subject_name = $row["SubjectName"];
            $cia = $row["CIA"];
            $ese = $row["ESE"];
            $total = $cia + $ese;
            $result = ($total >= $row["totalPass"] && $ese >= $row["esePass"]) ? "Pass" : "RA";

            // Output the table row
            echo "<tr>";
            echo "<td>" . $semester . "</td>";
            echo "<td>" . $subject_code . "</td>";
            echo "<td>" . $part . "</td>";
            echo "<td>" . $subject_name . "</td>";
            echo "<td>" . $cia . "</td>";
            echo "<td>" . $ese . "</td>";
            echo "<td>" . $total . "</td>";
            echo "<td>" . $result . "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>

      <?php
    } else {
      echo "No results found.";
    }

    // Close the database connection
    $con->close();
  }
  ?>
</body>

</html>
