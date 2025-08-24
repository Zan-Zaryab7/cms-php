<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/signup.css">
    <link rel="icon" href="public/images/statue.jpg" type="image/x-icon">
</head>

<body>

    <?php
    if (isset($_POST["client-signup"])) {
        $firstname = trim($_POST["client-firstname"]);
        $lastname = trim($_POST["client-lastname"]);
        $email = trim($_POST["client-email"]);
        $password = $_POST["client-password"];

        include("includes/db.php");

        if ($con) {
            // Check if email already exists
            $stmt = $con->prepare("SELECT client_id FROM client WHERE client_email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo "<div class='alert alert-danger text-center'>Email already used.</div>";
            } else {
                $stmt->close();

                // Insert new client
                $hashedpwd = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $con->prepare(
                    "INSERT INTO client (client_first_name, client_last_name, client_email, client_password) 
                 VALUES (?, ?, ?, ?)"
                );
                $stmt->bind_param("ssss", $firstname, $lastname, $email, $hashedpwd);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    $stmt->close();
                    header("Location: client_login.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger text-center'>Signup failed. Please try again.</div>";
                }
            }
        } else {
            echo "<div class='alert alert-danger text-center'>Database connection error.</div>";
        }
    }
    ?>

    <form action="client_signup.php" method="post" style="border:1px solid #ccc">
        <div class="container">
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
        </div>
    </form>

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