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
        header('Location: ../StudentPages/StudentHome/studentHome.php');
        exit();
      } else {
        header('Location: login.php?error=invalid');
        exit();
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
        header('Location: login.php?error=invalid');
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
        header('Location: ../AdminPages/AdminHome/adminHome.php');
        exit();
      } else {
        exit();
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
    <link
    href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="../../styles/register.css" />
  <link rel="stylesheet" href="../../styles/login.css" />
  <script>
    // display the error message if the URL contains an error flag
    window.onload = function() {
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('error') && urlParams.get('error') === 'invalid') {
        document.getElementById('error-msg').style.display = 'block';
      }
    };
  </script>
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
            <div class="password-wrapper">
              <input type="password" id="password" name="password" class="input-field" placeholder="Enter Your Password..." required />
              <span id="togglePassword" class="eye-icon">
                <i class='bx bx-low-vision' id="eyeIcon" ></i>
              </span>
            </div>
            <label style="display: none; color: red;" id="error-msg">*wrong username or password</label>
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
        <img id="slideshow-image" src="../../Images/password-forgot.png" alt="Team" />
      </section>
    </div>

    <script>
      const images = [
        "../../Images/password-forgot.png",
        "../../Images/log-in.png",
        "../../Images/login.png"
      ];

      let currentIndex = 0;

      const imgElement = document.getElementById('slideshow-image');

      // Function to change the image source
      function changeImage() {
        currentIndex = (currentIndex + 1) % images.length; // Cycle through images
        imgElement.src = images[currentIndex]; // Set new image src
      }

      setInterval(changeImage, 3000);

      const togglePassword = document.querySelector('#togglePassword');
      const passwordInput = document.querySelector('#password');
      const eyeIcon = document.querySelector('#eyeIcon');

      togglePassword.addEventListener('click', function() {
        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the eye icon
        eyeIcon.src = type === 'password' ? '../../Images/eye-icon.png' : '../../Images/eye-slash-icon.png'; // Update this with the correct path for eye open/closed icons
      });
    </script>

  </div>
</body>

</html>