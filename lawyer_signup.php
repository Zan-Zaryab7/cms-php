<?php
session_start();

require_once __DIR__ . "/includes/db.php";

$signupError = "";
$signupSuccess = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["lawyer-signup"])) {
    $firstname = trim($_POST["lawyer-firstname"] ?? "");
    $lastname  = trim($_POST["lawyer-lastname"] ?? "");
    $email     = trim($_POST["lawyer-email"] ?? "");
    $password  = $_POST["lawyer-password"] ?? "";

    if ($con) {
        // check if email already exists
        $stmt = $con->prepare("SELECT lawyer_id FROM lawyer_login WHERE lawyer_email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $signupError = "Email is already registered.";
            } else {
                $hashedpwd = password_hash($password, PASSWORD_BCRYPT);
                $stmt->close();

                $stmt = $con->prepare("INSERT INTO lawyer_login (lawyer_first_name, lawyer_last_name, lawyer_email, lawyer_password) VALUES (?,?,?,?)");
                if ($stmt) {
                    $stmt->bind_param("ssss", $firstname, $lastname, $email, $hashedpwd);
                    if ($stmt->execute()) {
                        $signupSuccess = "Account created successfully. Redirecting to login...";
                        header("Refresh: 2; URL=lawyer_login.php");
                        exit();
                    } else {
                        $signupError = "Failed to create account.";
                    }
                    $stmt->close();
                } else {
                    $signupError = "Database insert error.";
                }
            }
        } else {
            $signupError = "Database query error.";
        }
    } else {
        $signupError = "Database connection error.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawyer Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/signup.css">
    <link rel="icon" href="public/images/statue.jpg" type="image/x-icon">
</head>
<body>

<div class="container">
    <form action="lawyer_signup.php" method="post" style="border:1px solid #ccc">
        <div class="container">
            <h1>Sign Up for Lawyers</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>

            <?php if (!empty($signupError)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($signupError); ?></div>
            <?php endif; ?>
            <?php if (!empty($signupSuccess)): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($signupSuccess); ?></div>
            <?php endif; ?>

            <label for="firstname"><b>First Name</b></label>
            <input type="text" placeholder="First Name" name="lawyer-firstname" required>

            <label for="lastname"><b>Last Name</b></label>
            <input type="text" placeholder="Last Name" name="lawyer-lastname" required>

            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="lawyer-email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="lawyer-password" id="pass" required>

            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
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
                <button type="submit" name="lawyer-signup" class="signupbtn">Sign Up</button>
            </div>
            <a href="lawyer_login.php">Already have an account? Login</a>
        </div>
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
