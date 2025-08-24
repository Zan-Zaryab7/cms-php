<?php
session_start();
include("includes/dbpdo.php"); // ✅ use PDO version

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["client-signup"])) {
    $firstname = trim($_POST["client-firstname"]);
    $lastname = trim($_POST["client-lastname"]);
    $email = trim($_POST["client-email"]);
    $password = $_POST["client-password"];

    try {
        // Check if email already exists
        $stmt = $conpdo->prepare("SELECT client_id FROM client WHERE client_email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $error = "Email already used.";
        } else {
            // Insert new client
            $hashedpwd = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conpdo->prepare(
                "INSERT INTO client (client_first_name, client_last_name, client_email, client_password) 
                 VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([$firstname, $lastname, $email, $hashedpwd]);

            if ($stmt->rowCount() > 0) {
                header("Location: client_login.php");
                exit();
            } else {
                $error = "Signup failed. Please try again.";
            }
        }
    } catch (PDOException $e) {
        error_log("Signup error: " . $e->getMessage());
        $error = "Database error. Please try again later.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/signup.css">
    <link rel="icon" href="public/images/statue.jpg" type="image/x-icon">
</head>

<body>
    <div class="container">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="client_signup.php" method="post" style="border:1px solid #ccc; padding: 8px;">
            <h1>Client Sign Up</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>

            <label for="firstname"><b>First Name</b></label>
            <input type="text" placeholder="First Name" name="client-firstname" required>

            <label for="lastname"><b>Last Name</b></label>
            <input type="text" placeholder="Last Name" name="client-lastname" required>

            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="client-email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="client-password" id="pass" required>

            <label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
            </label>&nbsp;
            <u class="custom-switch btn">
                <input type="checkbox" class="custom-control-input" onclick="showPass()" id="customSwitches">
                <label class="custom-control-label" for="customSwitches">Show Password</label>
            </u>

            <p>By creating an account you agree to our
                <a href="#" style="color:dodgerblue">Terms & Privacy</a>.
            </p>

            <div class="clearfix">
                <button type="button" class="cancelbtn" onclick="window.location.href='index.php'">Cancel</button>
                <button type="submit" name="client-signup" class="signupbtn">Sign Up</button>
            </div>
            <a href="client_login.php">Already have an account? Login</a>
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