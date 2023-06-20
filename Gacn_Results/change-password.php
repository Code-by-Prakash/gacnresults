<?php
session_start();
include('includes/connection.php');
if (strlen($_SESSION['admin']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Kolkata'); // change according to timezone
    $currentTime = date('d-m-Y h:i:s A', time());

	if (isset($_POST['submit'])) {
		$currentPassword = md5($_POST['password']); // Hash the entered password
		$newPassword = md5($_POST['newpassword']); // Hash the new password
		$confirmPassword = md5($_POST['confirmpassword']); // Hash the confirm password
	
		$sql = mysqli_query($con, "SELECT Password FROM  tbladmin WHERE Userid='" . $_SESSION['admin'] . "'");
		$result = mysqli_fetch_array($sql);
		$storedPassword = $result['Password'];
	
		if ($currentPassword === $storedPassword) { // Compare hashed passwords
			if ($newPassword === $confirmPassword) {
				$updateQuery = "UPDATE tbladmin SET Password='$newPassword', updationDate='$currentTime' WHERE Userid='" . $_SESSION['admin'] . "'";
				$con->query($updateQuery);
				$_SESSION['msg'] = "Password Changed Successfully!";
			} else {
				$_SESSION['msg'] = "New Password and Confirm Password do not match!";
			}
		} else {
			$_SESSION['msg'] = "Current Password is incorrect!";
		}
	}
    ?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin | Change Password</title>
		<link href="assets/css/bootstrap.css" rel="stylesheet">
		<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/style-responsive.css" rel="stylesheet">
		
	
	
		<script type="text/javascript">
			function valid() {
				if (document.chngpwd.password.value == "") {
					alert("Current Password Filed is Empty !!");
					document.chngpwd.password.focus();
					return false;
				}
				else if (document.chngpwd.newpassword.value == "") {
					alert("New Password Filed is Empty !!");
					document.chngpwd.newpassword.focus();
					return false;
				}
				else if (document.chngpwd.confirmpassword.value == "") {
					alert("Confirm Password Filed is Empty !!");
					document.chngpwd.confirmpassword.focus();
					return false;
				}
				else if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
					alert("Password and Confirm Password Field do not match  !!");
					document.chngpwd.confirmpassword.focus();
					return false;
				}
				return true;
			}
		</script>
	</head>

	<body>
		<section id="container">
			<?php include("includes/header.php"); ?>
			<?php include("includes/sidebar.php"); ?>
			<section id="main-content">
				<section class="wrapper">
					<h3><i class="fa fa-angle-right"></i> Change Password</h3>
					<!-- BASIC FORM ELELEMNTS -->
					<div class="row mt">
						<div class="col-lg-12">
							<div class="form-panel">
								
							<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>
									
							<form class="form-horizontal row-fluid" name="chngpwd" method="post" onSubmit="return valid();">

	<div class="control-group">
		<label class="control-label" for="basicinput">Current Password</label>
		<div class="controls">
			<input type="password" placeholder="Enter your current Password" name="password" class="span12 tip" required>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="basicinput">New Password</label>
		<div class="controls">
			<input type="password" placeholder="Enter your new current Password" name="newpassword" class="span12 tip" required>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="basicinput">Confirm New Password</label>
		<div class="controls">
			<input type="password" placeholder="Enter your new Password again" name="confirmpassword" class="span12 tip" required>
		</div>
		
	</div>
	<br>
	<br>
	<div class="control-group">
		<div class="controls">
			
			<button type="submit" name="submit" class="btn btn-success">Submit</button>
		</div>
	</div>
</form>
							</div>
						</div>
					</div>
				</section>
			</section>
		</section>
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
		<script src="assets/js/jquery.scrollTo.min.js"></script>
		<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


		<!--common script for all pages-->
		<script src="assets/js/common-scripts.js"></script>

		<!--script for this page-->
		<script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>

		
	</body>
	
<?php } ?>
