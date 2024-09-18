<?php
  session_start();

  // Check if form data was posted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $type = $_POST['types'];
    $name = $_POST['real-name'];
    $nic = $_POST['nic'];
    $email = $_POST['email'];
    $passwd = $_POST['password'];
    $confirmPasswd = $_POST['confirm-password'];

    // Validate passwords match
    if ($passwd !== $confirmPasswd) {
      $_SESSION['message'] = 'Passwords do not match.';
      header('Location: userRegister.php');
      exit();
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'exam_core');

    // Check connection
    if ($conn->connect_error) {
      die('Connection Failed: ' . $conn->connect_error);
    }

    // Prepare the SQL statement
    if ($type === "student") {
      $quary = $conn->prepare("INSERT INTO students (name, nic, email, password) VALUES (?, ?, ?, ?)");
      $quary->bind_param("ssss", $name, $nic, $email, $passwd);

      // Execute the statement
      if ($quary->execute()) {
        $_SESSION['message'] = 'Registration successful!';
      } else {
        $_SESSION['message'] = "Error: " . $quary->error;
      }

      // Close statement and connection
      $quary->close();
    } else if ($type === "examiner") {
      $quary = $conn->prepare("INSERT INTO examiners (name, nic, email, password) VALUES (?, ?, ?, ?)");
      $quary->bind_param("ssss", $name, $nic, $email, $passwd);

      // Execute the statement
      if ($quary->execute()) {
        $_SESSION['message'] = 'Registration successful!';
      } else {
        $_SESSION['message'] = "Error: " . $quary->error;
      }

      // Close statement and connection
      $quary->close();

    } else {
      $_SESSION['message'] = "User type not handled.";
    }

    $conn->close();

    // Redirect to avoid form resubmission on refresh
    header('Location: userRegister.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../styles/studentRegister.css" />
    <title>Registration</title>
  </head>
  <body>
    <p class="student-register-logo"><a href="../../../homePage.html">ExamCore</a></p>

    <div class="student-register-main-container">
        <div class="signup-methods">
          <span>Sign Up</span>

          <div class="student-email-register">
            <form action="http://localhost/quizcore/src/components/accesspages/userRegister.php" method="POST">
              <div class="input-container">
                <label for="type">Sign up As</label>
                <select name="types" id="types">
                  <option value="student" default>Student</option>
                  <option value="examiner">Examiner</option>
                </select>
              </div>

              <div class="input-container">
                <label for="real-name">Name</label>
                <input type="text" id="real-name" name="real-name" class="input-field" placeholder="Enter Your Name..." required />
              </div>

              <div class="input-container">
                <label for="NIC">NIC</label>
                <input type="text" id="nic" name="nic" class="input-field" placeholder="Enter Your NIC..." required />
              </div>

              <div class="input-container">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="input-field" placeholder="Enter Your Email..." required />
              </div>

              <div class="input-container">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" class="input-field" placeholder="Enter Your Password..." required />
              </div>

              <div class="input-container">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" class="input-field" placeholder="Confirm Password" required />
              </div>

              <input type="submit" value="Sign up with Email" class="register-submit-btn" />
            </form>

            <section>By continuing with Google, Apple, or Email, you agree to our Terms of Service and Privacy Policy.</section>
          </div>

          <hr>

          <div class="student-register-redirect-login">Already signed up? <a href="./login.php"><u>Go to login</u></a></div>
        </div>

        <div class="signup-convincing-imgs">
          <section>
            <img src="../../Images/exam-paper.png" alt="Exam Paper">
            <p>Efficient exam management solutions <br> for institutions.</p>
          </section>
          <section>
            <img src="../../Images/medal-img-reg.png" alt="Medal">
            <p>Recognized for excellence <br> in delivering educational services.</p>
          </section>
          <section>
            <img src="../../Images/teacher.png" alt="Teacher">
            <p>Supporting educators in enhancing <br> their teaching methodologies.</p>
          </section>
          <section>
            <img src="../../Images/team.png" alt="Team">
            <p>Empowering teams to collaborate <br> and achieve their goals.</p>
          </section>
        </div>
        
    </div>
  </body>
</html>
