<?php

require "admindb.php";

if (isset($_GET["status"])) {
    echo '<script>
    setTimeout(function() {
        alert("' . $_GET["status"] . '");
    }, 1000); </script>';
}

$q1 = "SELECT * FROM `notifications`";
$rs1 = $conn->query($q1);
$n1 = $rs1->num_rows;
// $d1 = $rs1->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Notification</title>
    <link rel="stylesheet" href="AdminNotification.css">
    <link rel="stylesheet" href="commonNavbarAndFooterStyles.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="../AdminHome/adminHome.html">Home</a></li>
                    <li><a href="../AdminExams/adminExam.php">Exams</a></li>
                    <li><a href="../AdminExaminers/AdminExaminer.php">Examiner</a></li>
                    <li><a href="AdminNotifications.php">Notifications</a></li>
                </ul>
                <a href="../AdminProfile/adminProfile.html">
                    <button class="profile-btn">Admin Profile</button>
                </a>
            </aside>
        </div>

        <div class="examiner-notification-container">
            <h1 style="margin-bottom: 30px;">Admin Notifications</h1>

            <!-- Notification Form -->
            <form method="post" class="examiner-notification-form" action="notificationProcess.php">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="name-input" required><br>

                <label for="message">Message:</label>
                <textarea name="message" rows="10" class="name-input" required></textarea><br>
                <center>
                    <input name="create" type="submit" class="btn" value="Add Notification">
                </center>
            </form>
        </div>

        <!-- Added notifications should be displayed here -->
        <div class="examiner-notification-container">

            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Notification</th>
                    <th>Manage</th>
                </tr>
                <?php

                foreach ($rs1 as $data) {
                    ?>
                    <tr>
                        <form action="notificationProcess.php" method="post">
                            <td><input class="name-input" value="<?php echo $data['name']; ?>" name="name" type="text"></td>
                            <td>
                                <input class="name-input" value="<?php echo $data['notificationId']; ?>" name="id" type="hidden">
                                fdl@gmail.com
                            </td>
                            <td>
                                <textarea class="name-input" name="message"><?php echo $data['message']; ?></textarea>
                            </td>
                            <td>
                                <button name="update" type="submit" class="btn">Edit</button>
                                <br><br>
                                <button name="delete" type="submit" class="btn">Delete</button>
                            </td>
                        </form>
                    </tr>
                    <?php
                }

                ?>
            </table>

        </div>

        <footer class="page-footer">
            <p>
                Copyright ©️ 2024 ExamCore.
                All rights reserved. |
                <a href="#">Terms & Conditions</a> |
                <a href="#">Privacy Policy</a>
            </p>
        </footer>
       
    </div>
</body>

</html>