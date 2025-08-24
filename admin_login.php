<?php
include "includes/db.php";
include "includes/sessions.php";

if (isset($_POST["admin-login"])) {
    $email = trim($_POST["admin-email"]);
    $password = $_POST["admin-password"];

    if ($con) {
        $stmt = $con->prepare("SELECT admin_id, admin_first_name, password FROM admin_login WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $error = "Email not found.";
        } else {
            $stmt->bind_result($admin_id, $admin_first_name, $db_pwd);
            $stmt->fetch();

            if (!password_verify($password, $db_pwd)) {
                $error = "Invalid password.";
            } else {
                $_SESSION["admin_id"] = $admin_id;
                $_SESSION["admin_name"] = $admin_first_name;
                header("Location: admin_dashboard.php?id=" . $admin_id);
                exit();
            }
        }
        $stmt->close();
    } else {
        $error = "Database connection error.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="icon" href="public/images/statue.jpg" type="image/x-icon">
</head>

<body>
    <div class="container">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="admin_login.php" method="post">
            <div class="imgcontainer">
                <img src="public/images/user.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="admin-email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="admin-password" id="pass" required>

                <button type="submit" name="admin-login">Login</button>
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <div>
                    <input type="checkbox" onclick="showPass()" id="showPassChk">
                    <label for="showPassChk">Show Password</label>
                </div>
            </div>

            <div class="container" style="background-color:#fff">
                <button type="button" class="cancelbtn" onclick="window.location.href='index.php'">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
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