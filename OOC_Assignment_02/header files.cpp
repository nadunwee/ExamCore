//Student.h

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

//Exam.h

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

#pragma once

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

//Examiner.h

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

//Notification.h

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

//Profile.h

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

//Admin.h

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

#pragma once

class UnregisteredUser {
public:
    // Member functions
    void viewSupport();
    void viewPackage();
    void registerUser();
};

//RegisteredUser.h

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

#pragma once

class Messages {
public:
    // Member function
    void storeMessages();
};

//Package.h

#pragma once

class Package {
public:
    // Member functions
    void selectPackage();
    void stopPackage();
};