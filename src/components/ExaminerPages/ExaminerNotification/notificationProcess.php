<?php

require "db.php";

if (isset($_POST["create"])) {

    $name = $_POST["name"];
    $email = "fdl@gmail.com";
    $message = $_POST["message"];

    if (
        empty($_POST["name"])
        || empty($_POST["message"])
    ) {
        header("location: ../examinerNotifications.php?status=Empty Input !");
        exit();
    } else {

        if (strlen($name) < 2 || strlen($name) > 20) {
            header("location: ../examinerNotifications.php?status=Invalid Name !");
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: ../examinerNotifications.php?status=Invalid Email !");
            exit();
        } elseif (strlen($message) < 3 || strlen($message) > 500) {
            header("location: ../examinerNotifications.php?status=Invalid Message Length !");
            exit();
        } else {

            $q1 = "INSERT INTO `notifications` (`name`,`email`,`message`) 
            VALUES ('" . $name . "','" . $email . "','" . $message . "')";

            $rs1 = $conn->query($q1);
            $conn->close();

            header("location: ../examinerNotifications.php?status=Notification Created Successfully !");
            exit();
        }
    }
} else if (isset($_POST["update"])) {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = "fdl@gmail.com";
    $message = $_POST["message"];

    if (
        empty($_POST["name"])
        || empty($_POST["message"])
        || empty($_POST["id"])
    ) {
        header("location: ../examinerNotifications.php?status=Empty Input !");
        exit();
    } else {

        if (strlen($name) < 2 || strlen($name) > 20) {
            header("location: ../examinerNotifications.php?status=Invalid Name !");
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: ../examinerNotifications.php?status=Invalid Email !");
            exit();
        } elseif (strlen($message) < 3 || strlen($message) > 500) {
            header("location: ../examinerNotifications.php?status=Invalid Message Length !");
            exit();
        } else {

            $q1 = "UPDATE `notifications` SET name = '" . $name . "', email = '" . $email . "', message = '" . $message . "' WHERE notificationId = '" . $id . "'";
            $rs1 = $conn->query($q1);

            header("location: ../examinerNotifications.php?status=Notification Updated Successfully !");
            exit();
        }
    }
} elseif (isset($_POST["delete"])) {
    $Id = $_POST["id"];

    if (empty($_POST["id"])) {
        header("location: ../examinerNotifications.php?status=Empty Input !");
        exit();
    }

    $q5 = "DELETE FROM `notifications` WHERE notificationId='" . $Id . "'";
    $rs5 = $conn->query($q5);
    $conn->close();

    header("location: ../examinerNotifications.php?status=Notification Deleted Successfully !");
    exit();
} else {
    header("location: ../examinerNotifications.php");
    exit();
}
