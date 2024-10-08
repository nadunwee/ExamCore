<?php
  $conn = new mysqli('localhost', 'root', '', 'exam_core');
//to create the connection- new mysquli- query $conn is the variable

  if ($conn->connect_error) {
    die('Connection Error : ' . $conn->connect_error);
  }
  //a function to remove the connection-die
  
  else {
    echo "not successful!";
  }
?>