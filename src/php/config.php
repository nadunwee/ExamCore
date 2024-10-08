<?php
  $conn = new mysqli('localhost', 'root', '', 'exam_core');


  if ($conn->connect_error) {
    die('Connection Error : ' . $conn->connect_error);
  }
 
  
?>