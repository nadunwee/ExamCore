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
        echo "here";
        
        // Retrieve the notification ID from the POST request and sanitize it
        $notification_id = (int)$_POST['notification_id']; // Casting to integer for security

        // Ensure the notification ID is valid
        if ($notification_id > 0) {
            // Prepare the SQL statement to delete the notification
            $query = $conn->prepare("DELETE FROM notification WHERE notification_id = ? AND email = ?");
            if ($query) {
                // Bind the parameters: 'i' for integer and 's' for string
                $query->bind_param('is', $notification_id, $_SESSION['user-email']);
                
                // Execute the query and check for success
                if ($query->execute()) {
                    // Check if any row was actually deleted
                    if ($query->affected_rows > 0) {
                        // Deletion successful
                        $_SESSION['message'] = "Notification deleted successfully!";
                    } else {
                        // No row matched the criteria
                        $_SESSION['message'] = "No matching notification found or you do not have permission to delete this notification.";
                    }
                } else {
                    // Execution failed
                    $_SESSION['message'] = "Error deleting notification: " . $query->error;
                }

                // Close the prepared statement
                $query->close();
            } else {
                // Preparation failed
                $_SESSION['message'] = "Preparation Error: " . $conn->error;
            }
        } else {
            $_SESSION['message'] = "Invalid notification ID.";
        }

        // Close the database connection
        $conn->close();

        // Redirect back to the notifications page
        header('Location: ./ExaminerNotification.php');
        exit();

    } else {
        // Invalid request method or notification_id not set
        $_SESSION['message'] = "Invalid request for deletion.";
        header('Location: ./ExaminerNotification.php');
        exit();
    }
    ?>
