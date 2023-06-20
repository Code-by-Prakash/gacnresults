<?php
ob_start();
require_once('includes/connection.php');
?>

<h4 class="mb text-center"><i class="fa fa-pencil-square-o"></i> Semester-wise Result</h4>

<?php
// Check if the registration number is stored in the session
if (isset($_SESSION['regno'])) {
    $regno = $_SESSION['regno'];
    ?>

    <form class="form-horizontal style-form" method="post" name="result" enctype="multipart/form-data" action="">
        <div class="dropdown">
            <select class="form-control" name="semester" id="semester" required="required">
                <option value="">-- Select the semester --</option>
                <?php
                $query = "SELECT DISTINCT Semester FROM tblsubjects JOIN tblresults ON tblresults.SubjectId = tblsubjects.SubjectId WHERE tblresults.StudentId = '$regno'";
                $result = mysqli_query($con, $query);

                // Check if any results were returned
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $semester = $row['Semester'];
                        echo "<option value='$semester'>SEMESTER $semester</option>";
                    }
                }
                ?>
            </select>
            <br>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $semester = $_POST['semester'];
        $sql = "SELECT s.*, r.*, sub.*
        FROM tblstudents s
        JOIN tblresults r ON r.StudentId = s.Userid
        JOIN tblsubjects sub ON r.SubjectId = sub.SubjectId 
        WHERE sub.Semester = '$semester'
            AND s.Userid = '$regno'
            AND r.MonthYear = (
                SELECT MAX(MonthYear)
                FROM tblresults
                WHERE StudentId = s.Userid
                    AND SubjectId = r.SubjectId
            )
        GROUP BY sub.Part, sub.SubjectId
        ORDER BY sub.Part ASC, sub.SubjectId ASC";


        $result = $con->query($sql);

        // Check if any results were returned
        if ($result->num_rows > 0) {
            $first_row = true; // Flag to track the first row
            $student_name = '';
            $exam = '';
            $semester = '';
            $regno = '';
            $department = '';

            while ($row = $result->fetch_assoc()) {
                $subject_name = $row["SubjectName"];
                $subject_code = $row["SubjectId"];
                $part = $row["Part"];
                $cia = $row["CIA"];
                $ese = $row["ESE"];
                $total = $cia + $ese;
                $pass_ese = $row["esePass"];
                $sresult = ($total >= $row["totalPass"] && $ese >= $pass_ese) ? "Pass" : "RA";

                if ($first_row) {
                    $student_name = $row['Name'];
                    $exam = date("M Y", strtotime($row["MonthYear"]));
                    $semester = $row["Semester"];
                    $regno = $row["Userid"];
                    $department = $row["Department"];

                    echo "<h3>SEMESTER: $semester</h3>";
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
                    $first_row = false; // Set the flag to false after the first row
                }

                echo "<tr>";
                echo "<td>$subject_code</td>";
                echo "<td>$part</td>";
                echo "<td>$subject_name</td>";
                echo "<td>$cia</td>";
                echo "<td>$ese</td>";
                echo "<td>$total</td>";
                echo "<td>$sresult</td>";
                echo "<td>$exam</td>";
                echo "</tr>";
            }

            ?>
                        </tbody>
                    </table>

                    <?php
                    $result->data_seek(0);

                    $part_count = array();
                    $part_total_marks = array();
                    $total_marks = 0;
                    $total_max_marks = 0;
                    $has_ra = false;

                    while ($row = $result->fetch_assoc()) {
                        $part = $row["Part"];
                        $cia = $row["CIA"];
                        $ese = $row["ESE"];
                        $total = $cia + $ese;

                        if (!isset($part_count[$part])) {
                            $part_count[$part] = 0;
                            $part_total_marks[$part] = 0;
                        }

                        $part_count[$part]++;
                        $part_total_marks[$part] += ($cia + $ese);
                        $total_marks += ($cia + $ese);
                        $total_max_marks += $row["total"];

                        if ($total < $row["totalPass"] || $ese < 38) {
                            $has_ra = true;
                        }
                    }

                    ?>
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
                                $part_max = $part_count[$part] * $total_max_marks / $result->num_rows;
                                $part_percentage = round($part_total / $part_max * 100, 2);

                                echo "<tr>";
                                echo "<td>Part $part</td>";
                                echo "<td>$part_total / $part_max</td>";
                                echo "<td>$part_percentage%</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="background-color: #ccc;"><strong>Overall Total:</strong></td>
                                <td><?php echo $total_marks . "/" . $total_max_marks; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="background-color: #ccc;"><strong>Overall Percentage:</strong></td>
                                <td>
                                    <?php
                                    if (!$has_ra) {
                                        $overall_percentage = round($total_marks / $total_max_marks * 100, 2);
                                        echo $overall_percentage . "%";
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
            echo "No results found";
        }

        // Close database connection
        $con->close();
    }
}
?>
