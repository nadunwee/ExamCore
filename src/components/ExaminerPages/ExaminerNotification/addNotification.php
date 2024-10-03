<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user-email'])) {
  header('Location: ../../AccessPages/login.php');
  exit();
}

// Retrieve the session variables
$userEmail = $_SESSION['user-email'];

$name = $_POST['name'];
$message = $_POST['message'];
$email = $_POST['email'];
$user_type = $_POST['user_type'];

include('../../../php/config.php');

$query = $conn->prepare("INSERT INTO notifications (name, email, message, user_type) VALUES (?, ?, ?, ?)");
$query->bind_param('ssss', $name, $email, $message, $user_type);

if ($query->execute()) {
  header('Location: ./examinerNotifications.php');
} else {
  $_SESSION['message'] = "Error: " . $query->error;
}

$query->close();
$conn->close();
