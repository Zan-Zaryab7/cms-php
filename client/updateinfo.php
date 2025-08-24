<?php
include("includes/session.php");
include("includes/db.php");

if (isset($_POST["update-info"])) {
    $firstname = trim($_POST["fname"]);
    $lastname = trim($_POST["lname"]);
    $phone = trim($_POST["phone_no"]);
    $address = trim($_POST["address"]);

    if ($con && isset($_SESSION['client_id'])) {
        $cid = (int) $_SESSION['client_id'];
        $stmt = $con->prepare("
            UPDATE client 
            SET client_first_name = ?, client_last_name = ?, phone_no = ?, address = ? 
            WHERE client_id = ?
        ");
        $stmt->bind_param('ssssi', $firstname, $lastname, $phone, $address, $cid);
        $stmt->execute();

        if ($stmt->affected_rows === -1) {
            echo "Error updating information.";
        } else {
            $stmt->close();
            header("Location: client_dashboard.php");
            exit;
        }
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
            <?php
            if ($con && isset($_SESSION['client_id'])) {
                $stmt = $con->prepare("
                    SELECT client_first_name, client_last_name, client_email, phone_no, address
                    FROM client WHERE client_id = ?
                ");
                $cid = (int) $_SESSION['client_id'];
                $stmt->bind_param('i', $cid);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($cfn, $cln, $ce, $cph, $ca);

                if ($stmt->fetch()) {
                    echo "
                        <h1>Update Profile</h1><br>
                        <form action='client_dashboard.php?q=updateinfo' method='post'>
                            <label for='fname'>First Name:</label>
                            <input type='text' class='form-control' value='" . htmlspecialchars($cfn) . "' 
                                placeholder='First name' name='fname' required><br>

                            <label for='lname'>Last Name:</label>
                            <input type='text' class='form-control' value='" . htmlspecialchars($cln) . "' 
                                placeholder='Last name' name='lname' required><br>

                            <label for='phone'>Phone no:</label>
                            <input type='number' class='form-control' value='" . htmlspecialchars($cph) . "' 
                                placeholder='Phone no' name='phone_no'><br>

                            <label for='add'>Address:</label>
                            <input type='text' class='form-control' value='" . htmlspecialchars($ca) . "' 
                                placeholder='Address' name='address'><br>

                            <button class='btn btn-primary btn-lg btn-block' type='submit' name='update-info'>
                                Update info
                            </button>
                        </form>
                    ";
                }
                $stmt->close();
            }
            ?>
        </div>
    </div>
</div>