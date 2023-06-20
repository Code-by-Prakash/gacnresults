<?php
session_start();
include('includes/connection.php');
if (strlen($_SESSION['admin']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Kolkata'); // change according to timezone
    $currentTime = date('d-m-Y h:i:s A', time());
    $successmsg = "";
    $errormsg = "";
    if (isset($_POST['submit'])) 
    {
        $id = $_POST['nid'];
        $title = $_POST['title']; 
        $info = $_POST['info']; 
        $query = mysqli_query($con, "INSERT INTO tblnotice (`id`, noticeTitle, noticeDetails, updationDate) 
        VALUES ('$id', '$title','$info',  NOW())");

   if ($query) {
    $successmsg = "Added new notice successfully !!";
} else {
    $errormsg = "Notice not added !!";
}
    }
    
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notes</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">
</head>
<body>
<section id="container">
			<?php include("includes/header.php"); ?>
			<?php include("includes/sidebar.php"); ?>
			<section id="main-content">
				<section class="wrapper">
					<h3><i class="fa fa-angle-right"></i> Add Notes</h3>
					<!-- BASIC FORM ELELEMNTS -->
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="form-panel">
                            <?php if ($successmsg) { ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <b>Well done!</b>
                                    <?php echo htmlentities($successmsg); ?>
                                </div>
                            <?php } ?>

                            <?php if ($errormsg) { ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <b>Oh snap!</b> </b>
                                    <?php echo htmlentities($errormsg); ?>
                                </div>
                            <?php } ?>
                                <form class="form-horizontal style-form" method="post" name="class"
                                    enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">id</label>
                                        <div class="col-sm-4">
                                            <input type="number" name="nid" min="1" placeholder="Enter the id" required="required" class="form-control">
                                        </div>
                                        <label class="col-sm-2 control-label">Title</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="title" placeholder="Enter the title of notice" required="required" class="form-control">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Details</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="info" placeholder="Enter the full details of notice" required="required" class="form-control">
                                      
                                            </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group text-center">
                                        <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-sticky-note"></i> +Add Notice</button>
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
</html>