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
        $name = $_POST['name'];
        $userid = $_POST['userid'];
        $dept = $_POST['dept'];
        $sid=$_POST['sid'];
        $gender = $_POST['gender'];
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
                $destinationFilePath = "C:/xampp/htdocs/Gacn_Results/users/userimages/" . $imgnewfile;

                move_uploaded_file($_FILES["image"]["tmp_name"], $destinationFilePath);


                $query = mysqli_query($con, "UPDATE tblstaffs SET `staffName`='$name', StaffId='$sid', StaffUserid='$userid', Department='$dept', `gender`='$gender',
              mobile='$mobile', staffImage='$imgnewfile', emailId='$email', updationDate=NOW() WHERE staffUserid='" . $_GET['uid'] . "'");

                if ($query) {
                    $successmsg = "Profile successfully updated !!";
                } else {
                    $errormsg = "Profile not updated !!";
                }
            }
        } else {
            $query = mysqli_query($con, "UPDATE tblstaffs SET `staffName`='$name',  StaffId='$sid',  StaffUserid='$userid', Department='$dept', `gender`='$gender',
            mobile='$mobile', emailId='$email', updationDate=NOW() WHERE staffUserid='" . $_GET['uid'] . "'");
            if ($query) {
                $successmsg = "Profile successfully updated !!";
            } else {
                $errormsg = "Profile not updated !!";
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
        <title>editFacultyProfile</title>
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
            <h3> Edit Details</h3>
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
                        $query = mysqli_query($con, "SELECT * FROM tblstaffs WHERE StaffUserid='" . $_GET['uid'] . "'");
                        while ($row = mysqli_fetch_array($query)) { ?>
                            <h4 class="mb"><i class="fa fa-user"></i>&nbsp;&nbsp;
                                <?php echo htmlentities($row['staffName']); ?>'s Profile
                            </h4>
                            <h5><b>Last Updated at :</b>&nbsp;&nbsp;
                                <?php echo htmlentities($row['updationDate']); ?>
                            </h5>
                            <form class="form-horizontal style-form" method="post" name="profile" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="name" placeholder="Enter a name"required="required"
                                            value="<?php echo htmlentities($row['staffName']); ?>" class="form-control">
                                    </div>
                                    <label class="col-sm-2 control-label">Userid</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="userid" placeholder="Enter a userid" required="required"
                                            value="<?php echo htmlentities($row['StaffUserid']); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Department </label>
                                    <div class="col-sm-4">
                                      <select name="dept" id="dept" required="required" class="form-control">
                                <option value="<?php echo htmlentities($row['Department']); ?>" selected><?php echo htmlentities($row['Department']); ?></option>                                     
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
                                    
                                    
                                        <label class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-4">
                                            <select name="gender" class="form-control">
                                                <option value="<?php echo htmlentities($row['gender']); ?>" selected><?php echo htmlentities($row['gender']); ?></option>
                                                <?php if ($row['gender'] === 'Male'): ?>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                <?php elseif ($row['gender'] === 'Female'): ?>
                                                    <option value="Male">Male</option>
                                                    <option value="Other">Other</option>
                                                <?php else: ?>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email Id</label>
                                        <div class="col-sm-4">
                                            <input type="email"  placeholder="Enter the email id" name="email"
                                                value="<?php echo htmlentities($row['emailId']); ?>" class="form-control">
                                        </div>
                                        <label class="col-sm-2 control-label">Mobile</label>
                                        <div class="col-sm-4">
                                        <input type="tel" placeholder="Enter a 10-digit mobile number" pattern="[0-9]{10}" name="mobile" value="<?php echo htmlentities($row['mobile']); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Profession</label>
                                        <div class="col-sm-4">
                                            <select name="profession" class="form-control">
                                                <option value="<?php echo htmlentities($row['Usertype']); ?>" selected><?php echo htmlentities($row['Usertype']); ?></option>
                                                <?php if ($row['Usertype'] === 'hod'): ?>
                                                    <option value="staff">staff</option>
                                                <?php else: ?>
                                                    <option value="hod">hod</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Member Id</label>
                                        <div class="col-sm-4">
                                            <input type="number" placeholder="Enter the staff id" name="sid" min="1" class="form-control"
                                            value="<?php echo htmlentities($row['StaffId']); ?>" class="form-control">
                                        </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Photo</label>
                                        <div class="col-sm-4">
                                            <?php
                                            $userphoto = $row['staffImage'];
                                            if ($userphoto == ""):
                                                ?>
                                                <img src="http://localhost/Gacn_Results/users/userimages/noimage.png" width="256"
                                                    height="256">
                                            <?php else: ?>
                                                <img src="http://localhost/Gacn_Results/users/userimages/<?php echo htmlentities($userphoto); ?>"
                                                    width="256" height="256">
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