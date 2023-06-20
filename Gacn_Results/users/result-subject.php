<?php
session_start();
require_once('includes/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result - semesterwise</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <style>
        img {
            display: block;
            margin: 0 auto;
            max-width: 90%;
            padding: 0;
        }


        .branding {
            font-weight: bold;
            line-height: 25px;
            letter-spacing: 1px;
            color: white;
            margin-top: 0;
            max-width: 30%;
            margin-left: auto;
            margin-right: auto;
            background-color: #04AA6D;
            text-align: center;
            font-size: 12px;
            border-bottom-right-radius: 4% 100%;
            border-bottom-left-radius: 4% 100%;
        }

        @media (min-width: 768px) {
            .branding {
                line-height: 25px;
                letter-spacing: 1px;
                max-width: 50%;
                font-size: 12px;
            }
        }

        @media (min-width: 992px) {
            .branding {
                line-height: 25px;
                letter-spacing: 1px;
                max-width: 38%;
                font-size: 12px;
            }
        }

        @media (max-width: 768px) {
            .branding {
                line-height: 15px;
                letter-spacing: 1px;
                max-width: 60%;
                font-size: 8px;
            }
        }

        @media (max-width: 420px) {
            .branding {
                line-height: 10px;
                letter-spacing: 1px;
                max-width: 60%;
                font-size: 6px;
            }
        }

        @media (max-width: 336px) {
            .branding {
                line-height: 8px;
                letter-spacing: 1px;
                max-width: 50%;
                font-size: 4px;
            }
        }

        /* Table border */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td,
        thead {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }


        /* Table row background colors */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Table header background color */
        th {
            background-color: #ccc;
        }

        /* Total row background color */
        .total-row {
            background-color: #333;
            color: #fff;
        }

        /* Total row font style */
        .total-row strong {
            font-weight: bold;
        }
    </style>

</head>

<body>
    <section id="container">
        <?php include("includes/header.php"); ?>
        <?php include("includes/sidebar.php"); ?>
        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i> Result (Subject-wise)</h3>
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Semester Exam Results</h4>
                            <form class="form-horizontal style-form" method="post" name="result"
                                enctype="multipart/form-data" action="result-subject.php">
                                <div class="dropdown">
                                    <select class="form-control" name="subject" id="subject" required="required">
                                        <option value="">-- Select the subject --</option>
                                        <?php

                                        // select data from database
                                        $query = "SELECT DISTINCT SubjectName from tblsubjects JOIN tblresults ON tblresults.SubjectId=tblsubjects.SubjectId WHERE `tblresults`.`StudentId` = '" . $_SESSION['SUser'] . "'";
                                        $result = mysqli_query($con, $query);

                                        // loop through results and create options
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $row['SubjectName'] . "'>" . $row['SubjectName'] . "</option>";
                                        }
                                        ?>
                                    </select>

                                </div>
                                <br> <button type="submit" name="submit" class="btn btn-success">Submit</button> <br>
                            </form>

                            <?php
                            if (isset($_POST['submit'])) {
                                // Prepare and execute SQL query
                                $sql = "SELECT * FROM tblstudents 
        JOIN tblresults ON tblresults.StudentId = tblstudents.Userid 
        JOIN tblsubjects ON tblresults.SubjectId=tblsubjects.SubjectId 
        JOIN tblsubjectcombination on tblsubjects.SubjectId=tblsubjectcombination.SubjectId
        JOIN tblclasses on tblsubjectcombination.ClassId=tblclasses.ClassId AND tblstudents.ClassId=tblclasses.ClassId
        WHERE tblsubjects.SubjectName='" . $_POST['subject'] . "' and tblstudents.Userid='" . $_SESSION['SUser'] . "'ORDER BY STR_TO_DATE(CONCAT('01 ', MonthYear), '%d %b %Y') ASC";
                                $result = $con->query($sql);

                                // Check if any results were returned
                                if ($result->num_rows > 0) {
                                    $rows = array(); // Array to store the result rows
                            
                                    // Fetch all rows and store them in the array
                                    while ($row = $result->fetch_assoc()) {
                                        $rows[] = $row;
                                    }

                                    $row_count = count($rows);

                                    $student_name = $rows[0]['Name'];
                                    $subject_name = $rows[0]["SubjectName"];
                                    $subject_code = $rows[0]["SubjectId"];
                                    $regno = $rows[0]["Userid"];
                                    $department = $rows[0]["Department"];
                                    echo "<h3>Subject:". $subject_name. "(CODE:". $subject_code.")</h3>";
                                    ?>

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Semester</th>
                                                <th>Exam</th>
                                                <th>Part</th>
                                                <th>CIA</th>
                                                <th>ESE</th>
                                                <th>Total</th>
                                                <th>Result</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Loop through rows array to populate the table
                                            $total_marks = 0;
                                            $total_max_marks = 0;
                                            $has_ra = 0;
                                            $has_pass = 0;

                                            foreach ($rows as $row) {
                                                $monthyear = $row["MonthYear"];
                                                $subject_name = $row["SubjectName"];
                                                $subject_code = $row["SubjectId"];
                                                $exam = date("M Y", strtotime($row["MonthYear"]));
                                                $semester = $row["Semester"];
                                                $max_cia = $row["cia"];
                                                $max_ese = $row["ese"];
                                                $max_marks = $row["total"];
                                                $pass_ese = $row["esePass"];
                                                $max_pass = $row["totalPass"];
                                                $part = $row["Part"];
                                                $cia = $row["CIA"];
                                                $ese = $row["ESE"];

                                                $total_marks += ($cia + $ese);
                                                $total_max_marks += $max_marks;

                                                $total = $cia + $ese;

                                                if ($total >= $max_pass and $ese >= $pass_ese) {
                                                    $sresult = "Pass";
                                                    $has_pass = true;
                                                } else {
                                                    $sresult = "RA";
                                                    $has_ra = true;
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row["Semester"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo date("M Y", strtotime($row["MonthYear"])); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["Part"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["CIA"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["ESE"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($row["CIA"] + $row["ESE"]); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($row["CIA"] + $row["ESE"]) >= $row["totalPass"] && $row["ESE"] >= $row["esePass"] ? "Pass" : "RA"; ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <h3>
                                        <?php if ($has_pass) {
                                            echo "Congratulations! You passed in this subject.";
                                        } else {
                                            echo "Sorry, you did not pass in this subject.";
                                        } ?>
                                    </h3>

                                    <?php
                                }
                            }
                            ?>


                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>

    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>


    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
</body>

</html>