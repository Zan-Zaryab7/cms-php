<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <h1>
                <?php echo $_SESSION["lawyer_name"]; ?>
            </h1>
            <br>

            <ul id="side_menu" class="nav nav-pills nav-stacked">
                <li class="">
                    <a href="lawyer_dashboard.php">
                        <span class="glyphicon glyphicon-comment"></span>
                        &nbsp; Profile
                    </a>
                </li>
                <li class="">
                    <a href="lawyer_dashboard.php?q=currentcases">
                        <span class="glyphicon glyphicon-list-alt"></span>
                        &nbsp; Current Cases
                    </a>
                </li>
                <li class="">
                    <a href="lawyer_dashboard.php?q=finishedcases">
                        <span class="glyphicon glyphicon-ok"></span>
                        &nbsp; Finished Cases
                    </a>
                </li>
                <li class="">
                    <a href="lawyer_dashboard.php?q=managerequests">
                        <span class="glyphicon glyphicon-briefcase"></span>
                        &nbsp; Manage Requests
                    </a>
                </li>
                <li class="active">
                    <a href="lawyer_dashboard.php?q=invoice">
                        <span class="glyphicon glyphicon-credit-card"></span>
                        &nbsp; Your Invoice
                    </a>
                </li>
            </ul>
        </div>
        <!--div ending of vertical nav -->

        <div class="col-sm-10">
            <h1>Invoice Layout</h1>
            <?php
            require_once "includes/db.php";

            if ($con) {
                if (isset($_POST['invoice_submit'])) {
                    // Sanitize inputs
                    $retainer = (int) $_POST['retainer'];
                    $hearing = (int) $_POST['hearing'];
                    $consult = (int) $_POST['consult'];

                    $stmt = $con->prepare("INSERT INTO invoice (lawyer_id, retainer, hearing, consulting) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("iiii", $_SESSION['lawyer_id'], $retainer, $hearing, $consult);
                    $stmt->execute();
                }

                $stmt = $con->prepare("SELECT invoice_id FROM invoice WHERE lawyer_id = ?");
                $id = (int) $_SESSION['lawyer_id'];
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $stmt->store_result();
                $numRows = $stmt->num_rows;

                if ($numRows == 0) {
                    echo '
                        <p>Please fill in details for your invoice layout</p>
                        <form action="" method="post">
                            <input type="number" placeholder="Retainer Fees" name="retainer" required>
                            <input type="number" placeholder="Per Hearing Fees" name="hearing" required>
                            <input type="number" placeholder="Consulting Fees" name="consult" required>
                            <input type="submit" name="invoice_submit" value="Save">
                        </form>';
                } else {
                    $stmt = $con->prepare("SELECT retainer, hearing, consulting FROM invoice WHERE lawyer_id = ?");
                    $stmt->bind_param('i', $_SESSION['lawyer_id']);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($retainer, $hearing, $consulting);
                    $stmt->fetch();

                    echo "
                        <p class='invoice_info'>Retainer Fees: {$retainer}</p>
                        <p class='invoice_info'>Per Hearing Fees: {$hearing}</p>
                        <p class='invoice_info'>Consulting Fees: {$consulting}</p>
                    ";
                }
            } else {
                echo "Server Problem";
            }
            ?>
        </div>
    </div>
</div>