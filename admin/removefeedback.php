<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <h1><?php echo htmlspecialchars($_SESSION["admin_name"] ?? ""); ?></h1>
            <br>
            <ul id="side_menu" class="nav nav-pills nav-stacked">
                <li><a href="admin_dashboard.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Current
                        Cases</a></li>
                <li><a href="admin_dashboard.php?q=finishedcases"><span class="glyphicon glyphicon-ok"></span>&nbsp;
                        Finished Cases</a></li>
                <li><a href="admin_dashboard.php?q=managelawyers"><span class="glyphicon glyphicon-user"></span>&nbsp;
                        Manage Lawyers</a></li>
                <li><a href="admin_dashboard.php?q=feedbacks"><span class="glyphicon glyphicon-comment"></span>&nbsp;
                        Feedbacks</a></li>
            </ul>
        </div>

        <?php if (isset($_GET['id']) && ctype_digit($_GET['id'])): ?>
            <?php
            include("includes/db.php");
            $feedback_id = (int) $_GET['id'];
            $uname = "";

            if ($con) {
                $stmt = $con->prepare("SELECT user_name FROM feedbacks WHERE feedback_id = ?");
                $stmt->bind_param('i', $feedback_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($row = $result->fetch_assoc()) {
                    $uname = htmlspecialchars($row['user_name']);
                }
                $stmt->close();
            }
            ?>
            <div class="col-sm-10">
                <h1>Remove Feedback</h1>

                <div class="alert alert-danger">
                    Are you sure you want to delete feedback from <strong><?php echo $uname; ?></strong>?
                </div>

                <form action="admin_dashboard.php?q=removefeedback&id=<?php echo $feedback_id; ?>" method="post">
                    <button class="btn btn-success btn-block" type="submit" name="delete-yes">Yes</button>
                    <button class="btn btn-danger btn-block" type="submit" name="delete-no">No</button>
                </form>

                <br>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['delete-yes']) && $con) {
                        $stmt = $con->prepare("DELETE FROM feedbacks WHERE feedback_id = ?");
                        $stmt->bind_param('i', $feedback_id);
                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success'>Feedback deleted successfully.</div>";
                            echo "<meta http-equiv='refresh' content='1;url=admin_dashboard.php?q=feedbacks'>";
                        } else {
                            echo "<div class='alert alert-danger'>Error deleting feedback.</div>";
                        }
                        $stmt->close();
                    }

                    if (isset($_POST['delete-no'])) {
                        header("Location: admin_dashboard.php?q=feedbacks");
                        exit;
                    }
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>