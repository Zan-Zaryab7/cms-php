<?php
// This form is intended for local use only by admins to create accounts.

if (isset($_POST["admin-signup"])) {
    $firstname = trim($_POST["admin-firstname"]);
    $lastname = trim($_POST["admin-lastname"]);
    $email = trim($_POST["admin-email"]);
    $password = $_POST["admin-password"];

    require_once("includes/db.php");

    if ($con) {
        // Check if email already exists
        $stmt = $con->prepare("SELECT 1 FROM admin_login WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Email already used.";
        } else {
            // Insert new admin
            $hashedpwd = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $con->prepare(
                "INSERT INTO admin_login (admin_first_name, admin_last_name, email, password)
                 VALUES (?, ?, ?, ?)"
            );
            $stmt->bind_param('ssss', $firstname, $lastname, $email, $hashedpwd);

            if ($stmt->execute()) {
                $stmt->close();
                header("Location: admin_login.php");
                exit();
            } else {
                echo "Error creating admin account.";
            }
        }
        $stmt->close();
    } else {
        echo "Database connection error.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/signup.css">
    <link rel="icon" href="public/images/statue.jpg" type="image/x-icon">
</head>

<body>
    <form action="admin_signup.php" method="post" style="border:1px solid #ccc">
        <div class="container">
            <h1>Sign Up</h1>
            <p>Please fill in this form to create an admin.</p>
            <hr>

            <label for="firstname"><b>First Name</b></label>
            <input type="text" placeholder="First Name" name="admin-firstname" required>

            <label for="lastname"><b>Last Name</b></label>
            <input type="text" placeholder="Last Name" name="admin-lastname" required>

            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="admin-email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="admin-password" id="pass" required>

            <div class="form-group">
                <input type="checkbox" onclick="showPass()" id="showPassChk">
                <label for="showPassChk">Show Password</label>
            </div>

            <div class="clearfix">
                <button type="submit" name="admin-signup" class="signupbtn">Sign Up</button>
            </div>
        </div>
    </form>

    <script>
        function showPass() {
            var x = document.getElementById("pass");
            x.type = (x.type === "password") ? "text" : "password";
        }
    </script>
</body>

</html>