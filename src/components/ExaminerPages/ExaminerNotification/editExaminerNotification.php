<?php
session_start();

// Ensure the user is logged in, redirect to login page if not
if (!isset($_SESSION['user-email'])) {
    header('Location: ../../AccessPages/login.php');
    exit();
}

// Include the configuration file to establish a database connection
include('../../../php/config.php');

// Check if the request method is POST and 'notification_id' is provided
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['notification_id'])) {
    
    // Retrieve and sanitize inputs
    $notification_id = (int)$_POST['notification_id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Validate inputs
    if ($notification_id > 0 && !empty($name) && !empty($email) && !empty($message)) {
        // Optional: Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Invalid email format.";
            header('Location: ./ExaminerNotification.php');
            exit();
        }

        // Prepare the SQL statement to update the notification
        $query = $conn->prepare("UPDATE notification SET name = ?, email = ?, message = ? WHERE notification_id = ? AND email = ?");
        if ($query) {
            $query->bind_param('sssis', $name, $email, $message, $notification_id, $_SESSION['user-email']);

            // Execute the query and check for success
            if ($query->execute()) {
                if ($query->affected_rows > 0) {
                    $_SESSION['message'] = "Notification updated successfully!";
                } else {
                    $_SESSION['message'] = "No changes made or you do not have permission to update this notification.";
                }
            } else {
                $_SESSION['message'] = "Error updating notification: " . $query->error;
            }

            // Close the prepared statement
            $query->close();
        } else {
            $_SESSION['message'] = "Preparation Error: " . $conn->error;
        }
    } else {
        $_SESSION['message'] = "All fields are required.";
    }

    // Close the database connection
    $conn->close();

    // Redirect back to the notifications page
    header('Location: ./ExaminerNotification.php');
    exit();

} else {
    // Invalid request method or notification_id not set
    $_SESSION['message'] = "Invalid request for editing.";
    header('Location: ./ExaminerNotification.php');
    exit();
}
?>
