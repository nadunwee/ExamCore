<?php

session_start();

$conn = new mysqli(
	"localhost",
	"root",
	"",
);

if ($conn->connect_error) {
	die("Connection failed: " .$con->connect_error);

