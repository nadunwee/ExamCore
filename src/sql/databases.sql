CREATE DATABASE `exam_core`

CREATE TABLE `examiners` (
  `examiner_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registered_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`examiner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `registered_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`student_id`)
);

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `admin` (
  `admin_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO admin (admin_id, name, password)
VALUES ("AD236034", "john Doe", "john123");

CREATE TABLE `Exams` (
    `exam_id` INT AUTO_INCREMENT,
    `exam_name` VARCHAR(255) NOT NULL,
    `assigned_examiner` VARCHAR(255) NOT NULL,
    `exam_deadline` DATE NOT NULL,
    `exam_password` VARCHAR(255) NOT NULL,
    `examiner_email` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`exam_id`)
);

CREATE TABLE `paper`(
  `question_ID` int(10) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer_1` varchar(255) NOT NULL,
  `answer_2` varchar(255) NOT NULL,
  `answer_3` varchar(255) NOT NULL,
  `answer_4` varchar(255) NOT NULL,
  `correst_answer` varchar(255) NOT NULL
  PRIMARY KEY (`question_ID`)
);
