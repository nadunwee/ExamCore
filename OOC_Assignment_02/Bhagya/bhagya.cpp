#include <iostream>
#include <string>

using namespace std;

// ============================ RegisteredUser Class ============================
class RegisteredUser {
protected:
    string name;
    string phone;
    string email;

public:
    // Constructor
    RegisteredUser(const string& name, const string& phone, const string& email)
        : name(name), phone(phone), email(email) {}

    // Member functions
    void login() {
        cout << name << " logged in successfully." << endl;
    }
    void logout() {
        cout << name << " logged out." << endl;
    }
    void deleteAccount() {
        cout << name << "'s account deleted." << endl;
    }
};

// ============================ Examiner Class (Inheritance: RegisteredUser) ============================
class Examiner : public RegisteredUser {
private:
    int examinerID;
    string question;
    string answer1;
    string answer2;
    string answer3;
    string correctAnswer;

public:
    // Constructor
    Examiner(int id, const string& name, const string& phone, const string& email,
             const string& question, const string& answer1, const string& answer2,
             const string& answer3, const string& correctAnswer)
        : RegisteredUser(name, phone, email), examinerID(id), question(question), 
          answer1(answer1), answer2(answer2), answer3(answer3), correctAnswer(correctAnswer) {}

    // Member functions
    void addQuestion() {
        cout << "Question added by " << name << endl;
    }
    void editQuestion() {
        cout << "Question edited by " << name << endl;
    }
    void deleteQuestion() {
        cout << "Question deleted by " << name << endl;
    }
    void sendNotification() {
        cout << name << " sent a notification." << endl;
    }
};

// ============================ Paper Class ============================
class Paper {
private:
    int paperID;

public:
    // Constructor
    Paper(int id) : paperID(id) {}

    // Member functions
    void setPaperDetails() {
        cout << "Setting paper details for Paper ID: " << paperID << endl;
    }
    void displayPaper() {
        cout << "Displaying Paper ID: " << paperID << endl;
    }
};

<<<<<<< HEAD
#endif // PAPER_H
//2. Student.h

#ifndef STUDENT_H
#define STUDENT_H

#include <string>
#include "Notification.h"

using namespace std;

class Student {
private:
    int Student_ID;
    string Name;
    int PhoneNo;
    string Email;
    vector<Notification*> notifications;  // Aggregation relationship

public:
    Student(int id, const string& name, int phone, const string& email)
        : Student_ID(id), Name(name), PhoneNo(phone), Email(email) {}  // Constructor

    void addNotification(Notification* notif) {
        notifications.push_back(notif);
    }

    void viewNotification() {
        // Basic function to view notifications
    }
};

#endif // STUDENT_H
//3. Examiner.h

#ifndef EXAMINER_H
#define EXAMINER_H

#include <string>
#include "Exam.h"

using namespace std;

class Examiner {
private:
    int Examiner_ID;
    string Name;
    Exam* exam;  // Composition relationship with Exam

public:
    Examiner(int id, const string& name, Exam* e)
        : Examiner_ID(id), Name(name), exam(e) {}  // Constructor

    void createQuestions() {
        // Function to create questions
    }
};

#endif // EXAMINER_H
//4. Exam.h

#ifndef EXAM_H
#define EXAM_H

#include <string>

using namespace std;

=======
// ============================ Exam Class (Composition with Paper) ============================
>>>>>>> 8af91799579d48e82db796e9dac66bc19721f1f0
class Exam {
private:
    int examID;
    string subject;
    Paper paper;  // Composition: Exam contains a Paper object

public:
    // Constructor (Composition)
    Exam(int id, const string& subject, const Paper& paperObj) 
        : examID(id), subject(subject), paper(paperObj) {}

    // Member functions
    void displayExam() {
        cout << "Exam ID: " << examID << " - Subject: " << subject << endl;
        paper.displayPaper();
    }
};

<<<<<<< HEAD
#endif // EXAM_H
//5. Notification.h

#ifndef NOTIFICATION_H
#define NOTIFICATION_H
=======
// ============================ Student Class (Aggregation with Paper) ============================
class Student {
private:
    int studentID;
    string name;
    string phone;
    string email;
    Paper* paper;  // Aggregation: Student has a pointer to Paper (paper can exist independently)
>>>>>>> 8af91799579d48e82db796e9dac66bc19721f1f0

public:
    // Constructor (Aggregation)
    Student(int id, const string& name, const string& phone, const string& email, Paper* paperObj = nullptr)
        : studentID(id), name(name), phone(phone), email(email), paper(paperObj) {}

    // Member functions
    void attemptExam() {
        if (paper) {
            cout << name << " is attempting the exam." << endl;
            paper->displayPaper();
        } else {
            cout << name << " has no assigned paper to attempt." << endl;
        }
    }
    void viewQuestions() {
        cout << name << " is viewing the exam questions." << endl;
    }
    void sendPaper() {
        cout << name << " has submitted the paper." << endl;
    }
    void submitPaper() {
        cout << name << " has completed and submitted the paper." << endl;
    }
    void viewSupport() {
        cout << name << " is viewing the support page." << endl;
    }
    void displayNotification() {
        cout << name << " is viewing notifications." << endl;
    }
};

// ============================ Notification Class (Association with Student) ============================
class Notification {
private:
    int notificationID;
    string message;

public:
    // Constructor
    Notification(int id, const string& message) : notificationID(id), message(message) {}

    // Member function
    void displayNotification() {
        cout << "Notification: " << message << endl;
    }
};

<<<<<<< HEAD
#endif // NOTIFICATION_H
//Main Program Example (main.cpp)

#include <iostream>
#include "Student.h"
#include "Examiner.h"
#include "Paper.h"
#include "Exam.h"
#include "Notification.h"

using namespace std;

=======
// ============================ Main Function ============================
>>>>>>> 8af91799579d48e82db796e9dac66bc19721f1f0
int main() {
    // Composition Example: Exam contains a Paper object
    Paper paper1(101);
    Exam exam1(1, "Math", paper1);

    // Aggregation Example: Student has a pointer to a Paper
    Student student1(1, "John", "123456", "john@example.com", &paper1);

    // Student attempting an exam
    student1.attemptExam();

    // Display Exam Details
    exam1.displayExam();

    // Association Example: Notification is associated with Student
    Notification notification1(1, "Your exam is due tomorrow");
    notification1.displayNotification();

    return 0;
}