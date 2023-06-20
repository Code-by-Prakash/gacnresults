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
    $sql = "SELECT * FROM tblresults WHERE Studentid='" . $_GET['uid'] . "' and MonthYear='" . $_GET['exam'] . "'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sub = $row['SubjectId'];
    }

    if (isset($_POST['submit'])) {

        $subid = $_POST['subid'];
        $cia = $_POST['cia'];
        $ese = $_POST['ese'];
        $staffid = $_POST['stid'];
        $reg = $_GET['uid'];
        $exa = $_GET['exam'];

        $query = "UPDATE tblresults SET CIA='$cia', ESE='$ese', SubjectId='$subid', StaffId='$staffid', MonthYear='$exa', updationDate=NOW()
         WHERE StudentId='$reg' and MonthYear='$exa' and SubjectId='$sub'";

        $result = mysqli_query($con, $query);

        if ($result) {
            $successmsg = "Result successfully updated!";
        } else {
            $errormsg = "Failed to update result!";
        }
        
    }

    if (isset($_POST['delete'])) {

        $subid = $_POST['subid'];
        $reg = $_GET['uid'];
        $exa = $_GET['exam'];

        $query = mysqli_query($con, "DELETE FROM tblresults WHERE StudentId='$reg' and MonthYear='$exa' and SubjectId='$subid'");

        if ($query) {
            $successmsg = "Result successfully deleted!";
        } else {
            $errormsg = "Failed to delete result!";
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Results</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <!--external css-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">
    </head>

    <body>
        <section id="container">
            <h3>Edit Results</h3>
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

                        <?php
                        $query = mysqli_query($con, "SELECT * FROM tblresults WHERE Studentid='" . $_GET['uid'] . "' and MonthYear='" . $_GET['exam'] . "'");
                        $row = mysqli_fetch_array($query);

                        if ($row) {
                            ?>
                            <h5><b>Last Updated at :</b>&nbsp;&nbsp;
                                <?php echo htmlentities($row['updationDate']); ?>
                            </h5>
                        <?php }

                        mysqli_data_seek($query, 0); // Reset the result pointer to the beginning
                        ?>

                        <?php while ($row = mysqli_fetch_array($query)) { ?>
                            <form class="form-horizontal style-form" method="post" name="result" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Subject Code:</label>
                                    <div class="col-sm-2">
                                        <input type="number"   placeholder="Example: 195001" min="0" name="subid" required="required"
                                            value="<?php echo htmlentities($row['SubjectId']); ?>" class="form-control">
                                    </div>
                                    <label class="col-sm-1 control-label">CIA Mark:</label>
                                    <div class="col-sm-1">
                                        <input type="number" name="cia"placeholder="e.g.25" required="required" min="0" max="40"
                                            value="<?php echo htmlentities($row['CIA']); ?>" class="form-control">
                                    </div>
                                    <label class="col-sm-1 control-label">ESE Mark:</label>
                                    <div class="col-sm-1">
                                        <input type="number" name="ese" placeholder="e.g.75" required="required" min="0" max="75"
                                            value="<?php echo htmlentities($row['ESE']); ?>" class="form-control">
                                    </div>
                                    <label class="col-sm-1 control-label">Staff Id:</label>
                                    <div class="col-sm-1">
                                        <input type="number"  name="stid" placeholder="e.g.10" required="required" min="1"
                                            value="<?php echo htmlentities($row['StaffId']); ?>" class="form-control">
                                    </div>

                                    <div class="col-sm-3 text-center">
                                        <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-edit"></i>
                                            Update</button>
                                        <button type="submit" name="delete" class="btn btn-danger"><i class="fas fa-trash"></i>
                                            Delete</button>
                                    </div>
                                </div>
                            </form>

                            <br>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- jQuery -->
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

    </html>
<?php } mysqli_close($con); // Closing the database connection?>