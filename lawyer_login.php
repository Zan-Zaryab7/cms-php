<?php
session_start();

include __DIR__ . "/includes/db.php";
include __DIR__ . "/includes/sessions.php";

$loginError = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["lawyer-login"])) {
    $email = trim($_POST["lawyer-email"] ?? "");
    $password = $_POST["lawyer-password"] ?? "";

    if ($con) {
        $stmt = $con->prepare("SELECT lawyer_id, lawyer_password, lawyer_first_name FROM lawyer_login WHERE lawyer_email = ?");
        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($lawyer_id, $db_pwd, $lawyer_name);

            if ($stmt->num_rows === 0) {
                $loginError = "Email not found";
            } else {
                $stmt->fetch();
                if (!password_verify($password, $db_pwd)) {
                    $loginError = "Invalid password";
                } else {
                    $_SESSION["lawyer_id"] = $lawyer_id;
                    $_SESSION["lawyer_name"] = $lawyer_name;
                    header("Location: lawyer_dashboard.php?id=" . urlencode($lawyer_id));
                    exit();
                }
            }
            $stmt->close();
        } else {
            $loginError = "Database query error.";
        }
    } else {
        $loginError = "Database connection error.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawyer Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="icon" href="public/images/statue.jpg" type="image/x-icon">
</head>

<body>

    <div class="container">
        <form action="lawyer_login.php" method="post">
            <div class="imgcontainer">
                <img src="public/images/user.png" alt="Avatar" class="avatar">
                <br><br>
                <h4>Login for Lawyers</h4>
            </div>

            <?php if (!empty($loginError)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($loginError); ?></div>
            <?php endif; ?>

            <div class="container">
                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="lawyer-email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="lawyer-password" id="pass" required>

                <button type="submit" name="lawyer-login">Login</button>
                <label>
                    <input type="checkbox" name="remember"> Remember me
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
            <a href="lawyer_signup.php">Don't have an account? Sign up</a>
        </form>
    </div>

    <script>
        function showPass() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

</body>

</html>