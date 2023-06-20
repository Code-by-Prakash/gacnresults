<?php
session_start();
include('includes/connection.php');
if (strlen($_SESSION['admin']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Kolkata'); // change according to timezone
    $currentTime = date('d-m-Y h:i:s A', time());
    if(isset($_GET['sid']) && $_GET['action']=='del')
    {
    $sid=$_GET['sid'];
    $query=mysqli_query($con,"delete from tblsubjects where SubjectId='$sid'");
    header('location:edit-subjects.php');
    }
	if(isset($_GET['id']) && $_GET['action']=='del')
    {
    $id=$_GET['id'];
    $query=mysqli_query($con,"delete from tblsubjectcombination where Id='$id'");
    header('location:edit-subjects.php');
    }
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subjects</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
		<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
       
		<!-- Custom styles for this template -->
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/style-responsive.css" rel="stylesheet">
        <script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
</head>
<body>
<section id="container">
			<?php include("includes/header.php"); ?>
			<?php include("includes/sidebar.php"); ?>
			<section id="main-content">
				<section class="wrapper">
					<h3><i class="fa fa-angle-right"></i> Edit Subjects</h3>
					<!-- BASIC FORM ELELEMNTS -->
					<div class="row mt">
						<div class="col-lg-12">
							<div class="form-panel">

                            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>S.No.</th>
                                            <th>Code</th>
                                            <th>Name</th>
											<th>Semester</th>   
                                            <th>Year</th>  
                                            <th>Part</th>  
                                          
                                            <th>Batch Start</th> 
                                            <th>Batch End</th>                                           
											<th>Action</th>
										
										</tr>
									</thead>
									<tbody>

<?php $query=mysqli_query($con,"select * from tblsubjects");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['SubjectId']);?></td>
											<td><?php echo htmlentities($row['SubjectName']);?></td>
                                            <td><?php echo htmlentities($row['Semester']);?></td>
                                            <td><?php echo htmlentities($row['Year']);?></td>
                                            <td><?php echo htmlentities($row['Part']);?></td>
                                           
                                            <td><?php echo htmlentities($row['BatchStart']);?></td>
                                            <td><?php echo htmlentities($row['BatchEnd']);?></td>
                                           
					

<td><a href="javascript:void(0);" onClick="popUpWindow('http://localhost/Gacn_Results/admin/subjects.php?sid=<?php echo htmlentities($row['SubjectId']);?>');" title="Edit Subject">
<button type="button" class="btn btn-primary">Edit Subject</button>
											</a>
<a href="edit-subjects.php?sid=<?php echo htmlentities($row['SubjectId']);?>&&action=del" title="Delete" onClick="return confirm('Do you really want to delete ?')">
<button type="button" class="btn btn-danger">Delete</button></a>

										</td>
											
										<?php $cnt=$cnt+1; } ?>
										
								</table>

                            
							</div>
						</div>
					</div>
				</section>
			</section>
			<section id="main-content">
				<section class="wrapper">
					
					<!-- BASIC FORM ELELEMNTS -->
					<div class="row mt">
						<div class="col-lg-12">
							<div class="form-panel">
							<h3 align='center'>Edit Subject - Class Combinations</h3>
                            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>S.No.</th>
                                            <th>Class Id</th>
                                            <th>Subject Id</th>
                                                                                    
											<th>Action</th>
										
										</tr>
									</thead>
									<tbody>

<?php $query=mysqli_query($con,"select * from tblsubjectcombination");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
										<td><?php echo htmlentities($row['Id']);?></td>
                                            <td><?php echo htmlentities($row['ClassId']);?></td>
											<td><?php echo htmlentities($row['SubjectId']);?></td>                                           
                                           
					

<td><a href="javascript:void(0);" onClick="popUpWindow('http://localhost/Result_Analysis/admin/subject-class.php?id=<?php echo htmlentities($row['Id']);?>');" title="Edit Subject-Class">
<button type="button" class="btn btn-primary">Edit Details</button>
											</a>
<a href="edit-subjects.php?id=<?php echo htmlentities($row['Id']);?>&&action=del" title="Delete" onClick="return confirm('Do you really want to delete ?')">
<button type="button" class="btn btn-danger">Delete</button></a>

										</td>
											
										<?php $cnt=$cnt+1; } ?>
										
								</table>

                            
							</div>
						</div>
					</div>
				</section>
			</section>
		</section>

        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="fa fa-angle-left"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="fa fa-angle-right"></i>');
		} );
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