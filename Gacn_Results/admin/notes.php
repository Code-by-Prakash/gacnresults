<?php
session_start();
require_once('includes/connection.php');
if (strlen($_SESSION['admin']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Kolkata'); // change according to timezone
    $currentTime = date('d-m-Y h:i:s A', time());
    $successmsg = "";
    $errormsg = "";

    if (isset($_POST['submit'])) {
        $id = $_POST['nid'];
        $title = $_POST['title']; 
        $info = $_POST['info']; 
            $query = mysqli_query($con, "UPDATE tblnotice SET `id`='$id', noticeTitle='$title', noticeDetails='$info', updationDate=NOW() WHERE id='" . $_GET['id'] . "'");
            if ($query) {
                $successmsg = "Details successfully updated !!";
            } else {
                $errormsg = "Details not updated !!";
            }
        
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Class</title>
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
            <h3> Edit Notes</h3>
            <!-- BASIC FORM ELEMENTS -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <?php if ($successmsg) { ?>
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <b>Well done!</b>
                                <?php echo htmlentities($successmsg); ?>
                            </div>
                        <?php } ?>

                        <?php if ($errormsg) { ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <b>Oh snap!</b> </b>
                                <?php echo htmlentities($errormsg); ?>
                            </div>
                        <?php } ?>

                        <?php
                        $query = mysqli_query($con, "SELECT * FROM tblnotice WHERE id='" . $_GET['id'] . "'");
                        while ($row = mysqli_fetch_array($query)) { ?>

                            <h5><b>Last Updated at :</b>&nbsp;&nbsp;
                                <?php echo htmlentities($row['updationDate']); ?>
                            </h5>
                            <form class="form-horizontal style-form" method="post" name="profile" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Id</label>
                                    <div class="col-sm-4">
                                    <input type="number" min="1" name="nid" required="required" value="<?php echo htmlentities($row['id']); ?>" class="form-control">
                                    </div>
                                    <label class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="title" required="required" value="<?php echo htmlentities($row['noticeTitle']); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Details</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="info" required="required" value="<?php echo htmlentities($row['noticeDetails']); ?>" class="form-control">
                                    </div>
                                    </div>
                            <?php } ?>
                            <div class="form-group">
                                <div class="col-sm-10" style="padding-left:25% ">
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- jQuery -->
        <script src="assets/js/jquery.js"></script>
        <script src="assets\js\bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
        <!--common script for all pages-->
        <script src="assets/js/common-scripts.js"></script>
        <!--script for this page-->
        <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript">
            $(function () {
                $("#dob").datepicker();
            });
        </script>

    </body>

    </html>
<?php } ?>