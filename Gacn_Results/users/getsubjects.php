<?php
require_once('includes/connection.php');

if (isset($_POST['exam'])) {
    $exam = $_POST['exam'];

  // Prepare the SQL query
  $stmt = $con->prepare("SELECT DISTINCT tblsubjects.SubjectName,tblsubjectcombination.SubjectId FROM tblstudents 
  JOIN tblresults ON tblresults.StudentId = tblstudents.Userid 
  JOIN tblsubjects ON tblresults.SubjectId=tblsubjects.SubjectId 
  JOIN tblsubjectcombination on tblsubjects.SubjectId=tblsubjectcombination.SubjectId
  JOIN tblclasses on tblsubjectcombination.ClassId=tblclasses.ClassId AND tblstudents.ClassId=tblclasses.ClassId JOIN tblstaffs on tblstaffs.Department=tblstudents.Department
  WHERE DATE_FORMAT(tblresults.MonthYear, '%b %Y') = ? ");
  $stmt->bind_param("s", $exam);
  $stmt->execute();
  $result = $stmt->get_result();

  // Output the subjects as options for the subject dropdown
  echo '<option value="">Select a subject</option>';
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo '<option value="' . $row['SubjectName'] . ' (' . $row['SubjectId'] . ')">' . $row['SubjectName'] . ' (' . $row['SubjectId'] . ')</option>';


    }
  } else {
    echo '<option value="">No subjects found</option>';
  }

  $stmt->close();
}
?>
