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

// ============================ Exam Class (Composition with Paper) ============================
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

// ============================ Student Class (Aggregation with Paper) ============================
class Student {
private:
    int studentID;
    string name;
    string phone;
    string email;
    Paper* paper;  // Aggregation: Student has a pointer to Paper (paper can exist independently)

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

// ============================ Main Function ============================
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