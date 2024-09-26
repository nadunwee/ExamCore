<?php
  session_start();

  //Establish a connection to database
  $conn = new mysqli('localhost', 'root', '', 'exam_core');

  // Check if the connection was successful
  if ($conn->connect_error) {
      die('Connection Error: ' . $conn->connect_error);
  }

  

  // Handle form submission
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
      $name = $_POST["name"];
      $email = $_POST["email"];
      $notification = $_POST["message"];

      $query = $conn->prepare("INSERT INTO notification (name, email, message) VALUES (?, ?, ?)");
        
 // Check if the query preparation was successful
    if ($query === false) {
        die("SQL Error: " . $conn->error);  // Output detailed error if prepare fails
    }
// Bind the parameters

      $query->bind_param("sss", $name, $email, $notification);

      if ($query->execute()) {
          
      } else {
         
      }

      // Close the query object (not the connection)
      $query->close();
  }

  // Fetch the notifications after insertion
  //$result = $conn->query("SELECT name, email, message, date FROM notification ORDER BY date DESC");

  // Close the connection after fetching the data
  $conn->close();
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
            <form method="post" id="examiner-notification-form" action="ExaminerNotification.php">
                Name:<input type="text" id="name-input" name="name" placeholder="Enter name" required>
                E-mail:<input type="email" id="email-input" name="email" placeholder="Enter email" required>
                Message:<input type="text" id="notification-input" name="message" placeholder="Enter notification" required>
                <input type="submit" value="Add Notification">
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
