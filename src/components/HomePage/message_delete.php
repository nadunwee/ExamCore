<?php

$conn = new mysqli('localhost', 'root', '', 'exam_core');

  if ($conn->connect_error) {
    die('Connection Error : ' . $conn->connect_error);
  }

$contact_ID = $_POST["ID"];

$sql = "DELETE FROM message WHERE m_ID ='$contact_ID' ";

if($conn->query($sql)){
}
else{
    echo "Not deleted";
}
header("Location: contactus.php");
exit();
$conn->close();

?>


