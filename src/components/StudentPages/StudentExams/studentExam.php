<?php
  session_start();

  // Check if the user is logged in
  if (!isset($_SESSION['user-email'])) {
      header('Location: ../../AccessPages/login.php');
      exit();
  }

  // Retrieve the session variables
  $userEmail = $_SESSION['user-email'];
  $userPassword = $_SESSION['user-pswd'];

  include('../../../php/config.php');

  $query = $conn->prepare("SELECT * FROM students WHERE email = ? AND password = ?");
  $query->bind_param('ss', $userEmail, $userPassword);

  if ($query->execute()) {
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $studentData = $result->fetch_assoc();
    } else {
        echo "Invalid login credentials!";
    }
  }

  $query->close();

  $examQuery = $conn->prepare("SELECT * FROM Exams");

  if ($examQuery->execute()) {
    $availableExamsResult = $examQuery->get_result();
  } else {
    echo "Failed to retrieve exams.";
  }

  $examQuery->close();

  $conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExamCore</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="studentExamWithOTP.css">
    <link rel="stylesheet" href="./studentExam.css">
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="#">Exams</a></li>
                    <li><a href="../StudentSupport/studentSupport.html">Support</a></li>
                    <li><a href="./StudentNotification.php">Notifications</a></li>
                </ul>
                <button class="profile-btn">
                    <a href="./StudentProfile/studentProfile.php">Student Profile</a>
                </button>
            </aside>
        </div>
    </div>
    <main class="content">
        <div class="header">
            <h1>Welcome Back, <?php echo $studentData['name'] ?></h1>
            
            <div class="search-bar">
                <input type="text" placeholder="Search Exam">
                <button>Search</button>
            </div>
        </div>

        
        <h2>Available Exams</h2>
        <!-- Display available exams -->
        <ul class="exam-list" id="available-exams">
        <?php
            if ($availableExamsResult->num_rows > 0) {
                while ($row = $availableExamsResult->fetch_assoc()) {
                    echo '<li><input type="checkbox" class="exam-checkbox" data-exam="'.htmlspecialchars($row['exam_name']).'"> ' . htmlspecialchars($row['exam_name']) . '</li>';
                }
            } else {
                echo '<li>No available exams at the moment.</li>';
            }
            ?>
        </ul>

        <h2>Completed Exams</h2>
        <!-- Display completed exams -->
        <ul class="exam-list">
            <?php
            if ($completedExamsResult->num_rows > 0) {
                while ($row = $completedExamsResult->fetch_assoc()) {
                    echo '<li><input type="checkbox" checked> ' . htmlspecialchars($row['exam_name']) . '</li>';
                }
            } else {
                echo '<li>No completed exams found.</li>';
            }

            // Close the prepared statements and connection
            $availableExamsQuery->close();
            $completedExamsQuery->close();
            $conn->close();
            ?>
        </ul>

        
    </main>

    <!-- OTP Popup -->
    <div id="otp-overlay"></div>
    <div id="otp-popup">
        <h3 id="popup-title">Enter OTP </h3>
        <input type="text" id="otp-input" placeholder="OTP">
        <label><input type="checkbox" id="terms-checkbox"> I accept the terms and conditions</label>
        <button id="submit-button">Submit</button>
        <div id="error-message"></div>
    </div>

    <footer class="page-footer">
        <p>Copyright ©️ 2024 ExamCore. All rights reserved. | <a href="#">Terms & Conditions</a> | <a href="#">Privacy Policy</a></p>
    </footer>

    <script src="http://localhost/Group%20project/ExamCore/src/components/StudentPages/studentExamPageWithOTP.js"></script>
</body>

</html>