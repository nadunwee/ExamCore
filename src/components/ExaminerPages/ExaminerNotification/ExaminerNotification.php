<?php
  session_start();

  // Redirect if session email is not set
  if (!isset($_SESSION['user-email'])) {
    header("Location: ../../AccessPages/login.php");
    exit;
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $notification = $_POST["message"];

    include('../../../php/config.php');

    $query = $conn->prepare("INSERT INTO notification (name, email, message) VALUES (?, ?, ?)");
    $query->bind_param("sss", $name, $email, $notification);

    if ($query->execute()) {
    } else {
    }

    $query->close();
    $conn->close();
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="ExaminerNotification.css">
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
    <title>Examiner Notification</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="../examinerHome.html">Home</a></li>
                    <li><a href="../ExaminerExam/examinerExam.html">Exams</a></li>
                    <li><a href="../ExaminerResult/examierResult.html">Results</a></li>
                    <li><a href="../ExaminerNotification/ExaminerNotification.html">Notifications</a></li>
                </ul>
                <a href="../ExaminerProfile/examinerProfile.html"><button class="profile-btn">Examiner Profile</button></a>
            </aside>
        </div>
        <div class="examiner-notification-container">
            <h1>Examiner Notifications</h1>
            <form method="get" id="examiner-notification-form">
                Name:<input type="text" id="name-input" name="name"/>
                <input type="hidden" id="email-input" name="email" value>
                Message:<input type="text" id="notification-input" name="message" />
                <input type="submit" value="Add Notification" />
            </form>

            <form action="./ExaminerNotification.php" method="POST" id="examiner-notification-form">
                <input type="text" name="name" id="name-input">
                <input type="text" hidden name="email" id="email-input" value="<?php echo $_SESSION['user-email']; ?>">
                <input type="text" name="message" id="notification-input">
                <input type="submit" >
            </form>
            <!--Added notification list should be displayed here-->
        </div>
        <footer class="page-footer">
            <p>Copyright ©️ 2024 ExamCore. All rights reserved. | <a href="#">Terms & Conditions</a> | <a href="#">Privacy Policy</a></p>
        </footer>
        <script src="ExaminerNotification.js"></script>
    </div>
</body>
</html>