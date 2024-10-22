Paper.h
#ifndef PAPER_H
#define PAPER_H

class Exam;  // Forward declaration

class Paper {
private:
    int Paper_ID;
    Exam* exam;  // Composition relationship with Exam

public:
    Paper(int id, Exam* e) : Paper_ID(id), exam(e) {}  // Constructor

    void displayPaper() {
        // Basic function to display paper details
    }
};

#endif // PAPER_H
2. Student.h
cpp
Copy code
#ifndef STUDENT_H
#define STUDENT_H

#include <string>
#include <vector>
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
3. Examiner.h
cpp
Copy code
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
4. Exam.h
cpp
Copy code
#ifndef EXAM_H
#define EXAM_H

#include <string>

using namespace std;

class Exam {
private:
    int Exam_ID;
    string Subject;

public:
    Exam(int id, const string& subject)
        : Exam_ID(id), Subject(subject) {}  // Constructor

    void displayExam() {
        // Basic function to display exam details
    }
};

#endif // EXAM_H
5. Notification.h
cpp
Copy code
#ifndef NOTIFICATION_H
#define NOTIFICATION_H

#include <string>

using namespace std;

class Notification {
private:
    int Notification_ID;
    string Message;

public:
    Notification(int id, const string& msg) : Notification_ID(id), Message(msg) {}  // Constructor

    void displayNotification() {
        // Basic function to display notification
    }
};

#endif // NOTIFICATION_H
Main Program Example (main.cpp)
cpp
Copy code
#include <iostream>
#include "Student.h"
#include "Examiner.h"
#include "Paper.h"
#include "Exam.h"
#include "Notification.h"

using namespace std;

int main() {
    // Create an exam
    Exam exam1(1, "Math");

    // Create an examiner with the exam (Composition)
    Examiner examiner1(1001, "Dr. Smith", &exam1);

    // Create a paper associated with the exam
    Paper paper1(2001, &exam1);

    // Create a student
    Student student1(3001, "John Doe", 123456789, "johndoe@email.com");

    // Create a notification and add it to the student (Aggregation)
    Notification notif1(4001, "Exam Schedule Updated");
    student1.addNotification(&notif1);

    // Displaying exam, paper, and notification details
    exam1.displayExam();
    paper1.displayPaper();
    student1.viewNotification();
    
    return 0;
}