<?php
session_start();
// Connect to the database
require_once("includes/connection.php");

if (isset($_POST['exam']) && isset($_POST['batch']) && isset($_POST['class'])  ) {
  $exam = $_POST['exam'];
  $batch = $_POST['batch'];
  $years = explode('-', $batch);
  $batchStart = $years[0];
  $batchEnd = $years[1];
  $class = $_POST['class'];

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

  // Construct the SQL query
  $sql = "SELECT DISTINCT tblsubjects.Year
          FROM tblstudents
          JOIN tblresults ON tblresults.StudentId = tblstudents.Userid 
          JOIN tblsubjects ON tblresults.SubjectId = tblsubjects.SubjectId 
          JOIN tblsubjectcombination ON tblsubjects.SubjectId = tblsubjectcombination.SubjectId
          JOIN tblclasses ON tblsubjectcombination.ClassId = tblclasses.ClassId AND tblstudents.ClassId = tblclasses.ClassId
          JOIN tblstaffs ON tblstaffs.StaffId = tblresults.StaffId
          WHERE DATE_FORMAT(tblresults.MonthYear, '%b %Y') = '" . $exam . "' 
          AND tblstudents.`Batch Start` = '" . $batchStart . "' 
          AND tblstudents.`Batch End` = '" . $batchEnd . "' and tblclasses.ClassName='".$class."'
          AND tblstaffs.StaffId = '".$staffid."'";
         

  // Execute the query
  $result = $con->query($sql);

  // Return the batch start and end years as HTML options
  echo '<option value="">Select a Year</option>';
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<option value="' . $row['Year'] . '">' . $row['Year'] . '</option>';
    }
  }
  
  // Close the database connection
  $con->close();
}
?>
