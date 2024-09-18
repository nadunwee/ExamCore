<?php
  session_start();

  // Check if form data was posted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $type = $_POST['types'];
    $email = $_POST['email'];
    $passwd = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'exam_core');

    // Check connection
    if ($conn->connect_error) {
      die('Connection Failed: ' . $conn->connect_error);
    }

    // Prepare the SQL statement based on user type
    if ($type === "student") {
      // Prepare the SQL query to check if the email and password exist
      $query = $conn->prepare("SELECT * FROM students WHERE email = ? AND password = ?");
      $query->bind_param("ss", $email, $passwd);

      // Execute the statement
      if ($query->execute()) {
          // Get the result set
          $result = $query->get_result();

          // Check if the user exists (i.e., at least one row was returned)
          if ($result->num_rows > 0) {
              $_SESSION['message'] = 'Student login successful!';
              header('Location: ../StudentPages/StudentHome.html'); // Redirect only if credentials are found
              exit();
          } else {
              // No matching record found
              $_SESSION['message'] = 'Invalid email or password.';
          }
      } else {
          $_SESSION['message'] = "Error: " . $query->error;
      }

      // Close statement and connection
      $query->close();

    } else if ($type === "examiner") {
      // Prepare the SQL query to check if the email and password exist
      $query = $conn->prepare("SELECT * FROM examiners WHERE email = ? AND password = ?");
      $query->bind_param("ss", $email, $passwd);

      // Execute the statement
      if ($query->execute()) {
          // Get the result set
          $result = $query->get_result();

          // Check if the user exists (i.e., at least one row was returned)
          if ($result->num_rows > 0) {
              $_SESSION['message'] = 'Examiner login successful!';
              header('Location: ../ExaminerPages/examinerHome.html'); // Redirect only if credentials are found
              exit();
          } else {
              // No matching record found
              $_SESSION['message'] = 'Invalid email or password.';
          }
      } else {
          $_SESSION['message'] = "Error: " . $query->error;
      }

      // Close statement and connection
      $query->close();
      
    } else {
      $_SESSION['message'] = "User type not handled.";
    }

    $conn->close();

    // Redirect to avoid form resubmission on refresh
    
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
            <form action="http://localhost/quizcore/src/components/accesspages/login.php" method="POST">
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

              <input type="submit" value="Sign up with Email" class="register-submit-btn" />
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
