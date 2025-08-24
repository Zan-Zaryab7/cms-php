<?php
if (isset($_POST["addcase"])) {
    require_once("includes/db.php");

    if ($con) {
        $casetype = trim($_POST["ctype"]);
        $casedetails = trim($_POST["cdetails"]);
        $case_status = "pending";

        $clientid = (int) ($_SESSION['client_id'] ?? 0);
        $lawyerid = (int) ($_GET['id'] ?? 0);

        // Insert into cases
        $stmt = $con->prepare("
            INSERT INTO cases (case_type, case_details, case_status, lawyer_id_assigned, clientforcase_id)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->bind_param('sssii', $casetype, $casedetails, $case_status, $lawyerid, $clientid);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();

            // Add notification
            $notification_text = "New case '" . htmlspecialchars($casetype) . "' has been created.";
            $stmt = $con->prepare("
                INSERT INTO client_notifications (client_id, notification)
                VALUES (?, ?)
            ");
            $stmt->bind_param('is', $clientid, $notification_text);
            $stmt->execute();
            $stmt->close();

            header("Location: client_dashboard.php?q=currentcase");
            exit;
        } else {
            echo "<p>Error adding case.</p>";
        }
    } else {
        echo "<p>Database connection error.</p>";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <h1><?php echo htmlspecialchars($_SESSION["client_name"] ?? ""); ?></h1>
            <br>
            <ul id="side_menu" class="nav nav-pills nav-stacked">
                <li><a href="client_dashboard.php"><span class="glyphicon glyphicon-user"></span>&nbsp; Profile</a></li>
                <li><a href="client_dashboard.php?q=addcase"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;
                        Add case</a></li>
                <li><a href="client_dashboard.php?q=sendfeedback"><span
                            class="glyphicon glyphicon-comment"></span>&nbsp; Send Feedback</a></li>
                <li><a href="client_dashboard.php?q=currentcase"><span class="glyphicon glyphicon-ok"></span>&nbsp;
                        Current Case Info</a></li>
                <li><a href="client_dashboard.php?q=notifications"><span
                            class="glyphicon glyphicon-bullhorn"></span>&nbsp; Notifications</a></li>
            </ul>
        </div>

        <div class="col-sm-10" style="font-weight: bold; padding-bottom: 30px;">
            <h1>Enter Case details</h1><br>
            <form action="client_dashboard.php?q=addtocase&id=<?php echo (int) ($_GET['id'] ?? 0); ?>" method="post">
                <label for="case-type">Case Type:</label>
                <input type="text" class="form-control" placeholder="Case Type" name="ctype" required><br>

                <label for="case-details">Case Details:</label>
                <input type="text" class="form-control" placeholder="Case Details" name="cdetails" required><br>

                <button class="btn btn-primary btn-lg btn-block" type="submit" name="addcase">
                    Add Case
                </button>
            </form>
        </div>
    </div>
</div>