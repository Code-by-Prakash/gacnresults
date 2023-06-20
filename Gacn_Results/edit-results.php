<?php
session_start();
include('includes/connection.php');
if (strlen($_SESSION['admin']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Kolkata'); // change according to timezone
	$currentTime = date('d-m-Y h:i:s A', time());
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Edit Results</title>
		<link href="assets/css/bootstrap.css" rel="stylesheet">
		<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/style-responsive.css" rel="stylesheet">
		<script language="javascript" type="text/javascript">
			var popUpWin = 0;
			function popUpWindow(URLStr, left, top, width, height) {
				if (popUpWin) {
					if (!popUpWin.closed) popUpWin.close();
				}
				popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
			}

		</script>
	</head>

	<body>
		<section id="container">
			<?php include("includes/header.php"); ?>
			<?php include("includes/sidebar.php"); ?>
			<section id="main-content">
				<section class="wrapper">
					<h3><i class="fa fa-angle-right"></i> Edit Results</h3>
					<!-- BASIC FORM ELELEMNTS -->
					<div class="row mt">
						<div class="col-lg-12">
							<div class="form-panel">

								<form method="post" action="">
									<div class="form-group">
										<label for="exam">Exam Month & Year:</label>
										<p style="color:red;">(Example: For the exam conducted in Nov 2021, select the date as 11-01-2021)</p>
										<input type="date" name="exam" required="required" class="form-control">
								
									</div>

									<input type="submit" name="submit" class="btn btn-success" value="Submit">

								</form>
								<?php
								if (isset($_POST['submit'])) {
									$exam = $_POST['exam'];
									$examFormatted = date('M Y', strtotime($exam));
									// Execute the query
									$query = "SELECT * FROM tblresults WHERE MonthYear='" . $exam . "'";
									$result = $con->query($query);

									if ($result->num_rows > 0) {
										$row = $result->fetch_assoc();
										$regno = $row['StudentId'];
										?>
										<br>
										<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
										
										<thead>

										<tr>
											
											<tr>
												<th colspan="6"  style="text-align: center;">Selected Exam:<?php echo "$examFormatted"?></th>
									</tr>
									
											</tr>
											<th>S.No.</th>
                                            <th>Reg.No</th>
											<th>Name</th>  
											
											<th>Degree & Branch</th>  
											<th>Batch</th>                                        
											<th>Action</th>
										
										</tr>
									</thead>
									<tbody>

<?php $query=mysqli_query($con,"select distinct StudentId, Name, MonthYear, `Batch Start`, `Batch End`,`Degree & Branch` from tblresults join tblstudents on tblstudents.Userid=tblresults.StudentId WHERE MonthYear='" . $exam . "'");

$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['StudentId']);?></td>
											<td><?php echo htmlentities($row['Name']);?></td>									
											<td><?php echo htmlentities($row['Degree & Branch']);?></td>
											<td><?php echo htmlentities($row['Batch Start'].'-'.$row['Batch End']);?></td>
											

<td><a href="javascript:void(0);" onClick="popUpWindow('http://localhost/Gacn_Results/admin/results.php?uid=<?php echo htmlentities($row['StudentId']);?>&exam=<?php echo htmlentities($row['MonthYear']);?>');" title="Edit Results">
<button type="button" class="btn btn-primary">Edit & Delete Results</button>
											</a>


										</td>
											
										<?php $cnt=$cnt+1; } ?>
										
								</table>										<?php

									} else
										echo "<br><p style='color:red;'>No records found</p>";
								}
								?>
							</div>
						</div>
					</div>
				</section>
			</section>
		</section>
		<script>
			function performSearch(searchTerm) {
				var selectElement = document.getElementsByName('regno')[0];
				var options = selectElement.options;

				// Loop through the options to find a match
				for (var i = 0; i < options.length; i++) {
					var option = options[i];

					if (option.value === searchTerm) {
						option.selected = true;
						break;
					}
				}
			}

		</script>
		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
		<script src="scripts/datatables/jquery.dataTables.js"></script>
		<script>
			$(document).ready(function () {
				$('.datatable-1').dataTable();
				$('.dataTables_paginate').addClass("btn-group datatable-pagination");
				$('.dataTables_paginate > a').wrapInner('<span />');
				$('.dataTables_paginate > a:first-child').append('<i class="fa fa-angle-left"></i>');
				$('.dataTables_paginate > a:last-child').append('<i class="fa fa-angle-right"></i>');
			});
		</script>
		<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
		<script src="assets/js/jquery.scrollTo.min.js"></script>
		<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
		<!--common script for all pages-->
		<script src="assets/js/common-scripts.js"></script>

		<!--script for this page-->
		<script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
	</body>
<?php } ?>

</html>