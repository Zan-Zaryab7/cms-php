<?php
require_once("includes/sessions.php");
require_once("includes/functions.php");
confirm_client_login();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo htmlspecialchars($_SESSION["client_name"]); ?> - Dashboard</title>
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
            <button class="sm" onclick="window.location.href='logout.php'">
                <span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;Logout
            </button>
        </div>
    </div>

    <div class="content">
        <?php
        // Default page if no query parameter is set
        $page = $_GET['q'] ?? "clientprofile";

        switch ($page) {
            case "addcase":
                require_once("client/addcase.php");
                break;
            case "sendfeedback":
                require_once("client/sendfeedback.php");
                break;
            case "currentcase":
                require_once("client/currentcase.php");
                break;
            case "notifications":
                require_once("client/notifications.php");
                break;
            case "updateinfo":
                require_once("client/updateinfo.php");
                break;
            case "addtocase":
                require_once("client/addtocase.php");
                break;
            default:
                require_once("client/clientprofile.php");
                break;
        }
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>

</html>