<?php
include("includes/sessions.php");
include("includes/functions.php");
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
                include("client/addcase.php");
                break;
            case "sendfeedback":
                include("client/sendfeedback.php");
                break;
            case "currentcase":
                include("client/currentcase.php");
                break;
            case "notifications":
                include("client/notifications.php");
                break;
            case "updateinfo":
                include("client/updateinfo.php");
                break;
            case "addtocase":
                include("client/addtocase.php");
                break;
            default:
                include("client/clientprofile.php");
                break;
        }
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>

</html>