<?php

require "admindb.php";

if (isset($_POST["create"])) {

    $name = $_POST["name"];
    $email = "admin@gmail.com";
    $message = $_POST["message"];

    if (
        empty($_POST["name"])
        || empty($_POST["message"])
    ) {
        header("location: AdminNotifications.php?status=Empty Input !");
        exit();
    } else {

        if (strlen($name) < 2 || strlen($name) > 20) {
            header("location: AdminNotifications.php");
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: AdminNotifications.php");
            exit();
        } elseif (strlen($message) < 3 || strlen($message) > 500) {
            header("location: AdminrNotifications.php");
            exit();
        } else {

            $q1 = "INSERT INTO `notifications` (`name`,`email`,`message`) 
            VALUES ('" . $name . "','" . $email . "','" . $message . "')";

            $rs1 = $conn->query($q1);
            $conn->close();

            header("location: AdminNotifications.php?status=Notification Created Successfully !");
            exit();
        }
    }
} else if (isset($_POST["update"])) {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = "admin@gmail.com";
    $message = $_POST["message"];

    if (
        empty($_POST["name"])
        || empty($_POST["message"])
        || empty($_POST["id"])
    ) {
        header("location: AdminNotifications.php?status=Empty Input !");
        exit();
    } else {

        if (strlen($name) < 2 || strlen($name) > 20) {
            header("location: AdminNotifications.php?status=Invalid Name !");
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: AdminNotifications.php?status=Invalid Email !");
            exit();
        } elseif (strlen($message) < 3 || strlen($message) > 500) {
            header("location: AdminNotifications.php?status=Invalid Message Length !");
            exit();
        } else {

            $q1 = "UPDATE `notifications` SET name = '" . $name . "', email = '" . $email . "', message = '" . $message . "' WHERE notificationId = '" . $id . "'";
            $rs1 = $conn->query($q1);

            header("location: AdminNotifications.php?status=Notification Updated Successfully !");
            exit();
        }
    }
} elseif (isset($_POST["delete"])) {
    $Id = $_POST["id"];

    if (empty($_POST["id"])) {
        header("location: AdminNotifications.php?status=Empty Input !");
        exit();
    }

    $q5 = "DELETE FROM `notifications` WHERE notificationId='" . $Id . "'";
    $rs5 = $conn->query($q5);
    $conn->close();

    header("location: AdminNotifications.php?status=Notification Deleted Successfully !");
    exit();
} else {
    header("location: AdminNotifications.php");
    exit();
}
