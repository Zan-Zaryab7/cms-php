<?php
include("includes/session.php");
include("includes/db.php");

if (isset($_POST["feedback"])) {
    $name = trim($_POST["name"]);
    $feedback = trim($_POST["comment"]);
    $experience = $_POST["experience"] ?? null;

    if ($con && !empty($feedback) && !empty($name)) {
        $stmt = $con->prepare("
            INSERT INTO feedbacks (feedback_content, user_name, experience) 
            VALUES (?, ?, ?)
        ");
        $stmt->bind_param('sss', $feedback, $name, $experience);
        $stmt->execute();

        if ($stmt->affected_rows === -1) {
            echo "Error submitting feedback.";
        } else {
            $stmt->close();
            echo "Feedback submitted successfully.";
        }
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <h1><?php echo htmlspecialchars($_SESSION["client_name"] ?? ""); ?></h1>
            <br>
            <ul id="side_menu" class="nav nav-pills nav-stacked">
                <li><a href="client_dashboard.php"><span class="glyphicon glyphicon-user"></span>&nbsp; Profile</a></li>
                <li><a href="client_dashboard.php?q=addcase"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;
                        Add case</a></li>
                <li class="active"><a href="client_dashboard.php?q=sendfeedback"><span
                            class="glyphicon glyphicon-comment"></span>&nbsp; Send Feedback</a></li>
                <li><a href="client_dashboard.php?q=currentcase"><span class="glyphicon glyphicon-ok"></span>&nbsp;
                        Current Case Info</a></li>
                <li><a href="client_dashboard.php?q=notifications"><span
                            class="glyphicon glyphicon-bullhorn"></span>&nbsp; Notifications</a></li>
            </ul>
        </div>

        <div class="col-sm-10">
            <h1>Feedback</h1>
            <form method="post" action="client_dashboard.php?q=sendfeedback">
                <div class="form-group">
                    <label for="name">* Your Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name"
                        required>
                </div>

                <div class="form-group">
                    <label>* How do you rate your overall experience?</label>
                    <p>
                        <label class="radio-inline"><input type="radio" name="experience" value="Worst"> Worst</label>
                        <label class="radio-inline"><input type="radio" name="experience" value="Bad"> Bad</label>
                        <label class="radio-inline"><input type="radio" name="experience" value="Average">
                            Average</label>
                        <label class="radio-inline"><input type="radio" name="experience" value="Good"> Good</label>
                        <label class="radio-inline"><input type="radio" name="experience" value="Excellent">
                            Excellent</label>
                    </p>
                </div>

                <div class="form-group">
                    <label for="comment">* Comments:</label>
                    <textarea class="form-control" name="comment" id="comment"
                        placeholder="Please enter your suggestions" maxlength="6000" rows="7" required></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" name="feedback" class="btn btn-lg btn-primary btn-block">Send
                        Feedback</button>
                </div>
            </form>
        </div>
    </div>
</div>