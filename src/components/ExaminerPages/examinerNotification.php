<?php
  session_start();

  //Establish a connection to database
  $conn = new mysqli('localhost', 'root', '', 'exam_core');

  // Check if the connection was successful
  if ($conn->connect_error) {
      die('Connection Error: ' . $conn->connect_error);
  }

  $message = ''; // Feedback message

  // Handle form submission
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
      $name = $_POST["name"];
      $email = $_POST["email"];
      $notification = $_POST["message"];

      $query = $conn->prepare("INSERT INTO notification (name, email, message) VALUES (?, ?, ?)");
      $query->bind_param("sss", $name, $email, $notification);

      if ($query->execute()) {
          $message = "Notification added successfully!";
      } else {
          $message = "Execution Error: " . $query->error;
      }

      // Close the query object (not the connection)
      $query->close();
  }

  // Fetch the notifications after insertion
  $result = $conn->query("SELECT name, email, message, date FROM notification ORDER BY date DESC");

  // Close the connection after fetching the data
  $conn->close();
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
        <a href="../../../homePage.html">ExamCore</a>
      </div>
      <nav class="vertical-nav" class="navbar">
        <ul>
          <li class="nav-item">
            <i class='bx bxs-home'></i>
            <a href="./examinerHome.html">Home</a>
          </li>
          <li class="nav-item">
            <i class='bx bxs-book' ></i>
            <a href="./ExaminerExam/examinerExam.html">Exams</a>
          </li>
          <li class="nav-item">
            <i class='bx bx-command'></i>
            <a href="./ExaminerResult/examierResult.html">Results</a>
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