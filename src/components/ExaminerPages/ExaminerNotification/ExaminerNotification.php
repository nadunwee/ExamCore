<?php
  session_start();

  if (!isset($_SESSION['user-email'])) {
    header('Location: ../../AccessPages/login.php');
    exit();
  }

  $userEmail = $_SESSION['user-email'];

  include('../../../php/config.php');

  $query = $conn->prepare("SELECT * FROM notification WHERE email = ?");
  $query->bind_param('s', $userEmail);

  if ($query->execute()) {
    $result = $query->get_result();
  }

  $query->close();
  $conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examiner Notification</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="ExaminerNotification.css">
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="../examinerHome.html">Home</a></li>
                    <li><a href="../ExaminerExam/examinerExam.html">Exams</a></li>
                    <li><a href="../ExaminerResult/examinerResult.html">Results</a></li>
                    <li><a href="../ExaminerNotification/ExaminerNotification.php">Notifications</a></li>
                </ul>
                <a href="../ExaminerProfile/examinerProfile.html">
                    <button class="profile-btn">Examiner Profile</button>
                </a>
            </aside>
        </div>
        
        <div class="examiner-notification-container">
            <h1>Examiner Notifications</h1>

            <!-- Notification Form -->
            <form method="POST" class="examiner-notification-form" action="./addExaminerNotification.php">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="name-input" required><br>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="email-input" required><br>

                <label for="message">Message:</label>
                <textarea name="message" id="message" class="message-input" required></textarea><br>
                <center>
                <input type="submit" class="button" value="Add Notification">
                </center>
            </form>
        </div>    

        <!--Added notifications should be displayed here-->

        <div class="added-notification-list">
                <ul id="list-notification">
                <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <div class="Added-name">
                        <p>Name:</p>
                        <?php echo htmlspecialchars($row['name']); ?>
                    </div>

                    <div class="Added-mail">
                        <p>E-mail:</p>
                        <?php echo htmlspecialchars($row['email']); ?>
                    </div>

                    <div class="Added-message">
                        <p>Notification:</p>
                        <?php echo htmlspecialchars($row['message']); ?>
                    </div>

                    <button class="button" onclick="location.href='editNotification.php?id=<?php echo $row['id']; ?>'">Edit</button>
                    <button class="button" onclick="if(confirm('Are you sure you want to delete this notification?')) location.href='deleteNotification.php?id=<?php echo $row['id']; ?>'">Delete</button>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>No notifications found.</li>
        <?php endif; ?>

                      
                </ul>
                
        </div>

                 
        <footer class="page-footer">
            <p>
                Copyright ©️ 2024 ExamCore.
                All rights reserved. | 
                <a href="#">Terms & Conditions</a> | 
                <a href="#">Privacy Policy</a>
            </p>
        </footer>
        <script src="ExaminerNotification.js"></script>
    </div>
</body>
</html>