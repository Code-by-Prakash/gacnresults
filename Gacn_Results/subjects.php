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
        $sname = $_POST['sname'];
        $sem = $_POST['sem'];
        $year = $_POST['year'];
        $part = $_POST['part'];
        $cia = $_POST['cia'];
        $ese = $_POST['ese'];
        $total = $_POST['total'];
        $tpass = $_POST['tpass'];
        $epass = $_POST['epass'];
        $batchs = $_POST['batchs'];
        $batche = $_POST['batche'];
        $query = mysqli_query($con, "UPDATE tblsubjects SET `Subjectid`='$subid', SubjectName='$sname', Semester='$sem',  `Year`='$year',
            Part='$part', cia='$cia', ese='$ese', total='$total',totalPass='$tpass',esePass='$epass', BatchStart='$batchs',BatchEnd='$batche', updationDate=NOW() WHERE SubjectId='" . $_GET['sid'] . "'");
        if ($query) {
            $successmsg = "Subject successfully updated !!";
        } else {
            $errormsg = "Subject not updated !!";
        }

    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Subject</title>
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
            <h3> Edit Subject</h3>
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
                        $query = mysqli_query($con, "SELECT * FROM tblsubjects WHERE SubjectId='" . $_GET['sid'] . "'");
                        while ($row = mysqli_fetch_array($query)) { ?>

                            <h5><b>Last Updated at :</b>&nbsp;&nbsp;
                                <?php echo htmlentities($row['updationDate']); ?>
                            </h5>
                            <form class="form-horizontal style-form" method="post" name="subjects"
                                enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Subject Code</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="subid" min="1" placeholder="Enter the subject code"
                                            required="required" value="<?php echo htmlentities($row['SubjectId']); ?>"
                                            class="form-control">
                                    </div>
                                    <label class="col-sm-2 control-label">Subject Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="sname" placeholder="Enter the subject name" required="required"
                                            value="<?php echo htmlentities($row['SubjectName']); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Semester</label>
                                    <div class="col-sm-4">
                                        <select name="sem" class="form-control">
                                            <option value="<?php echo htmlentities($row['Semester']); ?>" selected><?php echo htmlentities($row['Semester']); ?></option>
                                            <?php if ($row['Semester'] === 'I'): ?>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                            <?php elseif ($row['Semester'] === 'II'): ?>
                                                <option value="I">I</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                            <?php elseif ($row['Semester'] === 'III'): ?>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                            <?php elseif ($row['Semester'] === 'IV'): ?>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                            <?php elseif ($row['Semester'] === 'V'): ?>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>

                                                <option value="VI">VI</option>

                                            <?php else: ?>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Year</label>
                                    <div class="col-sm-4">
                                        <select name="year" class="form-control">
                                            <option value="<?php echo htmlentities($row['Year']); ?>" selected><?php echo htmlentities($row['Year']); ?></option>
                                            <?php if ($row['Year'] === 'I'): ?>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                            <?php elseif ($row['Year'] === 'II'): ?>
                                                <option value="I">I</option>
                                                <option value="III">III</option>
                                            <?php else: ?>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Part</label>
                                    <div class="col-sm-4">
                                    <select name="part" class="form-control">
                                                <option value="<?php echo htmlentities($row['Part']); ?>" selected><?php echo htmlentities($row['Part']); ?></option>
                                                <?php if ($row['Part'] === 'I'): ?>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                               
                                            <?php elseif ($row['Part'] === 'II'): ?>
                                                <option value="I">I</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                               
                                            <?php elseif ($row['Part'] === 'III'): ?>
                                                <option value="I">I</option>
                                                <option value="II">II</option>                                            
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                                
                                            <?php elseif ($row['Part'] === 'IV'): ?>
                                                <option value="I">I</option>
                                                <option value="II">II</option>                                            
                                                <option value="III">III</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                               
                                            <?php elseif ($row['Part'] === 'V'): ?>
                                                <option value="I">I</option>
                                                <option value="II">II</option>   
                                                <option value="III">III</option>                                         
                                                <option value="IV">IV</option>                                                
                                                <option value="VI">VI</option>
                                                
                                                <?php elseif ($row['Part'] === 'VI'): ?>
                                                <option value="I">I</option>
                                                <option value="II">II</option>   
                                                <option value="III">III</option>                                         
                                                <option value="IV">IV</option>                                                
                                                <option value="V">V</option>
                                                
                                                <?php elseif ($row['Part'] === 'A'): ?>                                              
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <?php elseif ($row['Part'] === 'B'): ?>                                              
                                              <option value="A">A</option>
                                              <option value="C">C</option>
                                              <?php elseif ($row['Part'] === 'C'): ?>                                              
                                              <option value="A">A</option>
                                              <option value="B">B</option>
                                            <?php else: ?>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="V">V</option>
                                                <option value="A">A</option>
                                              <option value="B">B</option>
                                              <option value="C">C</option>
                                            <?php endif; ?>
                                            </select>
                                    </div>
                                    <label class="col-sm-2 control-label">CIA Mark</label>
                                    <div class="col-sm-4">
                                        <input type="number" min="0" max="40" placeholder="Enter the CIA mark (e.g.25)" name="cia" required="required"
                                            value="<?php echo htmlentities($row['cia']); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ESE Mark</label>
                                    <div class="col-sm-4">
                                        <input type="number "min="0" max="75" placeholder="Enter the ESE mark (e.g.75)" name="ese" required="required"
                                            value="<?php echo htmlentities($row['ese']); ?>" class="form-control">
                                    </div>
                                    <label class="col-sm-2 control-label">Total Mark</label>
                                    <div class="col-sm-4">
                                        <input type="number"  placeholder="Enter the total mark (e.g.100)" min="0" max="100" name="total" required="required"
                                            value="<?php echo htmlentities($row['total']); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Pass (Total)</label>
                                    <div class="col-sm-4">
                                        <input type="number" min="0" max="48" name="tpass"placeholder="Enter the pass mark out of total (e.g.48)" required="required"
                                            value="<?php echo htmlentities($row['totalPass']); ?>" class="form-control">
                                    </div>
                                    <label class="col-sm-2 control-label">Pass (ESE)</label>
                                    <div class="col-sm-4">
                                        <input type="number" min="0" max="38" name="epass" required="required" placeholder="Enter the pass mark out of ESE (e.g.38)"
                                            value="<?php echo htmlentities($row['esePass']); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Batch Start Year</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="batchs" placeholder="Enter the year" min="1900" max="2099"
                                            required="required" value="<?php echo htmlentities($row['BatchStart']); ?>"
                                            class="form-control">
                                    </div>
                                    <label class="col-sm-2 control-label">Batch End Year</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="batche" placeholder="Enter the year" min="1900" max="2099"
                                            required="required" value="<?php echo htmlentities($row['BatchEnd']); ?>"
                                            class="form-control">
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <div class="col-sm-10" style="padding-left:25% ">
                                    <button type="submit" name="submit" class="btn btn-primary">Update Subject</button>
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