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
        $subid = $_POST['subid'];
        $cia = $_POST['cia'];
        $ese = $_POST['ese'];
        $staffid = $_POST['stid'];
        $reg = $_GET['uid'];
        $exa = $_GET['exam'];

        // Check if the subject code exists in the database
        $checkQuery = "SELECT SubjectId FROM tblsubjects WHERE SubjectId = '$subid'";
        $checkResult = mysqli_query($con, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {

            $checkQuery2 = "SELECT StaffId FROM tblstaffs WHERE StaffId = '$staffid'";
            $checkResult2 = mysqli_query($con, $checkQuery2);

            if (mysqli_num_rows($checkResult2) > 0) {
                $checkQuery3 = "SELECT SubjectId FROM tblresults WHERE SubjectId = '$subid' and StudentId='$reg' and MonthYear='$exa'";
                $checkResult3 = mysqli_query($con, $checkQuery3);

                if (mysqli_num_rows($checkResult3) > 0) {
                    $errormsg = "Results already stored for this subject!";
                } else {
                    $query = "INSERT INTO tblresults(StudentId, SubjectId, CIA, ESE, MonthYear, StaffId, updationDate)
                    VALUES ('$reg', '$subid', '$cia', '$ese', '$exa', '$staffid', NOW())";

                    $result = mysqli_query($con, $query);

                    if ($result) {
                        $successmsg = "Result successfully updated!";
                        
                    } else {
                        $errormsg = "Failed to update result!";
                    }
                }
            } else {
                $errormsg = "Invalid staff id!";
            }
        } else {
            $errormsg = "Invalid subject code!";
        }
    }

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Results</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <!--external css-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">
    </head>

    <body>
        <section id="container">
            <h3>Add Results</h3>
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
                                <b>Oh snap!</b>
                                <?php echo htmlentities($errormsg); ?>
                            </div>
                        <?php } ?>


                        <form class="form-horizontal style-form" method="post" name="result" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">Subject Code:</label>
                                <div class="col-sm-2">
                                    <input type="number" name="subid" required="required" min="1"
                                        placeholder="Example: 195001" class="form-control">
                                </div>
                                <label class="col-sm-1 control-label">CIA Mark:</label>
                                <div class="col-sm-1">
                                    <input type="number" name="cia" required="required" placeholder="e.g.25"
                                        class="form-control" min="0" max="40">
                                </div>
                                <label class="col-sm-1 control-label">ESE Mark:</label>
                                <div class="col-sm-1">
                                    <input type="number" name="ese" required="required" min="0" max="75"
                                        placeholder="e.g.75" class="form-control">
                                </div>
                                <label class="col-sm-1 control-label">Staff Id:</label>
                                <div class="col-sm-1">
                                    <input type="number" name="stid" required="required" min="1" placeholder="e.g.10"
                                        class="form-control">
                                </div>

                                <div class="col-sm-3 text-center">
                                    <button type="submit" name="submit" class="btn btn-success"><i
                                            class="far fa-check-circle"></i> Update</button>
                                    <button type="button" name="clear" class="btn btn-danger" onclick="clearFormFields()"><i
                                            class="fas fa-eraser"></i> Clear</button>
                                </div>
                            </div>
                        </form>

                        <br>

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
        <script>
            function clearFormFields() {
                document.result.reset(); // Reset the form fields
            }
        </script>
    </body>

    </html>
<?php } ?>