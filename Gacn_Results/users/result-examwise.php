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
    <title>result-examwise</title>
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
                <h3><i class="fa fa-angle-right"></i> Result (Exam-wise)</h3>
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Semester Exam Results</h4>
                            <form class="form-horizontal style-form" method="post" name="result"
                                enctype="multipart/form-data" action="result-examwise.php">
                                <div class="dropdown">
                                    <select class="form-control" name="semester" id="semester" required="required">
                                        <option value="">-- Select the exam month and year --</option>
                                        <?php
                                        // select data from database
                                        $query = "SELECT DISTINCT DATE_FORMAT(MonthYear, '%b %Y') AS MonthYear FROM tblresults WHERE `tblresults`.`StudentId` = '" . $_SESSION['SUser'] . "'
 ";

                                        $result = mysqli_query($con, $query);

                                        // loop through results and create options
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $row['MonthYear'] . "'>" . $row['MonthYear'] . "</option>";
                                        }


                                        ?>
                                    </select>
                                    <br> <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                </div>

                            </form>

                            <?php
                            if (isset($_POST['submit'])) {
                                // Prepare and execute SQL query
                                $sql = "SELECT * FROM tblstudents 
        JOIN tblresults ON tblresults.StudentId = tblstudents.Userid 
        JOIN tblsubjects ON tblresults.SubjectId=tblsubjects.SubjectId 
        JOIN tblsubjectcombination on tblsubjects.SubjectId=tblsubjectcombination.SubjectId
        JOIN tblclasses on tblsubjectcombination.ClassId=tblclasses.ClassId AND tblstudents.ClassId=tblclasses.ClassId
        WHERE DATE_FORMAT(tblresults.MonthYear, '%b %Y')='" . $_POST['semester'] . "' and tblstudents.Userid='" . $_SESSION['SUser'] . "'ORDER BY tblsubjects.Semester ASC, tblsubjects.Part ASC,tblsubjects.SubjectId ASC";
                                $result = $con->query($sql);
                                // Check if any results were returned
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $student_name = $row['Name'];
                                    $exam = date("M Y", strtotime($row["MonthYear"]));

                                    $regno = $row["Userid"];
                                    $department = $row["Department"];
                                    echo "<h3>EXAM: $exam</h3>";


                                    mysqli_data_seek($result, 0);

                                    // Loop through results and output data
                                    ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Semester</th>
                                                <th>Subject Code</th>
                                                <th>Part</th>
                                                <th>Subject Name</th>
                                                <th>CIA</th>
                                                <th>ESE</th>
                                                <th>Total</th>
                                                <th>Result</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $part_count = array();
                                            $part_total_marks = array();
                                            $part_passed_count = array();
                                            $part_failed_count = array();
                                            $pass_count = 0;
                                            $ra_count = 0;
                                            $total_marks = 0;
                                            $total_max_marks = 0;
                                            $has_ra = 0;
                                            $has_pass = 0;
                                            while ($row = $result->fetch_assoc()) {
                                                $row_count = $result->num_rows;
                                                $student_name = $row["Name"];
                                                $monthyear = $row["MonthYear"];
                                                $subject_name = $row["SubjectName"];
                                                $subject_code = $row["SubjectId"];
                                                $class_name = $row["ClassName"];
                                                $semester = $row["Semester"];
                                                $max_cia = $row["cia"];
                                                $max_ese = $row["ese"];
                                                $pass_ese = $row["esePass"];
                                                $max_marks = $row["total"];
                                                $max_pass = $row["totalPass"];
                                                $part = $row["Part"];
                                                $cia = $row["CIA"];
                                                $ese = $row["ESE"];

                                                // Increment the count of the current part in the $part_count array
                                                if (!isset($part_count[$part])) {
                                                    $part_count[$part] = 0;
                                                }
                                                $part_count[$part]++;

                                                // Add the marks for the current row to the total marks for the current part in the $part_total_marks array
                                                if (!isset($part_total_marks[$part])) {
                                                    $part_total_marks[$part] = 0;
                                                }
                                                $part_total_marks[$part] += ($row['CIA'] + $row['ESE']);
                                                $total_marks += ($cia + $ese);
                                                $total_max_marks += $max_marks;

                                                $total = $cia + $ese;
                                                if ($total >= $max_pass && $ese >= $pass_ese) {
                                                    $sresult = "Pass";
                                                    $pass_count++;
                                                    $has_pass = true;
                                                    if (!isset($part_passed_count[$part])) {
                                                        $part_passed_count[$part] = 0;
                                                    }
                                                    $part_passed_count[$part]++;
                                                } else {
                                                    if (!isset($part_failed_count[$part])) {
                                                        $part_failed_count[$part] = 0;
                                                    }
                                                    $part_failed_count[$part]++;
                                                    $sresult = "RA";
                                                    $ra_count++;
                                                    $has_ra = true;
                                                }

                                                echo "<tr>";
                                                echo "<td>" . $semester . "</td>";
                                                echo "<td>" . $subject_code . "</td>";
                                                echo "<td>" . $part . "</td>";
                                                echo "<td>" . $subject_name . "</td>";
                                                echo "<td>" . $cia . "</td>";
                                                echo "<td>" . $ese . "</td>";
                                                echo "<td>" . $total . "</td>";
                                                echo "<td>" . $sresult . "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Part</th>
                                                <th>Total Subjects</th>
                                                <th>Passed</th>
                                                <th>Failed</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($part_count as $part => $count) { ?>
                                                <tr>
                                                    <td>Part
                                                        <?php echo $part; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $count; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($part_passed_count[$part] ?? 0) ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($part_failed_count[$part] ?? 0) ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="2"><strong>Total</strong></td>
                                                <td>
                                                    <?php echo ($pass_count ?? 0) ?>
                                                </td>
                                                <td>
                                                    <?php echo ($ra_count ?? 0) ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <?php
                                } else {
                                    echo "No results found.";
                                }
                                // Close database connection
                                $con->close();
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