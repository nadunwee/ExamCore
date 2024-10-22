#include <iostream>
#include <string>
#include <vector>

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

    virtual void login() {
        cout << name << " logged in." << endl;
    }
    
    virtual void logout() {
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
    vector<string> questions; // 1 to many relationship with questions

public:
    // Constructor
    Examiner(int id, const string& name, const string& phone, const string& email)
        : RegisteredUser(name, phone, email), examinerID(id) {}

    void addQuestion(const string& question) {
        questions.push_back(question);
        cout << "Question added: " << question << endl;
    }

    void displayQuestions() const {
        cout << "Questions by " << name << ":" << endl;
        for (const auto& q : questions) {
            cout << "- " << q << endl;
        }
    }

    void sendNotification() {
        cout << "Notification sent to students." << endl;
    }
};

// ============================ Paper Class ============================
class Paper {
private:
    int paperID;

public:
    // Constructor
    Paper(int id) : paperID(id) {}

    void setPaperDetails() {
        cout << "Details set for paper ID: " << paperID << endl;
    }
    
    void displayPaper() const {
        cout << "Displaying paper ID: " << paperID << endl;
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

    void displayExam() const {
        cout << "Exam ID: " << examID << ", Subject: " << subject << endl;
        paper.displayPaper();
    }
};

// ============================ Student Class (Aggregation with Paper) ============================
class Student : public RegisteredUser {
private:
    int studentID;
    Paper* paper;  // Aggregation: Student has a pointer to Paper

public:
    // Constructor (Aggregation)
    Student(int id, const string& name, const string& phone, const string& email, Paper* paperObj = nullptr)
        : RegisteredUser(name, phone, email), studentID(id), paper(paperObj) {}

    void attemptExam() const {
        if (paper) {
            cout << name << " is attempting the exam." << endl;
            paper->displayPaper();
        } else {
            cout << "No paper assigned." << endl;
        }
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

    void displayNotification() const {
        cout << "Notification: " << message << endl;
    }
};

// ============================ Profile Class (Composition with RegisteredUser) ============================
class Profile {
private:
    RegisteredUser& user; // Composition: Profile is associated with a RegisteredUser
    string address;
    int phone;
    string email;
    string password;

public:
    // Constructor
    Profile(RegisteredUser& user, const string& address, int phone, const string& email, const string& password)
        : user(user), address(address), phone(phone), email(email), password(password) {}

    void createAccount() {
        cout << "Account created for " << user.name << endl;
    }
    
    void deleteAccount() {
        user.deleteAccount();
    }
};

// ============================ Admin Class ============================
class Admin : public RegisteredUser {
private:
    int adminID;

public:
    // Constructor
    Admin(int id, const string& name, const string& phone, const string& email)
        : RegisteredUser(name, phone, email), adminID(id) {}

    void addExam() {
        cout << "Exam added by admin " << name << endl;
    }
    
    void assignExaminer(Examiner& examiner) {
        cout << "Examiner " << examiner.name << " assigned." << endl;
    }
};

// ============================ UnregisteredUser Class ============================
class UnregisteredUser {
public:
    void registerUser() {
        cout << "User registered." << endl;
    }
    
    void viewPackage() {
        cout << "Viewing package." << endl;
    }
};

// ============================ Messages Class ============================
class Messages {
public:
    void storeMessages() {
        cout << "Messages stored." << endl;
    }
};

// ============================ Package Class ============================
class Package {
public:
    void selectPackage() {
        cout << "Package selected." << endl;
    }
    
    void stopPackage() {
        cout << "Package stopped." << endl;
    }
};

// ============================ Main Function ============================
int main() {
    // Create a Paper
    Paper paper1(101);
    
    // Create an Exam that contains the Paper
    Exam exam1(1, "Math", paper1);
    
    // Create an Examiner
    Examiner examiner1(1, "Dr. Smith", "1234567890", "smith@example.com");
    examiner1.addQuestion("What is 2+2?");
    examiner1.addQuestion("What is the capital of France?");
    examiner1.displayQuestions();

    // Create a Student and associate with Paper
    Student student1(1, "John Doe", "0987654321", "john@example.com", &paper1);
    student1.attemptExam();
    
    // Create a Notification
    Notification notification1(1, "Your exam is due tomorrow");
    notification1.displayNotification();

    // Create an Admin
    Admin admin1(1, "Admin", "1112223333", "admin@example.com");
    admin1.addExam();

    // Create a Profile for the Student
    Profile studentProfile(student1, "123 Main St", 1234567890, "john@example.com", "password123");
    studentProfile.createAccount();
    
    // Unregistered user actions
    UnregisteredUser unregUser;
    unregUser.registerUser();

    return 0;
}
