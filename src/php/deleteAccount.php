<?php
session_start();

if (!isset($_SESSION['user-email'])) {
    header('Location: ../components/AccessPages/login.php');
    exit();
}

include('./config.php');

// Retrieve the email from the POST request
if (isset($_POST['email'])) {
    $type = $_POST['type'];

    if ($type == "student") {
        $email = $_POST['email'];

        // Prepare the SQL statement to delete the student
        $query = $conn->prepare("DELETE FROM students WHERE email = ?");
        $query->bind_param('s', $email);

        if ($query->execute()) {
            // If delete is successful, destroy the session and redirect to the login page
            session_destroy();
            header('Location:  ../components/AccessPages/login.php');
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else if ($type == "examiner") {
        $email = $_POST['email'];
        $admin = $_POST['is-admin'];
        $id = $_POST['id'];

        if ($id && $admin) {
            // Prepare the SQL statement to delete the student
            $query = $conn->prepare("DELETE FROM examiners WHERE email = ? AND examiner_id = ?");
            $query->bind_param('ss', $email, $id);
        } else {
            // Prepare the SQL statement to delete the student
            $query = $conn->prepare("DELETE FROM examiners WHERE email = ?");
            $query->bind_param('s', $email);
        }

        if ($query->execute()) {
            // If it's an admin, redirect to the same adminExaminers page after deletion, without logging out
            if ($admin == "admin") {
                header('Location:  ../components/AdminPages/AdminExaminers/AdminExaminer.php');
                exit();
            } else {
                // If not an admin, redirect to login (this case might be for examiner self-deletion)
                session_destroy();
                header('Location:  ../components/AccessPages/login.php');
                exit();
            }
        }

        $query->close();
        $conn->close();
    } else {
        echo "No email provided for deletion.";
    }
}
