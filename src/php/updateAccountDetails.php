<?php
session_start();

if (!isset($_POST['type'])) {
  header('Location:  ../components/StudentPages/StudentProfile/studentProfile.php');
  exit();
}

include('./config.php');

$type = $_POST['type'];
$name = $_POST['name'];
$nic = $_POST['nic'];
$subject = $_POST['subject'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$password = $_POST['password'];
$address = $_POST['address'];
$previus_email = $_POST['previous-email'];
$user_type = $_POST['user-type'];

//check for use case where some values are not updated

if ($type == 'student') {
  $query = $conn->prepare("UPDATE students SET name = ?, nic = ?, email = ?, password = ?, phone_no = ?, gender = ?, dob = ?, address = ? WHERE email = ?");
  $query->bind_param("sssssssss", $name, $nic, $email, $password, $phone, $gender, $dob, $address, $previus_email);


  if ($query->execute()) {
    header('Location: ../components/StudentPages/StudentHome/StudentHome.php');
    session_destroy();
    exit();
  } else {
    echo "Error Updating the record - " . $conn->error;
  }

  $query->close();
  $conn->close();
} else if ($type == 'examiner') {
  $query = $conn->prepare("UPDATE examiners SET name = ?, subject = ?, email = ?, password = ? WHERE email = ?");
  $query->bind_param("sssss", $name, $subject, $email, $password, $previus_email);


  if ($query->execute()) {
    if ($user_type == "admin") {
      header('Location: ../components/AdminPages/AdminExaminers/AdminExaminer.php');
      exit();
    }
    header('Location: ../components/ExaminerPages/ExaminerProfile/examinerProfile.php');
    session_destroy();
    exit();
  } else {
    echo "Error Updating the record - " . $conn->error;
  }
}
