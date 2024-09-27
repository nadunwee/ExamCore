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

        // Prepare the SQL statement to delete the student
        $query = $conn->prepare("DELETE FROM examiners WHERE email = ?");
        $query->bind_param('s', $email);
  
        if ($query->execute()) {
            // If delete is successful, destroy the session and redirect to the login page
            session_destroy();
            header('Location:  ../components/AccessPages/login.php');
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }

      }

      $query->close();
      $conn->close();
  } else {
      echo "No email provided for deletion.";
  }
?>
