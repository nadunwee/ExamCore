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
// $d1 = $rs1->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Notifications</title>
    <link rel="stylesheet" href="./ExaminerNotification.css">
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
                    <!-- <th>Examiner Email</th> -->
                    <th>Notification</th>
                </tr>
                <?php

                foreach ($rs1 as $data) {
                ?>
                    <tr>
                        <form action="notificationProcess.php" method="post">
                            <td><?php echo $data['name']; ?></td>
                            <!-- <td>
                                fdl@gmail.com
                            </td> -->
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

    </div>
</body>

</html>