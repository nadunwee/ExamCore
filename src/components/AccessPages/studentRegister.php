<?php
  $firstName = $_POST['real-name'];
  $password = $_POST['password'];

  // Database connection
  $conn = new mysqli('localhost', 'root', '', 'test_exam');

  // Check connection
  if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
  } else {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO TestTable(name, password) VALUES (?, ?)");
    
    $stmt->bind_param("ss", $firstName, $password); // "ss" means two strings

    // Execute the statement
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $conn->close();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student registering</title>
  </head>
  <body>
    <h1>Student Registration Page</h1>
    <form action="http://localhost/quizcore/src/components/accesspages/studentRegister.php" method="POST">
      Name: <input type="text" name="real-name" required />
      Password: <input type="password" name="password" required />
      <input type="submit" value="Register" />
      <?echo "Registration successful";?>
    </form>
  </body>
</html>
