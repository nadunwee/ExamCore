<?php
  session_start();

  // Check if from data was posted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form Data 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // DB connection
    $conn = new mysqli('localhost', 'root', '', 'exam_core');

    // Check the connection
    if ($conn->connect_error) {
      die('Connection failed : ' .$conn->connect_error);
    }

    // Prepare the sql statement
    $query = $conn->prepare("INSERT INTO notification (name, email, message) VALUES (?, ?, ?)");
    $query->bind_param("sss", $name, $email, $message);

    // Execute the statement
    if ($query->execute()) {
      $_SESSION["message"] = "Notification added";
      header('Location: examinerNotification.php');
    } else {
      $_SESSION['message'] = "Error: " . $query->error;
    }

    // Close statement and connection
    $query->close();
    $conn->close();
    exit();
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/examinerNotification.css">
  <title>Notification</title>
</head>
<body>
  <div class="notification-container">
    <div class="app-navigation">
      <div class="app-logo">
        <a href="./examinerHome.html">ExamCore</a>
      </div>
      <nav class="vertical-nav" class="navbar">
        <ul>
          <li class="nav-item">
            <i class='bx bxs-home'></i>
            <a href="#">Home</a>
          </li>
          <li class="nav-item">
            <i class='bx bxs-book' ></i>
            <a href="#">Exams</a>
          </li>
          <li class="nav-item">
            <i class='bx bx-command'></i>
            <a href="#">Results</a>
          </li>
          <li class="nav-item">
            <i class='bx bxs-bell-ring' ></i>
            <a href="#">Notification</a>
          </li>
        </ul>
      </nav>
      <div class="app-profile">
        <a href="#">Examiner Profile</a>
      </div>
    </div>
    <div class="content-footer">

      <div class="notification-content">
        <h1>Send Notification</h1>
        <form action="http://localhost/quizcore/src/components/ExaminerPages/examinerNotification.php" method="POST">
          <label for="name">Name</label>
          <input type="text" name="name">
          <label for="email">Email</label>
          <input type="text" name="email">
          <label for="message" >Message</label>
          <textarea placeholder="Type Your Message Here..." name="message"></textarea>
          <input type="submit" value="Send" class="send-notification-btn">
        </form>
      </div>
      <footer>
          <p>Copyright © 2024 Website. All rights reserved.</p>
          <a href="#">Terms & Conditions</a> |
          <a href="#">Privacy Policy</a>
      </footer>
    </div>

  </div>

</body>
</html>