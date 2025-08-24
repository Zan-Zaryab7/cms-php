<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <h1><?php echo htmlspecialchars($_SESSION["admin_name"] ?? ""); ?></h1>
            <br>
            <ul id="side_menu" class="nav nav-pills nav-stacked">
                <li><a href="admin_dashboard.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Current
                        Cases</a></li>
                <li class="active"><a href="admin_dashboard.php?q=finishedcases"><span
                            class="glyphicon glyphicon-ok"></span>&nbsp; Finished Cases</a></li>
                <li><a href="admin_dashboard.php?q=managelawyers"><span class="glyphicon glyphicon-user"></span>&nbsp;
                        Manage Lawyers</a></li>
                <li><a href="admin_dashboard.php?q=feedbacks"><span class="glyphicon glyphicon-comment"></span>&nbsp;
                        Feedbacks</a></li>
            </ul>
        </div>

        <div class="col-sm-10">
            <h1>Finished Cases</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Case Type</th>
                            <th>Case Details</th>
                            <th>Case Status</th>
                            <th>Court Appointed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once("includes/db.php");

                        if ($con) {
                            $x = 1;
                            $status = "finished";
                            $stmt = $con->prepare("
                                SELECT case_type, case_details, court_name
                                FROM cases
                                WHERE case_status = ?
                                ORDER BY case_id DESC
                            ");
                            $stmt->bind_param('s', $status);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $case_type = htmlspecialchars($row['case_type']);
                                    $case_details = htmlspecialchars($row['case_details']);
                                    $court_name = htmlspecialchars($row['court_name']);

                                    echo "
                                    <tr>
                                        <td>{$x}</td>
                                        <td>{$case_type}</td>
                                        <td>{$case_details}</td>
                                        <td><span class='label label-success'>Finished</span></td>
                                        <td>{$court_name}</td>
                                    </tr>";
                                    $x++;
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center text-muted'>No finished cases found</td></tr>";
                            }

                            $stmt->close();
                        } else {
                            echo "<tr><td colspan='5' class='text-center text-danger'>Database connection error</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>