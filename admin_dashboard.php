<?php
require_once("includes/sessions.php");
require_once("includes/functions.php");
confirm_admin_login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($_SESSION["admin_name"]); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/dashboard.css">
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
            <button class="sm btn btn-danger" onclick="window.location.href='logout.php'">
                <span class="glyphicon glyphicon-off"></span> Logout
            </button>
        </div>
    </div>

    <div class="container-fluid">
        <?php
        $page = $_GET['q'] ?? null;
        switch ($page) {
            case "finishedcases":
                require_once("admin/finishedcases.php");
                break;
            case "managelawyers":
                require_once("admin/managelawyers.php");
                break;
            case "feedbacks":
                require_once("admin/feedbacks.php");
                break;
            case "updatecase":
                require_once("admin/updatecase.php");
                break;
            case "removefeedback":
                require_once("admin/removefeedback.php");
                break;
            default:
                require_once("admin/currentcases.php");
                break;
        }
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>

</html>