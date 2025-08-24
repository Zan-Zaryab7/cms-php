<?php
include "includes/sessions.php";
include "includes/dbpdo.php"; // ✅ use PDO for consistency

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["client-login"])) {
    $email = trim($_POST["client-email"]);
    $password = $_POST["client-password"];

    try {
        $stmt = $conpdo->prepare("SELECT client_id, client_first_name, client_password 
                                  FROM client WHERE client_email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            $error = "Email not found.";
        } elseif (!password_verify($password, $user["client_password"])) {
            $error = "Invalid password.";
        } else {
            // ✅ Success → set session and redirect before HTML is sent
            $_SESSION['client_id'] = $user["client_id"];
            $_SESSION['client_name'] = $user["client_first_name"];
            header("Location: client_dashboard.php");
            exit();
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        $error = "Server problem. Please try again later.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="icon" href="public/images/statue.jpg" type="image/x-icon">
</head>

<body>
    <div class="container">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="client_login.php" method="post">
            <div class="imgcontainer">
                <img src="public/images/user.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="client-email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="client-password" id="pass" required>

                <button type="submit" name="client-login">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>&nbsp;
                <u class="custom-switch btn">
                    <input type="checkbox" class="custom-control-input" onclick="showPass()" id="customSwitches">
                    <label class="custom-control-label" for="customSwitches">Show Password</label>
                </u>
            </div>

            <div class="container" style="background-color:#fff">
                <button type="button" class="cancelbtn" onclick="window.location.href='index.php'">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
            <a href="client_signup.php">Don’t have an account? Signup</a>
        </form>
    </div>

    <script>
        function showPass() {
            var x = document.getElementById("pass");
            x.type = (x.type === "password") ? "text" : "password";
        }
    </script>
</body>

</html>