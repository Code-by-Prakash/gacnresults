<?php
session_start();
require_once("includes/connection.php");

if (isset($_POST['exam'])) {
  $exam = $_POST['exam'];
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
  
  $stmt = $con->prepare("SELECT DISTINCT `Batch Start`, `Batch End` FROM tblstudents
  JOIN tblresults ON tblresults.StudentId = tblstudents.Userid
  JOIN tblsubjects ON tblresults.SubjectId = tblsubjects.SubjectId
  JOIN tblsubjectcombination ON tblsubjects.SubjectId = tblsubjectcombination.SubjectId
  JOIN tblclasses ON tblsubjectcombination.ClassId = tblclasses.ClassId AND tblstudents.ClassId = tblclasses.ClassId
  JOIN tblstaffs ON tblstaffs.StaffId = tblresults.StaffId
  WHERE tblstaffs.StaffId = '$staffid' AND DATE_FORMAT(tblresults.MonthYear, '%b %Y') = '$exam'");
  
  $stmt->execute();
  $result = $stmt->get_result();
  
  echo '<option value="">Select a batch</option>';
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$row['Batch Start'].'-'.$row['Batch End'].'">'.$row['Batch Start'].'-'.$row['Batch End'].'</option>';
    }
  }
  
  $stmt->close();
}
?>
