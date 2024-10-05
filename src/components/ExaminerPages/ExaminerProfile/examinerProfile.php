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

$query = $conn->prepare("SELECT * FROM examiners WHERE email = ? AND password = ?");
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
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="../../../styles/commonNavbarAndFooterStyles.css" />
  <link rel="stylesheet" href="../../StudentPages/StudentProfile/studentProfile.css" />
  <link rel="stylesheet" href="../../StudentPages/StudentProfile/studentProfileModel.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet" />
  <script defer src="./examinerProfile.js"></script>
  <title>ExamCore</title>
</head>

<body>
  <div id="editModal" class="modal">
    <div class="modal-content">
      <div class="modal-heading">
        <h2>Edit Profile Details</h2>
        <span class="close-btn" onclick="onCloseBtnClick()">&times;</span>
      </div>
      <form action="../../../php/updateAccountDetails.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" value=<?php echo  $studentData['name'] ?> />
        <label for="nic">Subject:</label>
        <input type="text" name="subject" value=<?php echo  $studentData['subject'] ?> />
        <label for="email">Email:</label>
        <input type="email" name="email" value=<?php echo  $studentData['email'] ?> />
        <label for="password">Password:</label>
        <input type="password" name="password" value=<?php echo  $studentData['password'] ?> />
        <input hidden type="text" name="type" value="examiner" />
        <input hidden type="text" name="previus-email" value=<?php echo  $studentData['email'] ?> />
        <button type="submit">Save Changes</button>
      </form>
    </div>
  </div>

  <div class="wrapper">
    <div class="container">
      <aside class="sidebar">
        <h1>ExamCore</h1>
        <ul>
          <li><a href="../examinerHome.php">Home</a></li>
          <li><a href="../ExaminerExam/examinerExam.php">Exams</a></li>
          <li>
            <a href="../ExaminerNotification/notificationProcess.php">Notifications</a>
          </li>
        </ul>
        <button class="profile-btn">
          <a href="#">Examiner Profile</a>
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
          <p>Contact Information</p>
          <i class="bx bx-edit"></i>
        </div>
        <div class="student-personal-details">
          <div class="student-email student-personal-detail-items">
            <p>Email:</p>
            <?php echo  $studentData['email'] ?>
          </div>
          <div class="student-phoneno student-personal-detail-items">
            <p>Subject:</p>
            <?php echo  $studentData['subject'] ?>
          </div>
          <div class="delete-account">
            <form action="../../../php/deleteAccount.php" method="POST">
              <input type="hidden" name="email" value="<?php echo $studentData['email']; ?>" />
              <input type="hidden" name="type" value="examiner" />
              <button type="submit" class="delete-account-btn" id="delete-btn">Delete Account</button>
            </form>
            <button id="logout-btn" class="delete-account-btn" type="button">Log Out</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>