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
                header('Location: ./ExaminerNotification.php');
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