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
        $query = mysqli_query($con, "INSERT INTO tblsubjects (`SubjectId`, SubjectName, Semester,  `Year`, Part, cia, ese, total, totalPass, esePass, BatchStart, BatchEnd, updationDate) 
        VALUES ('$subid', '$sname',  '$sem', '$year', '$part', '$cia', '$ese', '$total', '$tpass', '$epass', '$batchs', '$batche', NOW())");
          
          for ($i = 1; $i <= 50; $i++) {
            if (isset($_POST['c' . $i])) {
                $class = $_POST['c' . $i];
                
                // Insert the subject and class into the database
                $query = mysqli_query($con, "INSERT INTO tblsubjectcombination (`ClassId`, `SubjectId`, `updationDate`) 
                VALUES ('$class', '$subid', NOW())");}}
        if ($query) {
            $successmsg = "Added new subject successfully !!";
        } else {
            $errormsg = "subject not added !!";
        }
    }
          
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Subject</title>
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
                    <h3><i class="fa fa-angle-right"></i> Add Subject</h3>
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
                                <form class="form-horizontal style-form" method="post" name="subjects"
                                    enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Subject Id</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="subid" placeholder="Enter the subject id (e.g.195501)"required="required" class="form-control">
                                        </div>
                                        <label class="col-sm-2 control-label">Subject Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="sname" placeholder="Enter the subject name (e.g.Machine Learning)"required="required" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Semester</label>
                                        <div class="col-sm-4">
                                            <select name="sem" required="required" class="form-control">
                                                <option value="">--Select Semester--</option>

                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">Year</label>
                                        <div class="col-sm-4">
                                            <select name="year" required="required" class="form-control">
                                                <option value="">--Select Year--</option>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Part</label>
                                        <div class="col-sm-4">
                                            <select name="part" required="required" class="form-control">
                                                <option value="">--Select Part--</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">CIA Mark</label>
                                        <div class="col-sm-4">
                                            <input type="number" name="cia" placeholder="Enter the cia mark (e.g.25)" min="0" max="40"required="required" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">ESE Mark</label>
                                        <div class="col-sm-4">
                                            <input type="number" min="0" max="75" name="ese"  placeholder="Enter the ESE mark (e.g.75)"required="required" class="form-control">
                                        </div>
                                        <label class="col-sm-2 control-label">Total Mark</label>
                                        <div class="col-sm-4">
                                            <input type="number" name="total" min="0" max="100" placeholder="Enter the total mark (e.g.100)" required="required" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Pass (Total)</label>
                                        <div class="col-sm-4">
                                            <input type="number" min="0" max="48" name="tpass"  placeholder="Enter the pass mark out of total (e.g.48)" required="required" class="form-control">
                                        </div>
                                        <label class="col-sm-2 control-label">Pass (ESE)</label>
                                        <div class="col-sm-4">
                                            <input type="number" name="epass" min="0" max="38" placeholder="Enter the pass mark out of ESE (e.g.38)" required="required" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Batch Start Year</label>
                                        <div class="col-sm-4">
                                            <input type="number" name="batchs" required="required" class="form-control"
                                                placeholder="Enter Year" min="1900" max="2099" onkeydown="return false;">
                                        </div>
                                        <label class="col-sm-2 control-label">Batch End Year</label>
                                        <div class="col-sm-4">
                                            <input type="number" name="batche" required="required" class="form-control"
                                                placeholder="Enter Year" min="1900" max="2099" onkeydown="return false;">
                                        </div>
                                    </div>
                                    <div id="classContainer">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Class 1</label>
                                            <div class="col-sm-4">
                                                <input type="number" name="c1" required="required" min="1"
                                                    placeholder="Enter the class id (e.g.1)" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="addClass()">+ Class</button>
                                <?php } ?>
                                <div class="form-group">
                                    <div class="col-sm-10" style="padding-left:40% ">
                                        <button type="submit" name="submit" class="btn btn-primary">Add Subject</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
    <script>

        let classCount = 1;  // Track the number of classes

        function addClass() {
            classCount++;  // Increment the class count

            const container = document.getElementById("classContainer");

            // Create a new div element with the "form-group" class
            const newFormGroup = document.createElement("div");
            newFormGroup.setAttribute("class", "form-group");

            // Create the label element
            const label = document.createElement("label");
            label.setAttribute("class", "col-sm-2 control-label");
            label.textContent = "Class " + classCount;

            // Create the div and input elements
            const div = document.createElement("div");
            div.setAttribute("class", "col-sm-4");

            const input = document.createElement("input");
            input.setAttribute("type", "number");
            input.setAttribute("min", "1");
            input.setAttribute("name", "c" + classCount);
            input.setAttribute("class", "form-control");
            input.setAttribute("placeholder", "Enter the additional class id");

            // Append the elements to the new form group
            div.appendChild(input);
            newFormGroup.appendChild(label);
            newFormGroup.appendChild(div);

            // Append the new form group to the container
            container.appendChild(newFormGroup);
        }




    </script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script>
        // Disable scrolling and manual input for the first year field
        document.querySelector('input[name="batchs"]').addEventListener('wheel', function (e) {
            e.preventDefault();
        });

        // Set the default value to the current year
        const currentYear = new Date().getFullYear();
        document.querySelector('input[name="batchs"]').value = currentYear;


        // Disable scrolling and manual input for the second year field
        document.querySelector('input[name="batche"]').addEventListener('wheel', function (e) {
            e.preventDefault();
        });

        // Set the default value to the current year plus three years
        const defaultYear = currentYear + 3;
        document.querySelector('input[name="batche"]').value = defaultYear;
    </script>
</body>

</html>