<?php
ob_start();
require_once('includes/connection.php');
?>

<h4 class="mb text-center"><i class="fa fa-pencil-square-o"></i> Subject-wise Result</h4>

<?php
// Check if the registration number is stored in the session
if (isset($_SESSION['regno'])) {
    $regno = $_SESSION['regno'];
    ?>

    <form class="form-horizontal style-form" method="post" name="result" enctype="multipart/form-data" action="">
        <div class="dropdown">
            <select class="form-control" name="subject" id="subject" required="required">
                <option value="">-- Select the subject --</option>
                <?php
                $query = "SELECT DISTINCT SubjectName FROM tblsubjects JOIN tblresults ON tblresults.SubjectId = tblsubjects.SubjectId WHERE tblresults.StudentId = '$regno'";
                $result = mysqli_query($con, $query);

                // Check if any results were returned
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $subject_name = $row['SubjectName'];
                        echo "<option value='$subject_name'>$subject_name</option>";
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
        $subject = $_POST['subject'];
        $sql = "SELECT s.*, r.*, sub.* FROM tblstudents s
            JOIN tblresults r ON r.StudentId = s.Userid
            JOIN tblsubjects sub ON r.SubjectId = sub.SubjectId 
            
           
            WHERE sub.SubjectName = '$subject'
                AND s.Userid = '$regno'
            ORDER BY STR_TO_DATE(CONCAT('01 ', r.MonthYear), '%d %b %Y') ASC";

        $result = $con->query($sql);

        // Check if any results were returned
        if ($result->num_rows > 0) {
            $rows = array();

            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }

            $row_count = count($rows);
            $student_name = $rows[0]['Name'];
            $subject_name = $rows[0]["SubjectName"];
            $subject_code = $rows[0]["SubjectId"];
            $regno = $rows[0]["Userid"];
            $department = $rows[0]["Department"];

            echo "<h3>Subject: $subject_name (CODE: $subject_code)</h3>";
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
                    $total_marks = 0;
                    $total_max_marks = 0;
                    $has_ra = false;
                    $has_pass = false;

                    foreach ($rows as $row) {
                        $semester = $row["Semester"];
                        $monthyear = $row["MonthYear"];
                        $exam = date("M Y", strtotime($monthyear));
                        $part = $row["Part"];
                        $cia = $row["CIA"];
                        $ese = $row["ESE"];
                        $total = $cia + $ese;
                        $max_marks = $row["total"];
                        $pass_ese = $row["esePass"];
                        $max_pass = $row["totalPass"];

                        $total_marks += $total;
                        $total_max_marks += $max_marks;

                        if ($total >= $max_pass && $ese >= $pass_ese) {
                            $sresult = "Pass";
                            $has_pass = true;
                        } else {
                            $sresult = "RA";
                            $has_ra = true;
                        }
                        ?>
                        <tr>
                            <td><?php echo $semester; ?></td>
                            <td><?php echo $exam; ?></td>
                            <td><?php echo $part; ?></td>
                            <td><?php echo $cia; ?></td>
                            <td><?php echo $ese; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $sresult; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <h4>
                <?php
                if ($has_pass) {
                    echo "$student_name passed in this subject.";
                } else {
                    echo "$student_name did not passed in this subject.";
                }
                ?>
            </h4>

            <?php
        } else {
            echo "No results found";
        }

        // Close database connection
        $con->close();
    }
}
?>
