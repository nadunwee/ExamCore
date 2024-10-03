<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user-email'])) {
    header('Location: ../../AccessPages/login.php');
    exit();
}

// Retrieve the session variables
$userEmail = $_SESSION['user-email'];
$userType = 'examiner';

include('../../../php/config.php');

$query = $conn->prepare("SELECT * FROM notifications WHERE email = ? AND user_type = ?");
$query->bind_param('ss', $userEmail, $userType);

if ($query->execute()) {
    $result = $query->get_result();
} else {
    echo "Error executing query!";
}

$query->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examiner Notification</title>
    <link rel="stylesheet" href="ExaminerNotification.css">
    <link rel="stylesheet" href="commonNavbarAndFooterStyles.css">

    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var message = document.getElementsByName("message")[0].value;

            // Name validation
            if (name.length < 2 || name.length > 20) {
                alert("Name must be between 2 and 20 characters");
                return false;
            }

            // Message validation
            if (message.length < 3 || message.length > 500) {
                alert("Message must be between 3 and 500 characters");
                return false;
            }

            return true; // Submit the form if everything is correct
        }


        function editNotification(notification) {
            // Populate the form fields with the notification data
            document.getElementById('name').value = notification.name; // Ensure 'name' exists in the object
            document.getElementsByName('message')[0].value = notification.message; // Ensure 'message' exists in the object

            // Set the form action to "updateNotification.php" for editing
            document.querySelector('form').action = './updateNotification.php';

            // Set edit_mode to "1" indicating this is an edit operation
            document.getElementById('edit_mode').value = "1";

            // Change the button value to "Save Edits"
            document.getElementById('submit-btn').value = "Save Edits";

            // If you are updating, ensure the notification ID is also set as a hidden field
            const notificationIdField = document.createElement('input');
            notificationIdField.type = 'hidden';
            notificationIdField.name = 'notificationId';
            notificationIdField.value = notification.notificationId; // Ensure 'notificationId' exists
            document.querySelector('form').appendChild(notificationIdField);
        }
    </script>
    </script>

</head>

<body>
    <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="../examinerHome.html">Home</a></li>
                    <li><a href="../ExaminerExam/examinerExam.php">Exams</a></li>
                    <li><a href="../ExaminerResult/examinerResult.html">Results</a></li>
                    <li><a href="ExaminerNotifications.php">Notifications</a></li>
                </ul>
                <a href="../ExaminerProfile/examinerProfile.html">
                    <button class="profile-btn">Examiner Profile</button>
                </a>
            </aside>
        </div>

        <div class="examiner-notification-container">
            <h1 style="margin-bottom: 30px;">Examiner Notifications</h1>

            <!-- Notification Form -->
            <form method="post" class="examiner-notification-form" action="./addNotification.php" onsubmit="return validateForm()">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="name-input" required><br>

                <label for="message">Message:</label>
                <textarea name="message" rows="10" class="name-input" required></textarea><br>

                <input type="hidden" name="email" value="<?php echo $userEmail ?>"><br>
                <input type="hidden" name="user_type" value="<?php echo $userType ?>"><br>

                <!-- Hidden field to handle edit mode -->
                <input type="hidden" id="edit_mode" name="edit_mode" value="0" />

                <center>
                    <input name="create" type="submit" class="btn" id="submit-btn" value="Add Notification">
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
                // Check if there are notifications
                if ($result->num_rows > 0) {
                    // Loop through each notification
                    while ($data = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><input class="name-input" value="<?php echo $data['name']; ?>" name="name" type="text" readonly></td>
                            <td>
                                <input class="name-input" value="<?php echo $data['notificationId']; ?>" name="id" type="hidden">
                                <?php echo $data['email']; ?>
                            </td>
                            <td>
                                <textarea class="name-input" name="message" readonly><?php echo $data['message']; ?></textarea>
                            </td>
                            <td>
                                <!-- Modify the edit button to call a JS function that populates the form -->
                                <button type="button" class="btn" onclick='editNotification(<?php echo json_encode($data); ?>)'>Edit</button>
                                <br><br>
                                <form action="./modifyNotifications.php" method="POST">
                                    <input type="hidden" name="email" value="<?php echo $userEmail ?>">
                                    <input type="hidden" name="notificationId" value="<?php echo $data['notificationId']; ?>">
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='4'>No notifications found</td></tr>";
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
        <script src="ExaminerNotification.js"></script>
    </div>
</body>

</html>