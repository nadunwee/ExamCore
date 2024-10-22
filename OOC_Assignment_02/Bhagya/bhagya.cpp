 Paper.h (Composition with Exam)
cpp
Copy code
#ifndef PAPER_H
#define PAPER_H

#include "Exam.h"

class Paper {
private:
    int Paper_ID;
    Exam* exam;  // Composition: Paper "has a" Exam, Paper owns the Exam

public:
    Paper(int id, Exam* e) : Paper_ID(id), exam(e) {}  // Constructor with composition relationship

    void setPaperDetails();
    void displayPaper();
};

#endif // PAPER_H
2. Student.h (Aggregation with Notification)
cpp
Copy code
#ifndef STUDENT_H
#define STUDENT_H

#include <string>
#include <vector>
#include "Notification.h"
#include "Profile.h"

class Student {
private:
    int Student_ID;
    std::string Name;
    int PhoneNo;
    std::string Email;
    std::vector<Notification*> notifications;  // Aggregation: Student has many Notifications

public:
    Student(int id, const std::string& name, int phone, const std::string& email)
        : Student_ID(id), Name(name), PhoneNo(phone), Email(email) {}

    void addNotification(Notification* notif) {  // Aggregation: Adding notification
        notifications.push_back(notif);
    }

    void attemptExams();
    void answerQuestions();
    void sendSupportRequest();
    void manageProfile();
    void viewNotification();
};

#endif // STUDENT_H
3. Examiner.h (Composition with Exam)
cpp
Copy code
#ifndef EXAMINER_H
#define EXAMINER_H

#include <string>
#include "Exam.h"

class Examiner {
private:
    int Examiner_ID;
    std::string Name;
    std::string Email;
    Exam* exam;  // Composition: Examiner is responsible for creating Exam

public:
    Examiner(int id, const std::string& name, const std::string& email, Exam* e)
        : Examiner_ID(id), Name(name), Email(email), exam(e) {}  // Constructor for composition with Exam

    void editQuestions();
    void deleteQuestions();
    void createQuestions();
    void sendNotification();
};

#endif // EXAMINER_H
4. Exam.h (Composition within Examiner and Paper)
cpp
Copy code
#ifndef EXAM_H
#define EXAM_H

#include <string>

class Exam {
private:
    int Exam_ID;
    std::string Subject;

public:
    Exam(int id, const std::string& subject)
        : Exam_ID(id), Subject(subject) {}

    void displayExam();
};

#endif // EXAM_H
5. Profile.h (Aggregation with Registered_User)
cpp
Copy code
#ifndef PROFILE_H
#define PROFILE_H

#include <string>
#include "Registered_User.h"

class Profile {
private:
    std::string Name;
    std::string Address;
    int PhoneNo;
    std::string Email;
    std::string Password;
    Registered_User* regUser;  // Aggregation: Profile is linked to Registered_User

public:
    Profile(const std::string& name, const std::string& address, int phone, const std::string& email, const std::string& password)
        : Name(name), Address(address), PhoneNo(phone), Email(email), Password(password), regUser(nullptr) {}  // Constructor without aggregation

    void assignRegisteredUser(Registered_User* rUser) {  // Assigning Registered_User for aggregation
        regUser = rUser;
    }

    void loginAccount();
    void createAccount();
    void deleteAccount();
};

#endif // PROFILE_H
6. Admin.h (No changes due to relationships)
cpp
Copy code
#ifndef ADMIN_H
#define ADMIN_H

#include "Exam.h"
#include "Examiner.h"
#include "Notification.h"

class Admin {
private:
    int adminId;

public:
    Admin(int id) : adminId(id) {}

    void addExam();
    void editExam();
    void deleteExam();
    void assignExaminer();
    void addNotification();
};

#endif // ADMIN_H
7. Notification.h (Aggregation with Student)
cpp
Copy code
#ifndef NOTIFICATION_H
#define NOTIFICATION_H

#include <string>

class Notification {
private:
    int Notification_ID;
    std::string Message;

public:
    Notification(int id, const std::string& msg) : Notification_ID(id), Message(msg) {}  // Constructor with aggregation

    void displayNotification();
};

#endif // NOTIFICATION_H
8. Unregistered_User.h (No changes due to relationships)
cpp
Copy code
#ifndef UNREGISTERED_USER_H
#define UNREGISTERED_USER_H

class Unregistered_User {
public:
    void viewSupport();
    void viewHomepage();
    void registerUser();
};

#endif // UNREGISTERED_USER_H
9. Registered_User.h (No changes due to relationships)
cpp
Copy code
#ifndef REGISTERED_USER_H
#define REGISTERED_USER_H

#include <string>

class Registered_User {
private:
    std::string Name;
    int PhoneNo;
    std::string Email;

public:
    Registered_User(const std::string& name, int phone, const std::string& email)
        : Name(name), PhoneNo(phone), Email(email) {}

    void login();
    void logout();
    void editAccount();
};

#endif // REGISTERED_USER_H