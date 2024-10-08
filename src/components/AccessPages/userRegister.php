<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $type = $_POST['types'];
  $admin = $_POST['is-admin'];
  $name = $_POST['real-name'];
  $nic = $_POST['nic'];
  $subject = $_POST['subject'];
  $email = $_POST['email'];
  $passwd = $_POST['password'];
  $confirmPasswd = $_POST['confirm-password'];
  $phone_no = NULL;
  $gender = NULL;
  $dob = NULL;
  $address = NULL;

  // Validate passwords match
  if ($passwd !== $confirmPasswd) {
    $_SESSION['message'] = 'Passwords do not match.';
    header('Location: userRegister.php');
    exit();
  }

  include("../../php/config.php");

  if ($type === "student") {
    $query = $conn->prepare("INSERT INTO students (name, nic, email, password, phone_no, gender, dob, address) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("ssssssss", $name, $nic, $email, $passwd, $phone_no, $gender, $dob, $address);

    if ($query->execute()) {
      $_SESSION['message'] = 'Student registration successful!';
      header('Location: login.php');
    } else {
      $_SESSION['message'] = "Error: " . $query->error;
    }

    $query->close();
  } else if ($type === "examiner") {
    $query = $conn->prepare("INSERT INTO examiners (name, subject, email, password) VALUES (?, ?, ?, ?)");
    $query->bind_param("ssss", $name, $subject, $email, $passwd);

    // Execute the statement
    if ($query->execute()) {
      if ($admin == "admin") {
        header('Location: ../AdminPages/AdminExaminers/AdminExaminer.php');
        exit();
      }
      header('Location: login.php');
    } else {
      $_SESSION['message'] = "Error: " . $query->error;
    }

    // Close statement and connection
    $query->close();
  } else {
    $_SESSION['message'] = "User type not handled.";
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
  <script src="./accessPages.js"></script>
  <title>Registration</title>
</head>

<body onload="toggleFields()">
  <p class="student-register-logo"><a href="../../../homePage.html">ExamCore</a></p>

  <div class="student-register-main-container">
    <div class="signup-methods">
      <span>Sign Up</span>

      <div class="student-email-register">
        <form action="./userRegister.php" method="POST">
          <div class="input-container">
            <label for="type">Sign up As</label>
            <select name="types" id="types" onchange="toggleFields()">
              <option value="student" default>Student</option>
              <option value="examiner">Examiner</option>
            </select>
          </div>

          <div class="input-container">
            <label for="real-name">Name</label>
            <input type="text" id="real-name" name="real-name" class="input-field" placeholder="Enter Your Name..." required />
          </div>

          <div class="input-container" id="nic-field">
            <label for="NIC">NIC</label>
            <input type="text" id="nic" name="nic" class="input-field" placeholder="Enter Your NIC..." onchange="validateNICOnChange()" />
          </div>

          <div class="input-container" id="subject-field" style="display: none;">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" class="input-field" placeholder="Enter Your Subject..." />
          </div>

          <div class="input-container">
            <label for="email">Email <div class="email-reminder" id="email-reminder">*your institute email</div></label>
            <input type="email" id="email" name="email" class="input-field" placeholder="Enter Your Email..." required />
          </div>

          <div class="input-container">
            <label for="password">Password</label>
            <input type="text" id="password" name="password" class="input-field" placeholder="Enter Your Password..." onchange="validatePasswordSize()" required />
            <label id="password-notification" class="danger-notifications" style="display: none;">*Should Have 8 characters</label>
          </div>

          <div class="input-container">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password" class="input-field" placeholder="Confirm Password" required />
          </div>

          <input type="submit" value="Sign up with Email" class="register-submit-btn" onclick="checkPasswords()" />
        </form>

        <section>By continuing with Email, you agree to our Terms of Service and Privacy Policy.</section>
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