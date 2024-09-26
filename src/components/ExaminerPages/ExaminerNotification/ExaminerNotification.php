<?php
    // Connection details (you can replace this with your actual connection code)
    $servername = "localhost"; // Update with your server name
    $username = "root"; // Update with your database username
    $password = ""; // Update with your database password
    $dbname = "your_database"; // Update with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die('Connection Error: ' . $conn->connect_error);
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = isset($_POST["name"]) ? $_POST["name"] : null;
        $email = isset($_POST["email"]) ? $_POST["email"] : null;
        $message = isset($_POST["message"]) ? $_POST["message"] : null;

        // Ensure all fields are filled out
        if ($name && $email && $message) {
            // Prepare and execute the query
            $query = $conn->prepare("INSERT INTO notification (name, email, message) VALUES (?, ?, ?)");
            $query->bind_param("sss", $name, $email, $message);

            // Check if the query executes successfully
            if ($query->execute()) {
                echo "<script>alert('Notification added successfully');</script>";
            } else {
                echo "Execution Error: " . $query->error;
            }

            $query->close();
        } else {
            echo "<script>alert('Please fill in all fields');</script>";
        }
    }

    // Close the connection
    $conn->close();
?>

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="ExaminerNotification.css">
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
    <title>Examiner Notification</title>
</head>

<body>
    <div class="wrapper">
    <div class="container">

        <aside class="sidebar">
            <h1>ExamCore</h1>
            <ul>
                <li><a href="../examinerHome.html">Home</a></li>
                <li><a href="../ExaminerExam/examinerExam.html">Exams</a></li>
                <li><a href="../ExaminerResult/examierResult.html">Results</a></li>
                <li><a href="../ExaminerNotification/ExaminerNotification.html">Notifications</a></li>
            </ul>
            <a href="../ExaminerProfile/examinerProfile.html"><button class="profile-btn">Examiner Profile</button></a>
            
        </aside>
    </div>
    
    <div class="examiner-notification-container">
        <h1>Examiner Notifications</h1>
        <form method="post" id="examiner-notification-form" action="bagyacreate.php">

            Name:<input type="text" id="name-input" name="name" placeholder="Enter name" required>
            E-mail:<input type="text" id="email-input" name="email" placeholder="Enter email" required>
            Message:<input type="text" id="notification-input" name="message" placeholder="Enter notification" required>

                <input type="submit" value="Add Notification">
            </form>

            <!-- Added notification list should be displayed here -->
            <ul id="list-notifications"></ul>
        </div>

        <footer class="page-footer">
            <p>Copyright ©️ 2024 ExamCore. All rights reserved. | <a href="#">Terms & Conditions</a> | 
            <a href="#">Privacy Policy</a></p>
        </footer>
        <script src="ExaminerNotification.js"></script>
    </div>
</body>

</html>
