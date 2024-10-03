<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user-email'])) {
  header('Location: ../../AccessPages/login.php');
  exit();
}

// Retrieve the session variables
$userEmail = $_SESSION['user-email'];


$email = $_POST['email'];
$notificationId = $_POST['notificationId'];

include('../../../php/config.php');

$query = $conn->prepare("DELETE FROM notifications WHERE email = ? AND notificationId = ?");
$query->bind_param('ss', $email, $notificationId);

if ($query->execute()) {
  header('Location: ./examinerNotifications.php');
} else {
  $_SESSION['message'] = "Error: " . $query->error;
}

$query->close();
$conn->close();
