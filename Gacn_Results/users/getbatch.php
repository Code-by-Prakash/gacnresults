<?php
// Connect to the database
require_once("includes/connection.php");

// Check if the exam, class, and year values are set in the AJAX request
if(isset($_POST['exam']) && isset($_POST['class']) && isset($_POST['year'])){

  // Get the exam, class, and year values from the AJAX request
  $exam = $_POST['exam'];
  $class = $_POST['class'];
  $year = $_POST['year'];

  // Prepare the query to retrieve the batch start and end years
  $stmt = $con->prepare("SELECT DISTINCT `Batch Start`, `Batch End`
          FROM tblstudents
          JOIN tblresults ON tblstudents.Userid = tblresults.StudentId
          JOIN tblclasses ON tblstudents.ClassId = tblclasses.ClassId
          JOIN tblsubjectcombination ON tblclasses.ClassId = tblsubjectcombination.ClassId
          JOIN tblsubjects ON tblsubjectcombination.SubjectId = tblsubjects.SubjectId
          WHERE DATE_FORMAT(tblresults.MonthYear, '%b %Y') = ?
            AND tblclasses.ClassName = ?
            AND tblsubjects.Year = ?
          ORDER BY `Batch Start` DESC");

  // Bind the exam, class, and year parameters
  $stmt->bind_param("sss", $exam, $class, $year);

  // Execute the query
  $stmt->execute();

  // Get the result set
  $result = $stmt->get_result();

  // Return the batch start and end years as HTML options
  echo '<option value="">Select a batch</option>';
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['Batch Start'] . '-' . $row['Batch End'] . '">' . $row['Batch Start'] . '-' . $row['Batch End'] . '</option>';
    }
  }
  $stmt->close();
  $con->close();
}
?>
