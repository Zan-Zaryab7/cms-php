<?php
require_once "includes/sessions.php";
require_once "includes/db.php";

// Fetch lawyer info
$stmt = $con->prepare("SELECT lawyer_first_name, lawyer_last_name, lawyer_email, lawyer_phone_no, lawyer_city, lawyer_address, lawyer_rating, specialization, image_type 
                       FROM lawyer_login WHERE lawyer_id = ?");
$stmt->bind_param('s', $_SESSION['lawyer_id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($fname, $lname, $email, $phone, $city, $address, $rating, $special, $img_type);
$stmt->fetch();

// Handle image upload
require_once "includes/dbpdo.php";
if (isset($_POST['img-submit']) && is_uploaded_file($_FILES['up-image']['tmp_name'])) {
    $img_data = file_get_contents($_FILES['up-image']['tmp_name']);
    $img_type = $_FILES['up-image']['type'];

    $stmt = $conpdo->prepare("UPDATE lawyer_login SET lawyer_image = ?, image_type = ? WHERE lawyer_id = ?");
    $stmt->bindParam(1, $img_data, PDO::PARAM_LOB);
    $stmt->bindParam(2, $img_type);
    $stmt->bindParam(3, $_SESSION['lawyer_id']);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?php echo htmlspecialchars($_SESSION["lawyer_name"]); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/2f7569df82.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <h1><?php echo htmlspecialchars($_SESSION["lawyer_name"]); ?></h1>
                <br>
                <ul id="side_menu" class="nav nav-pills nav-stacked">
                    <li class="active"><a href="lawyer_dashboard.php"><span class="glyphicon glyphicon-comment"></span>
                            Profile</a></li>
                    <li><a href="lawyer_dashboard.php?q=currentcases"><span class="glyphicon glyphicon-list-alt"></span>
                            Current Cases</a></li>
                    <li><a href="lawyer_dashboard.php?q=finishedcases"><span class="glyphicon glyphicon-ok"></span>
                            Finished Cases</a></li>
                    <li><a href="lawyer_dashboard.php?q=managerequests"><span
                                class="glyphicon glyphicon-briefcase"></span> Manage Requests</a></li>
                    <li><a href="lawyer_dashboard.php?q=invoice"><span class="glyphicon glyphicon-credit-card"></span>
                            Your Invoice</a></li>
                </ul>
            </div>

            <div class="col-sm-10">
                <h1>Your Profile</h1>
                <div class="profile_info">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="up-image" required>
                        <input type="submit" name="img-submit" value="Upload">
                    </form>

                    <img src="lawyer/lawyer_profile_image.php?id=<?php echo urlencode($_SESSION["lawyer_id"]); ?>"
                        alt="Profile Image">

                    <p><strong>Name:</strong> <?php echo htmlspecialchars("$fname $lname"); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                    <p><strong>Phone No:</strong>
                        <?php echo $phone ? htmlspecialchars($phone) : "<span class='text-muted'>Not given</span>"; ?>
                    </p>
                    <p><strong>City:</strong>
                        <?php echo $city ? htmlspecialchars($city) : "<span class='text-muted'>Not given</span>"; ?></p>
                    <p><strong>Address:</strong>
                        <?php echo $address ? htmlspecialchars($address) : "<span class='text-muted'>Not given</span>"; ?>
                    </p>
                    <p><strong>Rating:</strong></p>
                    <div class="rating-star">
                        <i class="fas fa-star star1"></i>
                        <i class="fas fa-star star2"></i>
                        <i class="fas fa-star star3"></i>
                        <i class="fas fa-star star4"></i>
                        <i class="fas fa-star star5"></i>
                    </div>

                    <div class="dom-target" style="display:none"><?php echo (int) $rating; ?></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = parseInt(document.querySelector('.dom-target').textContent, 10);
            const starElems = document.querySelectorAll('.rating-star i');

            if (stars === -1) {
                starElems.forEach(s => s.style.color = "grey");
                document.querySelector('.rating-star').innerHTML += " You have not been rated yet";
            } else if (stars === 0) {
                starElems.forEach(s => s.style.color = "white");
            } else {
                for (let i = 0; i < stars; i++) {
                    starElems[i].style.color = "gold";
                }
            }
        });
    </script>
</body>

</html>