<?php
session_start();
include('includes/connection.php');
if (strlen($_SESSION['admin']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Kolkata'); // change according to timezone
    $currentTime = date('d-m-Y h:i:s A', time());
    if(isset($_GET['uid']) && $_GET['action']=='del')
    {
    $userid=$_GET['uid'];
    $query=mysqli_query($con,"delete from tblstaffs where StaffUserid='$userid'");
    header('location:edit-faculty.php');
    }
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Faculty</title>
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
					<h3><i class="fa fa-angle-right"></i> Edit Faculty</h3>
					<!-- BASIC FORM ELELEMNTS -->
					<div class="row mt">
						<div class="col-lg-12">
							<div class="form-panel">

                            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>S.No.</th>
                                            <th>Userid</th>
											<th>Name</th>
                                            <th>Department</th>
                                            <th>Profession</th>
											<th>Email </th>
											<th>Contact no</th>
											<th>Action</th>
										
										</tr>
									</thead>
									<tbody>

<?php $query=mysqli_query($con,"select * from tblstaffs");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['StaffUserid']);?></td>
											<td><?php echo htmlentities($row['staffName']);?></td>
                                            <td><?php echo htmlentities($row['Department']);?></td>
                                            
											<td><?php echo htmlentities($row['Usertype']);?></td>
											<td> <?php echo htmlentities($row['emailId']);?></td>
                                            <td> <?php echo htmlentities($row['mobile']);?></td>
                                           
										
											

<td><a href="javascript:void(0);" onClick="popUpWindow('http://localhost/Gacn_Results/admin/facultyprofile.php?uid=<?php echo htmlentities($row['StaffUserid']);?>');" title="Edit Details">
<button type="button" class="btn btn-primary">Edit Detials</button>
											</a>
<a href="edit-faculty.php?uid=<?php echo htmlentities($row['StaffUserid']);?>&&action=del" title="Delete" onClick="return confirm('Do you really want to delete ?')">
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