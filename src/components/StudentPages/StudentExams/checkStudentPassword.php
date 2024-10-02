<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user-email'])) {
  header('Location: ../../AccessPages/login.php');
  exit();
}

// Include database configuration
include('../../../php/config.php');

// Check if form data is received via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $examId = $_POST['exam_id'];
  $examPassword = $_POST['passwd'];
  $typedPassword = $_POST['typed-passwd'];

  if ($typedPassword === $examPassword) {
    header("Location: ../StudentExamPaper/studentExamPaper.php");
  } else {
    header("Location: ./studentExamPassword.php");
  }
  // Continue with the logic to display the exam or further processing
} else {
  echo "<script>alert('No exam data received.'); window.location.href='./studentExamPassword.php';</script>";
}
