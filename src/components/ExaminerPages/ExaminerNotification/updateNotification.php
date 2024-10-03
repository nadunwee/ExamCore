<?php
session_start();

if (!isset($_SESSION['user-email'])) {
  header('Location: ../../AccessPages/login.php');
  exit();
}

include('../../../php/config.php');

// Check if the form is submitted in edit mode
if ($_POST['edit_mode'] == '1') {
  $notificationId = $_POST['notificationId'];
  $name = $_POST['name'];
  $message = $_POST['message'];
  $email = $_POST['email'];
  $userType = $_POST['user_type'];

  // Prepare and bind the update query
  $query = $conn->prepare("UPDATE notifications SET name = ?, message = ? WHERE notificationId = ? AND email = ? AND user_type = ?");
  $query->bind_param('sssss', $name, $message, $notificationId, $email, $userType);

  if ($query->execute()) {
    $_SESSION['message'] = "Notification updated successfully.";
    header('Location: ./ExaminerNotifications.php');
    exit();
  } else {
    $_SESSION['message'] = "Error: " . $query->error;
  }

  $query->close();
}

$conn->close();
