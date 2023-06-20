<?php
require_once("includes/connection.php");

if (isset($_POST['class'])) {
  $class = $_POST['class'];

  // Prepare the SQL query
  $stmt = $con->prepare("SELECT DISTINCT tblsubjects.Year
                         FROM tblclasses
                         JOIN tblsubjectcombination ON tblclasses.ClassId = tblsubjectcombination.ClassId
                         JOIN tblsubjects ON tblsubjectcombination.SubjectId = tblsubjects.SubjectId
                         JOIN tblresults ON tblsubjects.SubjectId = tblresults.SubjectId
                         JOIN tblstudents ON tblresults.StudentId = tblstudents.Userid
                         WHERE tblclasses.ClassName = ?");
  $stmt->bind_param("s", $class);
  $stmt->execute();
  $result = $stmt->get_result();

  // Output the classes as options for the class dropdown
  echo '<option value="">Select a year</option>';
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo '<option value="'.$row['Year'].'">'.$row['Year'].'</option>';
    }
  } else {
    echo '<option value="">No year found</option>';
  }

  $stmt->close();
}
?>

