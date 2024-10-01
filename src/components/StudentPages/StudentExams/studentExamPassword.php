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
  $examPassword = $_POST['exam_password'];
  $typedPassword = $_POST['typed-passwd'];

  // Use the retrieved data for validation or other processing
  // Example: Fetch exam details from the database or validate the exam password

  // Redirect to the exam or process as needed
  echo "Exam ID: " . htmlspecialchars($examId) . "<br>";
  echo "Exam Password: " . htmlspecialchars($examPassword) . "<br>";

  if ($typedPassword === $examPassword) {
    header("Location: ./studentExam.php");
  }
  // Continue with the logic to display the exam or further processing
} else {
  echo "No exam data received.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Exam OTP</title>
</head>

<body>
  <h1>Enter Exam OTP</h1>
  <form action="./checkStudentPassword.php" method="POST">
    <input type="text" name="typed-passwd" placeholder="Enter OTP" required />
    <input type="hidden" name="passwd" value="<?php echo htmlspecialchars($examPassword); ?>" />
    <input type="hidden" name="exam_id" value="<?php echo htmlspecialchars($examId); ?>" />
    <input type="submit" value="Submit" />
  </form>
</body>

</html>