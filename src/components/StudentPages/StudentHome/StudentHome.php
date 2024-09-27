<?php
// Database connection
$conn = new mysqli('localhost', 'username', 'password', 'database_name');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>ExamCore</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./studentHome.css" />
    <link
      rel="stylesheet"
      href="../../../styles/commonNavbarAndFooterStyles.css"
    />
  </head>
  <body>
    <div class="wrapper">
      <div class="container">
        <aside class="sidebar">
          <h1>ExamCore</h1>
          <ul>
            <li><a href="./studentHome.php">Home</a></li>
            <li><a href="../studentExam.html">Exams</a></li>
            <li><a href="../StudentSupport/studentSupport.html">Support</a></li>
            <li><a href="../StudentNotification.html">Notifications</a></li>
          </ul>
          <button class="profile-btn">
            <a href="../StudentProfile/studentProfile.php">Student Profile</a>
          </button>
        </aside>
      </div>
    </div>

    <header>
      <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search" />
        <button>Search</button>
      </div>
    </header>

    <main class="content">
      <section class="most-recent-exams">
        <h2>Most Recent Exams</h2>
        <?php
          // Fetch most recent exams
          $sql = "SELECT exam_name, assigned_examiner, exam_deadline FROM Exams ORDER BY exam_deadline DESC LIMIT 5";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // Output data of each row
              while ($row = $result->fetch_assoc()) {
                  echo "<p><strong>Exam Name:</strong> " . $row["exam_name"] . "<br>";
                  echo "<strong>Assigned Examiner:</strong> " . $row["assigned_examiner"] . "<br>";
                  echo "<strong>Deadline:</strong> " . $row["exam_deadline"] . "</p><hr>";
              }
          } else {
              echo "<p>No recent exams available.</p>";
          }
        ?>
      </section>

      <section class="notifications">
        <h2>Notifications</h2>
        <?php
          // Fetch most recent notifications
          $sql = "SELECT name, message, date FROM notification ORDER BY date DESC LIMIT 5";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // Output data of each row
              while ($row = $result->fetch_assoc()) {
                  echo "<p><strong>From:</strong> " . $row["name"] . "<br>";
                  echo "<strong>Message:</strong> " . $row["message"] . "<br>";
                  echo "<strong>Date:</strong> " . $row["date"] . "</p><hr>";
              }
          } else {
              echo "<p>No notifications available.</p>";
          }

          // Close the connection
          $conn->close();
        ?>
      </section>
    </main>

    <footer class="page-footer">
      <p>
        Copyright ©️ 2024 ExamCore. All rights reserved. |
        <a href="#">Terms & Conditions</a> | <a href="#">Privacy Policy</a>
      </p>
    </footer>
  </body>
</html>
