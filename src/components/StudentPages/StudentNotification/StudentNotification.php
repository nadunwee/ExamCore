<?php

require "studentdb.php";

if (isset($_GET["status"])) {
    echo '<script>
    setTimeout(function() {
        alert("' . $_GET["status"] . '");
    }, 1000); </script>';
}

$q1 = "SELECT * FROM `notifications`";
$rs1 = $conn->query($q1);
$n1 = $rs1->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Student Notifications</title>
    <link rel="stylesheet" href="./studentNotification.css">
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="../StudentHome/StudentHome.php">Home</a></li>
                    <li><a href="../StudentExams/studentExam.php">Exams</a></li>
                    <li><a href="../StudentSupport/studentSupport.html">Support</a></li>
                    <li><a href="#">Notifications</a></li>
                </ul>
                <a href="../StudentProfile/studentProfile.php">
                    <button class="profile-btn">Student Profile</button>
                </a>
            </aside>
        </div>

        <!-- Added notifications should be displayed here -->
        <div class="examiner-notification-container">
            <h1 style="margin-bottom: 30px; color: #761C73;">Student Notifications</h1>

            <table>
                <tr>
                    <th>Student Name</th>
                    <th>Notification</th>
                </tr>
                <?php

                foreach ($rs1 as $data) {
                ?>
                    <tr>
                        <form action="notificationProcess.php" method="post">
                            <td><?php echo $data['name']; ?></td>
                            
                            <td>
                                <?php echo $data['message']; ?>
                            </td>
                        </form>
                    </tr>
                <?php
                }

                ?>
            </table>

            </div>
            <footer style="margin-top: 30%;" class="page-footer">
            <p>
                Copyright ©️ 2024 ExamCore.
                All rights reserved. |
                <a href="../../../../terms&conditions.html">Terms & Conditions</a> |
                <a href="../../../../privacyPolicy.html">Privacy Policy</a>
            </p>
        </footer>
        
    </div>
</body>

</html>