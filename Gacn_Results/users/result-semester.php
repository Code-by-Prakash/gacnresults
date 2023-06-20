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
                <h3><i class="fa fa-angle-right"></i> Result (Semester-wise)</h3>
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Semester Exam Results</h4>
                            <form class="form-horizontal style-form" method="post" name="result"
                                enctype="multipart/form-data" action="result-semester.php">
                                <div class="dropdown">
                                    <select class="form-control" name="semester" id="semester" required="required">
                                        <option value="">-- Select the semester --</option>
                                        <?php

                                        // select data from database
                                        $query = "SELECT DISTINCT Semester from tblsubjects JOIN tblresults ON tblresults.SubjectId=tblsubjects.SubjectId WHERE `tblresults`.`StudentId` = '" . $_SESSION['SUser'] . "'";
                                        $result = mysqli_query($con, $query);

                                        // loop through results and create options
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $row['Semester'] . "'>SEMESTER " . $row['Semester'] . "</option>";

                                        }
                                        ?>
                                    </select>
                                    <br> <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                </div>

                            </form>
                            <?php
                            if (isset($_POST['submit'])) {
                                // Prepare and execute SQL query
                                $sql = "SELECT s.*, r.*, sub.*, c.*
        FROM tblstudents s
        JOIN tblresults r ON r.StudentId = s.Userid 
        JOIN tblsubjects sub ON r.SubjectId = sub.SubjectId 
        JOIN tblsubjectcombination sc on sub.SubjectId=sc.SubjectId
        JOIN tblclasses c on sc.ClassId=c.ClassId AND s.ClassId=c.ClassId
        WHERE sub.Semester = '" . $_POST['semester'] . "' 
        AND s.Userid = '" . $_SESSION['SUser'] . "' 
        AND r.MonthYear = (
          SELECT MAX(MonthYear)
          FROM tblresults
          WHERE StudentId = s.Userid AND SubjectId = r.SubjectId
        )
        ORDER BY sub.Part ASC, sub.SubjectId ASC
        ";
                                $result = $con->query($sql);
                                // Check if any results were returned
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $student_name = $row['Name'];
                                    $exam = date("M Y", strtotime($row["MonthYear"]));
                                    $semester = $row["Semester"];
                                    $regno = $row["Userid"];
                                    $department = $row["Department"];
                                    echo "<h3>SEMESTER: $semester</h3>";

                                    while ($row = $result->fetch_assoc()) {
                                        $student_name = $row["Name"];
                                        $exam = $row["MonthYear"];
                                    }


                                    mysqli_data_seek($result, 0);

                                    // Loop through results and output data
                                    ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>

                                                <th>Subject Code</th>
                                                <th>Part</th>
                                                <th>Subject Name</th>
                                                <th>CIA</th>
                                                <th>ESE</th>
                                                <th>Total</th>
                                                <th>Result</th>
                                                <th>Exam</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php

                                            $part_count = array(); // Initialize an array to keep track of the count of each part
                                            $part_total_marks = array(); // Initialize an array to keep track of the total marks for each part
                                    
                                            $total_marks = 0;
                                            $total_max_marks = 0;
                                            $has_ra = 0;
                                            while ($row = $result->fetch_assoc()) {
                                                $row_count = $result->num_rows;
                                                $student_name = $row["Name"];
                                                $exam = date("M Y", strtotime($row["MonthYear"]));

                                                $subject_name = $row["SubjectName"];
                                                $subject_code = $row["SubjectId"];
                                                $class_name = $row["ClassName"];
                                                $semester = $row["Semester"];
                                                $max_cia = $row["cia"];
                                                $max_ese = $row["ese"];
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
                                                if ($total >= $max_pass and $ese >= 38) {
                                                    $sresult = "Pass";
                                                } else {
                                                    $sresult = "RA";
                                                    $has_ra = true;
                                                }


                                                echo "<tr>";


                                                echo "<td>" . $subject_code . "</td>";
                                                echo "<td>" . $part . "</td>";
                                                echo "<td>" . $subject_name . "</td>";
                                                echo "<td>" . $cia . "</td>";
                                                echo "<td>" . $ese . "</td>";
                                                echo "<td>" . $total . "</td>";
                                                echo "<td>" . $sresult . "</td>";
                                                echo "<td>" . $exam . "</td>";
                                                echo "</tr>";

                                            }
                                            ?>
                                        </tbody>

                                    </table>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="3">Part-wise & Overall Total Marks and %</th>
                                            </tr>
                                            <tr>
                                                <th>Part</th>
                                                <th>Total Marks</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($part_count as $part => $count) {
                                                $part_total = $part_total_marks[$part];
                                                $part_max = $part_count[$part] * $total_max_marks / $row_count;
                                                $part_percentage = round($part_total / $part_max * 100, 2);
                                                echo "<tr>";
                                                echo "<td>Part " . $part . "</td>";
                                                echo "<td>" . $part_total . "/" . $part_max . "</td>";
                                                echo "<td>" . $part_percentage . "%</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" style="background-color: #ccc;"><strong>Overall Total:</strong>
                                                </td>
                                                <td>
                                                    <?php echo $total_marks . "/" . $total_max_marks; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="background-color: #ccc;"><strong>Overall
                                                        Percentage:</strong></td>
                                                <td>
                                                    <?php
                                                    if (!$has_ra && $sresult == "Pass") {
                                                        echo round($total_marks / $total_max_marks * 100, 2) . "%";
                                                    } else {
                                                        echo "Result is fail. Percentage not calculated.";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tfoot>
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