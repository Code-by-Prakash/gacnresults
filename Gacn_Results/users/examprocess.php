<!-- process.php -->
<?php
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  
  // Process the form data
  
  // Generate the content you want to pass back
  $processedContent = "Hello, " . $name . "! This is the processed content.";
  
  // Redirect back to the original page with the processed content as a query parameter
  header("Location: exam.php?content=" . urlencode($processedContent));
  exit();
}
?>