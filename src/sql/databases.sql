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

CREATE TABLE `notifications` (
  `notificationId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`notificationId`)
) ;

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
    `examiner_id` INT NOT NULL,
    `exam_deadline` DATE NOT NULL,
    `exam_password` VARCHAR(255) NOT NULL,
    `admin_id` VARCHAR(100) NOT NULL,
    `participated` VARCHAR(10) NULL,
    PRIMARY KEY (`exam_id`),
    CONSTRAINT `fk_examiner`
        FOREIGN KEY (`examiner_id`) REFERENCES `Examiners`(`examiner_id`)
     
);

CREATE TABLE `paper`(
  `question_ID` int(10) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer_1` varchar(255) NOT NULL,
  `answer_2` varchar(255) NOT NULL,
  `answer_3` varchar(255) NOT NULL,
  `answer_4` varchar(255) NOT NULL,
  `correst_answer` varchar(255) NOT NULL,
  `email` varchar (200) NOT NULL,
  PRIMARY KEY (`question_ID`)
);

CREATE TABLE `message`(
  `m_ID` int(10) NOT NULL ,
  `m_name` varchar(100) NOT NULL,
  `m_con_num` varchar(15) NOT NULL,
  `m_message` varchar(255) NOT NULL,
  PRIMARY KEY (`m_ID`)
);

CREATE TABLE `answertable` (
  `question_id` int(11) NOT NULL,
  `correct_answer` varchar(255) NOT NULL,
  `submitted_answer` varchar(255) NOT NULL,
  PRIMARY KEY (`question_id`),
  CONSTRAINT `fk_question_id` FOREIGN KEY (`question_id`) REFERENCES `paper`(`question_id`)
);

CREATE TABLE `exammarks` (
  `email` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  PRIMARY KEY(`exam_id`),
);