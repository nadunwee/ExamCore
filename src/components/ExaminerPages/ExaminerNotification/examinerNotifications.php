  <?php

require "db.php";

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
    <title>Examiner Notification</title>
    <link rel="stylesheet" href="ExaminerNotification.css">
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">

    <script>
    function validateForm() {
        var name = document.getElementById("name").value;
        var message = document.getElementsByName("message")[0].value;
        
        if (name.length < 2 || name.length > 20) {
            alert("Name must be between 2 and 20 characters");
            return false;
        }
        
        if (message.length < 3 || message.length > 500) {
            alert("Message must be between 3 and 500 characters");
            return false;
        }
        return true; 
    }
    
    function confirmDelete() {
            return confirm("Are you sure you want to delete this notification?");
        }
</script>
    
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="../examinerHome.php">Home</a></li>
                    <li><a href="../ExaminerExam/examinerExam.php">Exams</a></li>
                    <li><a href="#">Notifications</a></li>

                </ul>
                <a href="../ExaminerProfile/examinerProfile.php">
                    <button class="profile-btn">Examiner Profile</button>
                </a>
            </aside>
        </div>

        <div class="examiner-notification-container">
            <h1 style="margin-bottom: 30px;">Examiner Notifications</h1>

            
            <form method="post" class="examiner-notification-form" action="notificationProcess.php" onsubmit="return validateForm()">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="name-input" required><br>

                <label for="message">Message:</label>
                <textarea name="message" rows="10" class="name-input" required></textarea><br>
                <center>
                    <input name="create" type="submit" class="btn" value="Add Notification">
                </center>
            </form>
        </div>

        <!-- Added notifications display -->
        <div class="examiner-notification-container">

            <table>
                <tr>
                    <th>Name</th>
                    <th>Notification ID</th>
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
                                <input class="name-input" value="<?php echo $data['notificationId']; ?>" name="id" type="text" readonly>     
                            </td>
                            <td>
                                <textarea class="name-input" name="message"><?php echo $data['message']; ?></textarea>
                            </td>
                            <td>
                                <button name="update" type="submit" class="btn">Edit</button>
                                <br><br>
                                <button name="delete" type="submit" class="btn"  onclick="return confirmDelete()">Delete</button>
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
                <a href="../../../../terms&conditions.html">Terms & Conditions</a> |
                <a href="../../../../privacyPolicy.html">Privacy Policy</a>
            </p>
        </footer>
        
    </div>
    
</body>

</html>