<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/examinerNotification.css">
  <title>Notification</title>
</head>
<body>
  <div class="notification-container">
    <div class="app-navigation">
      <div class="app-logo">
        <a href="./examinerHome.html">ExamCore</a>
      </div>
      <nav class="vertical-nav" class="navbar">
        <ul>
          <li class="nav-item">
            <i class='bx bxs-home'></i>
            <a href="#">Home</a>
          </li>
          <li class="nav-item">
            <i class='bx bxs-book' ></i>
            <a href="#">Exams</a>
          </li>
          <li class="nav-item">
            <i class='bx bx-command'></i>
            <a href="#">Results</a>
          </li>
          <li class="nav-item">
            <i class='bx bxs-bell-ring' ></i>
            <a href="#">Notification</a>
          </li>
        </ul>
      </nav>
      <div class="app-profile">
        <a href="#">Examiner Profile</a>
      </div>
    </div>
    <div class="content-footer">

      <div class="notification-content">
        <h1>Send Notification</h1>
        <form action="#" method="post">
          <label for="name">Name</label>
          <input type="text" name="name">
          <label for="email">Email</label>
          <input type="text" name="email">
          <label for="message" >Message</label>
          <textarea placeholder="Type Your Message Here..."></textarea>
          <input type="submit" value="Send" class="send-notification-btn">
        </form>
      </div>
      <footer>
          <p>Copyright © 2024 Website. All rights reserved.</p>
          <a href="#">Terms & Conditions</a> |
          <a href="#">Privacy Policy</a>
      </footer>
    </div>

  </div>

</body>
</html>