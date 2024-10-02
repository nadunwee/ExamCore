<?php
$conn = new mysqli('localhost', 'root', '', 'exam_core');

if ($conn->connect_error) {
  die('Connection Error : ' . $conn->connect_error);
}
$contact_ID=$_POST["ID"];
$contact_name= $_POST["name"];
$contact_phone = $_POST["phone"];
$contact_message = $_POST["message"];

//when need to fill out all the data

if(empty($contact_ID)||empty($contact_name)||empty($contact_phone)||empty($contact_message ))
{
    echo "all Required";
}
#UPDATE tablename set table column name ='variable'.......primary key 
else{
    $sql="UPDATE message set m_name='$contact_name',m_con_num='$contact_phone',m_message='$contact_message' WHERE m_ID='$contact_ID' ";

    if($conn->query($sql))
    {
    }
    else{
        echo "Not Updated";
    }
}

$conn->close();

?>