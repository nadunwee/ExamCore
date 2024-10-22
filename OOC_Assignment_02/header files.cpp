//Student.h********************

#ifndef STUDENT_H
#define STUDENT_H

#pragma once
#include <string>
using namespace std;

class Student {
private:
    int studentID;
    string name;
    int phone;
    string email;

public:
    // Constructor
    Student(int id, const string& name, int phone, const string& email);

    // Member functions
    void attemptExam();
    void viewQuestions();
    void sendPaper();
    void submitPaper();
    void viewSupport();
    void displayNotification();
};

<<<<<<< HEAD
//Exam.h
=======
#endif

//Exam.h**********************

#ifndef EXAM_H
#define EXAM_H
>>>>>>> 2484bb52b5cc79f01f522c4c79f2200c362b6416

#pragma once
#include <string>
using namespace std;

class Exam {
private:
    int examID;
    string subject;

public:
    // Constructor
    Exam(int id, const string& subject);

    // Member functions
    void displayExam();
};

//Paper.h

<<<<<<< HEAD
#pragma once
=======
//Paper.h***************************

#ifndef PAPER_H
#define PAPER_H
>>>>>>> 2484bb52b5cc79f01f522c4c79f2200c362b6416

class Paper {
private:
    int paperID;

public:
    // Constructor
    Paper(int id);

    // Member functions
    void setPaperDetails();
    void displayPaper();
};

<<<<<<< HEAD
//Examiner.h
=======
#endif

//Examiner.h************************

#ifndef EXAMINER_H
#define EXAMINER_H
>>>>>>> 2484bb52b5cc79f01f522c4c79f2200c362b6416

#pragma once
#include <string>
using namespace std;

class Examiner {
private:
    int examinerID;
    string name;
    string question;
    string answer1;
    string answer2;
    string answer3;
    string correctAnswer;

public:
    // Constructor
    Examiner(int id, const string& name, const string& question,
             const string& answer1, const string& answer2,
             const string& answer3, const string& correctAnswer);

    // Member functions
    void addQuestion();
    void editQuestion();
    void deleteQuestion();
    void sendNotification();
};

<<<<<<< HEAD
//Notification.h
=======
#endif

//Notification.h******************************

#ifndef NOTIFICATION_H
#define NOTIFICATION_H
>>>>>>> 2484bb52b5cc79f01f522c4c79f2200c362b6416

#pragma once
#include <string>
using namespace std;

class Notification {
private:
    int notificationID;
    string message;

public:
    // Constructor
    Notification(int id, const string& message);

    // Member function
    void displayNotification();
};

<<<<<<< HEAD
//Profile.h
=======
#endif

//Profile.h***************************

#ifndef PROFILE_H
#define PROFILE_H
>>>>>>> 2484bb52b5cc79f01f522c4c79f2200c362b6416

#pragma once
#include <string>
using namespace std;

class Profile {
private:
    string name;
    string address;
    int phone;
    string email;
    string password;

public:
    // Constructor
    Profile(const string& name, const string& address, int phone,
            const string& email, const string& password);

    // Member functions
    void createAccount();
    void deleteAccount();
};

<<<<<<< HEAD
//Admin.h
=======
#endif

//Admin.h***********************

#ifndef ADMIN_H
#define ADMIN_H
>>>>>>> 2484bb52b5cc79f01f522c4c79f2200c362b6416

#pragma once
#include <string>
using namespace std;

class Admin {
private:
    int adminID;
    string password;

public:
    // Constructor
    Admin(int id, const string& password);

    // Member functions
    void addExam();
    void editExam();
    void deleteExam();
    void assignExaminer();
    void addNotification();
};

//UnregisteredUser.h

<<<<<<< HEAD
#pragma once
=======
//UnregisteredUser.h********************

#ifndef UNREGISTERED_USER_H
#define UNREGISTERED_USER_H
>>>>>>> 2484bb52b5cc79f01f522c4c79f2200c362b6416

class UnregisteredUser {
public:
    // Member functions
    void viewSupport();
    void viewPackage();
    void registerUser();
};

<<<<<<< HEAD
//RegisteredUser.h
=======
#endif

//RegisteredUser.h***********************

#ifndef REGISTERED_USER_H
#define REGISTERED_USER_H
>>>>>>> 2484bb52b5cc79f01f522c4c79f2200c362b6416

#pragma once
#include <string>
using namespace std;

class RegisteredUser {
private:
    string name;
    string phone;
    string email;

public:
    // Constructor
    RegisteredUser(const string& name, const string& phone, const string& email);

    // Member functions
    void login();
    void logout();
    void deleteAccount();
};

//Messages.h

<<<<<<< HEAD
#pragma once
=======
//Messages.h***********************

#ifndef MESSAGES_H
#define MESSAGES_H
>>>>>>> 2484bb52b5cc79f01f522c4c79f2200c362b6416

class Messages {
public:
    // Member function
    void storeMessages();
};

//Package.h

<<<<<<< HEAD
#pragma once
=======
//Package.h*************************

#ifndef PACKAGE_H
#define PACKAGE_H
>>>>>>> 2484bb52b5cc79f01f522c4c79f2200c362b6416

class Package {
public:
    // Member functions
    void selectPackage();
    void stopPackage();
};