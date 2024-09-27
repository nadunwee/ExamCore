<?php
// Start session to store messages
session_start();

// Establish a connection to the database
$conn = new mysqli('localhost', 'root', '', 'exam_core');

// Check if the connection was successful
if ($conn->connect_error) {
    die('Connection Error: ' . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve and sanitize form inputs
    // It's good practice to trim inputs and use more robust sanitization
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $notification = trim($_POST["message"]);

    // Optional: Add server-side validation
    if (empty($name) || empty($email) || empty($notification)) {
        $_SESSION['message'] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format.";
    } else {
        // Prepare and bind
        $query = $conn->prepare("INSERT INTO notification (name, email, message) VALUES (?, ?, ?)");
        if ($query) {
            $query->bind_param("sss", $name, $email, $notification);

            // Execute the query and handle errors
            if ($query->execute()) {
                $_SESSION['message'] = "Notification added successfully!";
            } else {
                $_SESSION['message'] = "Execution Error: " . $query->error;
            }
            // Close the prepared statement
            $query->close();
        } else {
            $_SESSION['message'] = "Preparation Error: " . $conn->error;
        }
    }

    // Redirect to the same page to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Close the database connection
$conn->close();

// Retrieve message from session if exists
$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    // Unset the message after displaying it
    unset($_SESSION['message']);
}
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

            <!-- Display Message -->
            <?php if (!empty($message)): ?>
                <div class="message">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <!-- Notification Form -->
            <form method="POST" class="examiner-notification-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="name-input" required><br>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="email-input" required><br>

                <label for="message">Message:</label>
                <textarea name="message" id="message" class="message-input" required></textarea><br>

                <input type="submit" value="Add Notification">
            </form>
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