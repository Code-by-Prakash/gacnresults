<?php
session_start();
require_once('includes/connection.php');
if (strlen($_SESSION['DUser']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Kolkata'); // change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());
    $successmsg = "";
    $errormsg = "";

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        // Check if an image was uploaded
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $imgfile = $_FILES["image"]["name"];
    
            // get the image extension
            $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
            // allowed extensions
            $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
    
            // Validation for allowed extensions .in_array() function searches an array for a specific value.
            if (!in_array($extension, $allowed_extensions)) {
                echo '<script>alert("Invalid format (Photo). Only jpg / jpeg/ png /gif format allowed");</script>';
            } else {
                //rename the image file
                $imgnewfile = md5($imgfile) . $extension;
                // Code for move image into directory
                move_uploaded_file($_FILES["image"]["tmp_name"], "userimages/" . $imgnewfile);
    
                // Update user image and email in the database
                $query = mysqli_query($con, "UPDATE tblstaffs SET staffImage='$imgnewfile', emailId='$email',updationDate=NOW() WHERE StaffUserId='" . $_SESSION['DUser'] . "'");
                if ($query) {
                    $successmsg = "Profile successfully updated !!";
                } else {
                    $errormsg = "Profile not updated !!";
                }
            }
        } else {
            // Update only email in the database
            $query = mysqli_query($con, "UPDATE tblstaffs SET emailId='$email', mobile='$mobile',updationDate=NOW() WHERE StaffUserId='" . $_SESSION['DUser'] . "'");
            if ($query) {
                $successmsg = "Profile successfully updated !!";
            } else {
                $errormsg = "Profile not updated !!";
            }
        }
    }
      
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
</head>

<body>
    <section id="container">
        <?php include("includes/header-hod.php"); ?>
        <?php include("includes/sidebar-hod.php"); ?>
        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i> Edit Profile</h3>
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

                            <?php $query = mysqli_query($con, "select * from tblstaffs where StaffUserId='" . $_SESSION['DUser'] . "'");
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <h4 class="mb"><i class="fa fa-user"></i>&nbsp;&nbsp;
                                    <?php echo htmlentities($row['staffName']); ?>'s Profile
                                </h4>
                                <h5><b>Last Updated at :</b>&nbsp;&nbsp;
                                    <?php echo htmlentities($row['updationDate']); ?>
                                </h5>
                                <form class="form-horizontal style-form" method="post" name="profile"
                                    enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="name" required="required"
                                                value="<?php echo htmlentities($row['staffName']); ?>" class="form-control"
                                                readonly>
                                        </div>
                                        <label class="col-sm-2 control-label">Department</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="dept" required="required"
                                                value="<?php echo htmlentities($row['Department']); ?>" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email Id</label>
                                        <div class="col-sm-4">
                                            <input type="email" name="email"
                                                value="<?php echo htmlentities($row['emailId']); ?>" class="form-control">
                                        </div>
                                        <label class="col-sm-2 control-label">Mobile</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="mobile"
                                                value="<?php echo htmlentities($row['mobile']); ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Photo</label>
                                        <div class="col-sm-4">
                                            <?php $userphoto = $row['staffImage'];
                                            if ($userphoto == ""):
                                                ?>
                                                <img src="userimages/noimage.png" width="256" height="256">
                                            <?php else: ?>
                                                <img src="userimages/<?php echo htmlentities($userphoto); ?>" width="256"
                                                    height="256">

                                            <?php endif; ?>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Upload New Photo</label>
                                        <div class="col-sm-4">
                                            <input type="file" name="image" />
                                        </div>

                                    </div>
                                <?php } ?>
                                <div class="form-group">

                                    <div class="col-sm-10" style="padding-left:25% ">
                                        <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>



       <!-- jQuery -->
       <script src="assets/js/jquery.js"></script>
       <script src="assets/js/bootstrap.min.js></script>

       <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


</body>

</html>