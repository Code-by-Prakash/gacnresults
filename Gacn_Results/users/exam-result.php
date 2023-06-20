<?php
ob_start();
require_once('includes/connection.php');
?>
<h4 class="mb text-center"><i class="fa fa-pencil-square-o"></i> Exam-wise Result</h4>
<!-- Content for the Exam-wise section goes here -->
<?php
// Check if the registration number is stored in the session
if (isset($_SESSION['regno'])) {
    $regno = $_SESSION['regno'];
    ?>
    <form class="form-horizontal style-form" method="post" name="result" enctype="multipart/form-data" action="">
        <div class="dropdown">
            <select class="form-control" name="exam" id="exam" required>
                <option value="">-- Select the exam month and year --</option>
                <?php
                // Select data from database
                $query = "SELECT DISTINCT DATE_FORMAT(MonthYear, '%b %Y') AS MonthYear FROM tblresults WHERE `tblresults`.`StudentId` = $regno";
                $result = mysqli_query($con, $query);

                // Loop through results and create options
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['MonthYear'] . "'>" . $row['MonthYear'] . "</option>";
                }
                ?>
            </select>
            <br>
            <button type="submit" name="submit-exam" class="btn btn-success">Submit</button>
        </div>
    </form>
    <?php

    if (isset($_POST['exam'])) {
        $exam = $_POST['exam'];

        // Prepare and execute SQL query
        $sql1 = "SELECT * FROM tblstudents 
                JOIN tblresults ON tblresults.StudentId = tblstudents.Userid 
                JOIN tblsubjects ON tblresults.SubjectId=tblsubjects.SubjectId 
                JOIN tblsubjectcombination on tblsubjects.SubjectId=tblsubjectcombination.SubjectId
                JOIN tblclasses on tblsubjectcombination.ClassId=tblclasses.ClassId AND tblstudents.ClassId=tblclasses.ClassId
                WHERE DATE_FORMAT(tblresults.MonthYear, '%b %Y')='$exam' and tblstudents.Userid='$regno' ORDER BY tblsubjects.Semester ASC, tblsubjects.Part ASC,tblsubjects.SubjectId ASC";
        $result1 = $con->query($sql1);

        // Check if any results were returned
        if ($result1->num_rows > 0) {
            $row = $result1->fetch_assoc();
            $student_name = $row['Name'];
            $exam = date("M Y", strtotime($row["MonthYear"]));
            echo "<h3>EXAM: $exam</h3>";

            // Loop through results and output data
            ?>
            <table class="table table-striped">
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
                        while ($row = $result1->fetch_assoc()) {
                            $row_count = $result1->num_rows;
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
            echo "No results found";
        }

        // Close database connection
        $con->close();



    }
}
?>