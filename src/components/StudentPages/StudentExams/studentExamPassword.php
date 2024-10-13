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
  <style>
    body, html {
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    .container {
      text-align: center;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background-color: #ffffff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
      margin-bottom: 20px;
    }

    input[type="text"] {
      padding: 10px;
      margin-bottom: 15px;
      width: 80%;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background-color: #007bff;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body class="container">
  <h1>Enter Exam OTP</h1>
  <br>
  <form action="checkStudentPassword.php" method="POST">
    <input type="text" name="typed-passwd" placeholder="Enter OTP" required />
    <input type="hidden" name="passwd" value="<?php echo htmlspecialchars($examPassword); ?>" />
    <input type="hidden" name="exam_id" value="<?php echo htmlspecialchars($examId); ?>" />
    <input type="submit" value="Submit" />
  </form>
</body>

</html>