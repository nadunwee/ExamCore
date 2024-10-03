<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $type = $_POST['types'];
  $email = $_POST['email'];
  $passwd = $_POST['password'];

  include("../../php/config.php");

  if ($type === "student") {
    $query = $conn->prepare("SELECT * FROM students WHERE email = ? AND password = ?");
    $query->bind_param("ss", $email, $passwd);

    if ($query->execute()) {
      $result = $query->get_result();

      if ($result->num_rows > 0) {
        $_SESSION['user-email'] = "$email";
        $_SESSION['user-pswd'] = "$passwd";
        header('Location: ../StudentPages/StudentExams/studentExam.php');
        exit();
      } else {
        echo "<h1>no account found</h1>"; // Implement Error Page
      }
    } else {
      echo "Error : $query->error";
    }

    $query->close();
  } else if ($type === "examiner") {
    $query = $conn->prepare("SELECT * FROM examiners WHERE email = ? AND password = ?");
    $query->bind_param("ss", $email, $passwd);

    if ($query->execute()) {
      $result = $query->get_result();

      if ($result->num_rows > 0) {
        $_SESSION['user-email'] = "$email";
        $_SESSION['user-pswd'] = "$passwd";
        header('Location: ../ExaminerPages/examinerHome.php');
        exit();
      } else {
        echo "<h1>no account found</h1>"; // Implement Error Page
      }
    } else {
      echo "Error : $query->error";
    }

    $query->close();
  } else if ($type === "admin") {
    $query = $conn->prepare("SELECT * FROM admin WHERE admin_id = ? AND password = ?");
    $query->bind_param("ss", $email, $passwd);

    if ($query->execute()) {
      $result = $query->get_result();

      if ($result->num_rows > 0) {
        $_SESSION['user-email'] = "$email";
        $_SESSION['user-pswd'] = "$passwd";
        header('Location: ../AdminPages/AdminHome/adminHome.html');
        exit();
      } else {
        echo "<h1>no account found</h1>"; // Implement Error Page
      }
    } else {
      echo "Error : $query->error";
    }

    $query->close();
  } else {
    echo "Invalid User type";
  }

  $conn->close();
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
  <link rel="stylesheet" href="../../styles/register.css" />
  <link rel="stylesheet" href="../../styles/login.css" />
  <title>Log in</title>
</head>

<body>
  <p class="student-register-logo"><a href="../../../homePage.html">ExamCore</a></p>

  <div class="student-register-main-container">
    <div class="signup-methods">
      <span>Log in</span>

      <div class="social-logins">
        <div class="social-login-btn">
          <img src="../../Images/google.png" alt="" srcset="">
          <p>Continue with Google</p>
        </div>
        <div class="social-login-btn">
          <img src="../../Images/facebook.png" alt="" srcset="">
          <p>Continue with Facebook</p>
        </div>
        <div class="social-login-btn">
          <img src="../../Images/apple-logo.png" alt="" srcset="">
          <p>Continue with Apple</p>
        </div>
      </div>

      <div class="student-email-register">
        <form action="login.php" method="POST">
          <div class="input-container">
            <label for="type">Log in As</label>
            <select name="types" id="types">
              <option value="student" default>Student</option>
              <option value="examiner">Examiner</option>
              <option value="admin">Administrator</option>
            </select>
          </div>

          <div class="input-container">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="input-field" placeholder="Enter Your Email..." required />
          </div>

          <div class="input-container">
            <label for="password">Password</label>
            <input type="text" id="password" name="password" class="input-field" placeholder="Enter Your Password..." required />
          </div>

          <input type="submit" value="Sign In with Email" class="register-submit-btn" />
        </form>

        <section>By continuing with Google, Apple, or Email, you agree to our Terms of Service and Privacy Policy.</section>
      </div>

      <hr>

      <div class="student-register-redirect-login">Don't have an account? <a href="./userRegister.php"><u>Go to Sign up</u></a></div>
    </div>

    <div class="login-imgs">
      <section>
        <img src="../../Images/password-forgot.png" alt="Team">
      </section>
    </div>

  </div>
</body>

</html>