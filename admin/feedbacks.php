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
                <li class="active"><a href="admin_dashboard.php?q=feedbacks"><span
                            class="glyphicon glyphicon-comment"></span>&nbsp; Feedbacks</a></li>
            </ul>
        </div>

        <div class="col-sm-10">
            <h1>Feedbacks</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Feedback</th>
                            <th>User</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("includes/db.php");

                        if ($con) {
                            $x = 1;
                            $stmt = $con->prepare("
                                SELECT feedback_id, feedback_content, user_name
                                FROM feedbacks
                                ORDER BY feedback_id DESC
                            ");
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $feedback_id = (int) $row['feedback_id'];
                                    $feedback = htmlspecialchars($row['feedback_content']);
                                    $name = htmlspecialchars($row['user_name']);

                                    echo "
                                    <tr>
                                        <td>{$x}</td>
                                        <td>{$feedback}</td>
                                        <td>{$name}</td>
                                        <td>
                                            <a class='btn btn-danger btn-sm' 
                                               href='admin_dashboard.php?q=removefeedback&id={$feedback_id}' 
                                               onclick='return confirm(\"Are you sure you want to delete this feedback?\")'>
                                                Remove
                                            </a>
                                        </td>
                                    </tr>";
                                    $x++;
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center text-muted'>No feedbacks found</td></tr>";
                            }

                            $stmt->close();
                        } else {
                            echo "<tr><td colspan='4' class='text-center text-danger'>Database connection error</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>