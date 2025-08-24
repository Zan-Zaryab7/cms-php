<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <h1><?php echo htmlspecialchars($_SESSION["admin_name"] ?? ""); ?></h1>
            <br>
            <ul id="side_menu" class="nav nav-pills nav-stacked">
                <li><a href="admin_dashboard.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Current Cases</a></li>
                <li><a href="admin_dashboard.php?q=finishedcases"><span class="glyphicon glyphicon-ok"></span>&nbsp; Finished Cases</a></li>
                <li><a href="admin_dashboard.php?q=managelawyers"><span class="glyphicon glyphicon-user"></span>&nbsp; Manage Lawyers</a></li>
                <li><a href="admin_dashboard.php?q=feedbacks"><span class="glyphicon glyphicon-comment"></span>&nbsp; Feedbacks</a></li>
            </ul>
        </div>

        <?php if (isset($_GET['id']) && ctype_digit($_GET['id'])): ?>
            <?php
            require_once("includes/db.php");
            $case_id = (int) $_GET['id'];
            $c_type = $c_details = $next_hearing = $prev_hearing = $c_status = $c_name = "";

            if ($con) {
                $stmt = $con->prepare("
                    SELECT case_type, case_details, next_hearing_date, prev_hearing_date,
                           case_status, court_name
                    FROM cases 
                    WHERE case_id = ?
                ");
                $stmt->bind_param('i', $case_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($row = $result->fetch_assoc()) {
                    $c_type = htmlspecialchars($row['case_type']);
                    $c_details = htmlspecialchars($row['case_details']);
                    $next_hearing = htmlspecialchars($row['next_hearing_date']);
                    $prev_hearing = htmlspecialchars($row['prev_hearing_date']);
                    $c_status = htmlspecialchars($row['case_status']);
                    $c_name = htmlspecialchars($row['court_name']);
                }
                $stmt->close();
            }
            ?>
            <div class="col-sm-10">
                <h1>Update Case</h1>
                <form action="admin_dashboard.php?q=updatecase&id=<?php echo $case_id; ?>" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="case-type">Case Type:</label>
                            <input class="form-control" type="text" name="case-type"
                                value="<?php echo $c_type; ?>" placeholder="case-type" required><br>

                            <label for="case-details">Case details:</label>
                            <input class="form-control" type="text" name="case-details"
                                value="<?php echo $c_details; ?>" placeholder="case-details" required><br>

                            <label for="next-hearing-date">Next hearing date (YYYY-MM-DD):</label>
                            <input class="form-control" type="date" name="next-hearing-date"
                                value="<?php echo $next_hearing; ?>"><br>

                            <label for="prev-hearing-date">Prev hearing date (YYYY-MM-DD):</label>
                            <input class="form-control" type="date" name="prev-hearing-date"
                                value="<?php echo $prev_hearing; ?>" required><br>

                            <label for="case-status">Case Status (pending/finished):</label>
                            <input class="form-control" type="text" name="case-status"
                                value="<?php echo $c_status; ?>" placeholder="case-status" required><br>

                            <label for="court-name">Court Name:</label>
                            <input class="form-control" type="text" name="court-name"
                                value="<?php echo $c_name; ?>" placeholder="court-name" required><br>

                            <input class="btn btn-info btn-block" type="submit" name="update-case" value="Update Case">
                        </div>
                    </fieldset>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
if (isset($_POST['update-case']) && isset($_GET['id']) && ctype_digit($_GET['id'])) {
    require_once("includes/db.php");

    $case_id = (int) $_GET['id'];
    $case_type = trim($_POST['case-type']);
    $case_details = trim($_POST['case-details']);
    $next_hearing_date = trim($_POST['next-hearing-date']);
    $prev_hearing_date = trim($_POST['prev-hearing-date']);
    $case_status = trim($_POST['case-status']);
    $court_name = trim($_POST['court-name']);

    if ($con) {
        $stmt = $con->prepare("UPDATE cases SET
            case_type = ?, case_details = ?, next_hearing_date = ?,
            prev_hearing_date = ?, case_status = ?, court_name = ?
            WHERE case_id = ?
        ");
        $stmt->bind_param(
            'ssssssi',
            $case_type,
            $case_details,
            $next_hearing_date,
            $prev_hearing_date,
            $case_status,
            $court_name,
            $case_id
        );
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Case updated successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating case.</div>";
        }
        $stmt->close();
    }
}
?>
