<?php

$conn = new mysqli('localhost', 'root', '', 'exam_core');

if ($conn->connect_error) {
  die('Connection Error : ' . $conn->connect_error);
}

$contact_ID=$_POST["ID"];
$contact_name= $_POST["name"];
$contact_phone = $_POST["phone"];
$contact_message = $_POST["message"];


$sql = "INSERT INTO message VALUES('$contact_ID','$contact_name','$contact_phone','$contact_message')";

if($conn->query($sql))
{
}
else{
    echo "Error".$conn->error;
}

header("Location: contactus.php");
exit();
$conn->close();

?>
