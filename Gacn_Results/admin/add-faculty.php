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
        $name = $_POST['name'];
        $userid = $_POST['userid'];
        $password=$_POST['password'];
        $dept = $_POST['depts'];
        $utype = $_POST['profession'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $sid = $_POST['sid'];
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $imgfile = $_FILES["image"]["name"];

            // get the image extension
            $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
            // allowed extensions
            $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

            // Validation for allowed extensions .in_array() function searches an array for a specific value.
            if (!in_array($extension, $allowed_extensions)) {
                echo '<script>alert("Invalid format (Student Photo). Only jpg / jpeg/ png /gif format allowed");</script>';
            } else {
                //rename the image file
                $imgnewfile = md5($imgfile) . $extension;
                $destinationFilePath = "C:/xampp/htdocs/Gacn_Results/users/userimages/" . $imgnewfile;
                
                move_uploaded_file($_FILES["image"]["tmp_name"], $destinationFilePath);
                

                $query = mysqli_query($con, "INSERT INTO tblstaffs (`staffName`, StaffUserid,  `Password`, Department, Usertype, StaffId,  mobile, staffImage, emailId, updationDate) 
                VALUES ('$name', '$userid', '$password', '$dept', '$utype', '$sid',  '$mobile', '$imgnewfile', '$email', NOW())");
  
                if ($query) {
                    $successmsg = "Added new member successfully !!";
                } else {
                    $errormsg = "member not added !!";
                }
            }
        } else {
            $query = mysqli_query($con, "INSERT INTO tblstaffs (`staffName`, StaffUserid,  `Password`, Department, Usertype, StaffId,  mobile, emailId, updationDate) 
                VALUES ('$name', '$userid', '$password', '$dept', '$utype', '$sid',  '$mobile',  '$email', NOW())");

           if ($query) {
            $successmsg = "Added new member successfully !!";
        } else {
            $errormsg = "member not added !!";
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
        <title>Add Student</title>
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
                    <h3><i class="fa fa-angle-right"></i> Add Faculty Member</h3>
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
                                <form class="form-horizontal style-form" method="post" name="profile"
                                    enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">User id</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="userid" placeholder="Enter a user id"required="required" class="form-control">
                                        </div>
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="password" placeholder="Enter a password"required="required" class="form-control">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="name" placeholder="Enter a name" required="required" class="form-control">
                                        </div>
                                        <label class="col-sm-2 control-label">Department</label>
                                        <div class="col-sm-4">
                                            <select name="depts" id="depts" required="required" class="form-control">
                                                <option value="">--Select Department--</option>
                                                <option value="Tamil">Tamil</option>
                                                <option value="English">English</option>
                                                <option value="Computer Science">Computer Science</option>
                                                <option value="Commerce">Commerce</option>
                                                <option value="Zoology">Zoology</option>
                                                <option value="Botony">Botony</option>
                                                <option value="Physics">Physics</option>
                                                <option value="Chemistry">Chemistry</option>
                                                <option value="Mathematics">Mathematics</option>
                                                <option value="Statistics">Statistics</option>
                                                <option value="Historical Studies">Historical Studies</option>
                                                <option value="Commerce (Corporate Secretaryship)">Corporate Secretaryship
                                                </option>
                                                <option value="Economics">Economics</option>
                                                <option value="B.B.A. Business Administration">B.B.A</option>
                                                <option value="Public Administration">Public Administration</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Profession</label>
                                        <div class="col-sm-4">
                                            <select name="profession" id="profession" required="required" class="form-control">
                                                <option value="">--Select Profession--</option>
                                                <option value="hod">hod</option>
                                                <option value="staff">staff</option>                                                
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-4">
                                            <select name="gender" required="required" class="form-control">
                                                <option value="">--Select Gender--</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>

                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Mail Id</label>
                                        <div class="col-sm-4">
                                            <input type="email" name="email"  placeholder="Enter the email id" class="form-control">
                                        </div>
                                        <label class="col-sm-2 control-label">Mobile</label>
                                        <div class="col-sm-4">
                                        <input type="tel" placeholder="Enter a 10-digit mobile number" pattern="[0-9]{10}" name="mobile" class="form-control" required>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Member Id</label>
                                        <div class="col-sm-4">
                                            <input type="number" min="1"  placeholder="Enter the staff id"name="sid" class="form-control">
                                        </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Photo</label>
                                        <div class="col-sm-4">
                                            <input type="file" name="image" />
                                        </div>

                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group text-center">
                                        <button type="submit" name="submit" class="btn btn-success">Add Faculty Member</button>
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
        <script>
            // Set the default value to the current date in the "yyyy-mm-dd" format
            const today = new Date();
            const year = today.getFullYear();
            let month = today.getMonth() + 1;
            let day = today.getDate();

            // Pad month and day with leading zeros if necessary
            if (month < 10) {
                month = '0' + month;
            }
            if (day < 10) {
                day = '0' + day;
            }

            // Format the date as "yyyy-mm-dd"
            const formattedDate = `${year}-${month}-${day}`;

            // Set the value of the input field
            document.getElementById('dobInput').value = formattedDate;
        </script>

    </body>
<?php } ?>

</html>