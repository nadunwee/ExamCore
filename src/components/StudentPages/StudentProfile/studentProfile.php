<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user-email'])) {
    header('Location: ../../AccessPages/login.php');
    exit();
}

// Retrieve the session variables
$userEmail = $_SESSION['user-email'];
$userPassword = $_SESSION['user-pswd'];

include('../../../php/config.php');

$query = $conn->prepare("SELECT * FROM students WHERE email = ? AND password = ?");
$query->bind_param('ss', $userEmail, $userPassword);

if ($query->execute()) {
  $result = $query->get_result();

  if ($result->num_rows > 0) {
      $studentData = $result->fetch_assoc();
  } else {
      echo "Invalid login credentials!";
  }
}

$query->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="../../../styles/commonNavbarAndFooterStyles.css"
    />
    <link rel="stylesheet" href="./studentProfile.css" />
    <link rel="stylesheet" href="./studentProfileModel.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <script defer src="./studentProfile.js"></script>
    <title>ExamCore</title>
  </head>

  <body>
    <div id="editModal" class="modal">
      <div class="modal-content">
        <div class="modal-heading">
          <h2>Edit Profile Details</h2>
          <span class="close-btn" onclick="onCloseBtnClick()">&times;</span>
        </div>
        <form>
          <label for="name">Name:</label>
          <input type="text" name="name" value=<?php echo  $studentData['name'] ?> />
          <label for="nic">NIC:</label>
          <input type="text" name="nic" value=<?php echo  $studentData['nic'] ?> />
          <label for="email">Email:</label>
          <input type="email" name="email" value=<?php echo  $studentData['email'] ?> />
          <label for="phone">Phone:</label>
          <input type="text" name="phone" value=<?php echo  $studentData['phone_no'] ?> />
          <label for="dob">gender:</label>
          <select name="gender">
            <option value="none-selected" selected>select</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
          <label for="dob">DOB:</label>
          <input type="date" name="dob" value=<?php echo  $studentData['dob'] ?> />
          <label for="password">Password:</label>
          <input type="password" name="password" value=<?php echo  $studentData['password'] ?> />
          <label for="address">Address:</label>
          <input type="text" name="address" value=<?php echo  $studentData['address'] ?> />
          <button type="submit">Save Changes</button>
        </form>
      </div>
    </div>

    <div class="wrapper">
      <div class="container">
        <aside class="sidebar">
          <h1>ExamCore</h1>
          <ul>
            <li><a href="../StudentHome/StudentHome.html">Home</a></li>
            <li><a href="../studentExam.html">Exams</a></li>
            <li><a href="#">Results</a></li>
            <li>
              <a href="../StudentNotification.html">Notifications</a>
            </li>
          </ul>
          <button class="profile-btn">
            <a href="../StudentProfile/studentProfile.html">Student Profile</a>
          </button>
        </aside>
      </div>
    </div>

    <div class="student-profile-details">
      <div class="student-profile-img">
        <i class="bx bx-user"></i>
        <p class="student-name"><?php echo  $studentData['name'] ?></p>
        <p>user since <?php echo  $studentData['registered_date'] ?></p>
      </div>
      <div class="student-profile-description">
        <div class="student-profile-contact">
          <div class="student-contact-info" onclick="onEditBtnClick()">
            <p>contact information</p>
            <i class="bx bx-edit"></i>
          </div>
          <div class="student-personal-details">
            <div class="student-email student-personal-detail-items">
              <p>Email:</p>
              <?php echo  $studentData['email'] ?>
            </div>
            <div class="student-phoneno student-personal-detail-items">
              <p>phoneno</p>
              <?php echo  $studentData['phone_no'] ?>
            </div>
            <div class="student-gender student-personal-detail-items">
              <p>gender</p>
              <?php echo  $studentData['gender'] ?>
            </div>
            <div class="student-DOB student-personal-detail-items">
              <p>DOB</p>
              <?php echo  $studentData['dob'] ?>
            </div>
            <div class="student-address student-personal-detail-items">
              <p>address</p>
              <?php echo  $studentData['address'] ?>
            </div>
            <div class="delete-account">Delete Account</div>
          </div>
        </div>
        <div class="student-exam-history-info">
          <p>Exam History</p>
          <div class="student-exam-history-item">Exam 1</div>
        </div>
      </div>
    </div>
  </body>
</html>
