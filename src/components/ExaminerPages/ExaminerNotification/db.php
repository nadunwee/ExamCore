<?php

session_start();

$conn = new mysqli(
	"localhost",
	"root",
	"",
	"exam_core"
);

if ($conn->connect_error) {
	die("Connection failed: " .$con->connect_error);
};

