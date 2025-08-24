<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <h1><?php echo htmlspecialchars($_SESSION["admin_name"] ?? ""); ?></h1>
            <br>
            <ul id="side_menu" class="nav nav-pills nav-stacked">
                <li class="active"><a href="admin_dashboard.php"><span
                            class="glyphicon glyphicon-list-alt"></span>&nbsp; Current Cases</a></li>
                <li><a href="admin_dashboard.php?q=finishedcases"><span class="glyphicon glyphicon-ok"></span>&nbsp;
                        Finished Cases</a></li>
                <li><a href="admin_dashboard.php?q=managelawyers"><span class="glyphicon glyphicon-user"></span>&nbsp;
                        Manage Lawyers</a></li>
                <li><a href="admin_dashboard.php?q=feedbacks"><span class="glyphicon glyphicon-comment"></span>&nbsp;
                        Feedbacks</a></li>
            </ul>
        </div>

        <div class="col-sm-10">
            <h1>Current Cases</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sr. no</th>
                            <th>Case type</th>
                            <th>Case details</th>
                            <th>Prev hearing</th>
                            <th>Next hearing</th>
                            <th>Case status</th>
                            <th>Court Appointed</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once("includes/db.php");

                        if ($con) {
                            $status = "pending";
                            $stmt = $con->prepare("
                                SELECT case_id, case_type, case_details, prev_hearing_date, next_hearing_date, court_name
                                FROM cases 
                                WHERE case_status = ?
                                ORDER BY case_id DESC
                            ");
                            $stmt->bind_param('s', $status);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $x = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $case_id = (int) $row['case_id'];
                                    $case_type = htmlspecialchars($row['case_type']);
                                    $case_details = htmlspecialchars($row['case_details']);
                                    $prev_hearing = htmlspecialchars($row['prev_hearing_date'] ?? "Not set");
                                    $next_hearing = htmlspecialchars($row['next_hearing_date'] ?? "Not set");
                                    $court_name = htmlspecialchars($row['court_name'] ?? "Not set");

                                    echo "
                                    <tr>
                                        <td>{$x}</td>
                                        <td>{$case_type}</td>
                                        <td>{$case_details}</td>
                                        <td>{$prev_hearing}</td>
                                        <td>{$next_hearing}</td>
                                        <td><span class='label label-warning'>Pending</span></td>
                                        <td>{$court_name}</td>
                                        <td>
                                            <a class='btn btn-info btn-sm' href='admin_dashboard.php?q=updatecase&id={$case_id}'>Update</a>
                                        </td>
                                    </tr>";
                                    $x++;
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center text-muted'>No pending cases found</td></tr>";
                            }

                            $stmt->close();
                        } else {
                            echo "<tr><td colspan='8' class='text-center text-danger'>Database connection error</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>