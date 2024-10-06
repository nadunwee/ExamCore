<?php
session_start();

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
  // $typedPassword = $_POST['typed-passwd'];

  // Use the retrieved data for validation or other processing
  // Example: Fetch exam details from the database or validate the exam password

  // Redirect to the exam or process as needed
  // echo "Exam ID: " . htmlspecialchars($examId) . "<br>";
  // echo "Exam Password: " . htmlspecialchars($examPassword) . "<br>";

  // if ($typedPassword === $examPassword) {
  //   header("Location: ./studentExam.php");
  // }
  // Continue with the logic to display the exam or further processing
} else {
  header("Location: studentExam.php?error=wrongpassword");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <title>Exam OTP</title>
</head>

<body>
  <h1>Enter Exam OTP</h1>
  <form action="checkStudentPassword.php" method="POST">
    <input type="text" name="typed-passwd" placeholder="Enter OTP" required />
    <input type="hidden" name="passwd" value="<?php echo htmlspecialchars($examPassword); ?>" />
    <input type="hidden" name="exam_id" value="<?php echo htmlspecialchars($examId); ?>" />
    <input type="submit" value="Submit" />
  </form>
</body>

</html>