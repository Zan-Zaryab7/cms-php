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
                <li class="active"><a href="admin_dashboard.php?q=managelawyers"><span
                            class="glyphicon glyphicon-user"></span>&nbsp; Manage Lawyers</a></li>
                <li><a href="admin_dashboard.php?q=feedbacks"><span class="glyphicon glyphicon-comment"></span>&nbsp;
                        Feedbacks</a></li>
            </ul>
        </div>

        <div class="col-sm-10">
            <h1>Lawyers</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>City</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("includes/db.php");

                        if ($con) {
                            $x = 1;
                            $stmt = $con->prepare("
                                SELECT lawyer_id, lawyer_first_name, lawyer_last_name, lawyer_email,
                                       lawyer_phone_no, lawyer_city, lawyer_rating
                                FROM lawyer_login
                                ORDER BY lawyer_first_name ASC
                            ");
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $lawyer_name = htmlspecialchars($row['lawyer_first_name'] . " " . $row['lawyer_last_name']);
                                    $lawyer_email = htmlspecialchars($row['lawyer_email']);
                                    $lawyer_phone = $row['lawyer_phone_no'] ? htmlspecialchars($row['lawyer_phone_no']) : "<span class='text-muted'>Not given</span>";
                                    $lawyer_city = $row['lawyer_city'] ? htmlspecialchars($row['lawyer_city']) : "<span class='text-muted'>Not given</span>";
                                    $lawyer_rating = $row['lawyer_rating'] ? htmlspecialchars($row['lawyer_rating']) : "<span class='text-muted'>Not given</span>";

                                    echo "
                                    <tr>
                                        <td>{$x}</td>
                                        <td>{$lawyer_name}</td>
                                        <td>{$lawyer_email}</td>
                                        <td>{$lawyer_phone}</td>
                                        <td>{$lawyer_city}</td>
                                        <td>{$lawyer_rating}</td>
                                    </tr>";
                                    $x++;
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center text-muted'>No lawyers found</td></tr>";
                            }

                            $stmt->close();
                        } else {
                            echo "<tr><td colspan='6' class='text-center text-danger'>Database connection error</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>