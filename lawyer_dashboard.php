<?php
session_start();
include __DIR__ . "/includes/sessions.php";
include __DIR__ . "/includes/functions.php";
confirm_lawyer_login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($_SESSION["lawyer_name"] ?? "Lawyer Dashboard"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/dashboard.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="icon" href="public/images/statue.jpg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/2f7569df82.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="title-bar">
        <div id="item1">
            <i class="fas fa-gavel fa-3x"></i>
            <h1>Court Management System</h1>
        </div>
        <div id="item2">
            <button class="sm" onclick="window.location.href='logout.php'">
                <span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;&nbsp;Logout
            </button>
        </div>
    </div>

    <div class="dashboard-content">
        <?php
        $page = $_GET['q'] ?? 'profile';
        switch ($page) {
            case 'currentcases':
                include __DIR__ . "/lawyer/currentcases.php";
                break;
            case 'finishedcases':
                include __DIR__ . "/lawyer/finishedcases.php";
                break;
            case 'managerequests':
                include __DIR__ . "/lawyer/managerequests.php";
                break;
            case 'invoice':
                include __DIR__ . "/lawyer/invoice.php";
                break;
            case 'addcase':
                include __DIR__ . "/lawyer/addcase.php";
                break;
            default:
                include __DIR__ . "/lawyer/profilepage.php";
                break;
        }
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/76a3098157.js" crossorigin="anonymous"></script>
</body>

</html>