#include <iostream>
#include <string>

using namespace std;

const int MAX_QUESTIONS = 10;  // Maximum number of questions an examiner can add

// RegisteredUser Class (Base class for common user attributes and functionalities)
class RegisteredUser {
protected:
    string name;
    string phone;
    string email;

public:
    // Constructor to initialize name, phone, and email for any registered user
    RegisteredUser(const string& name, const string& phone, const string& email)
        : name(name), phone(phone), email(email) {}

    // Function to simulate user login
    virtual void login() {
        cout << name << " logged in." << endl;
    }

    // Function to simulate user logout
    virtual void logout() {
        cout << name << " logged out." << endl;
    }

    // Function to simulate account deletion
    void deleteAccount() {
        cout << name << "'s account deleted." << endl;
    }

    // Getter function to retrieve the user's name
    string getName() const {
        return name;
    }
};

// Examiner Class (Inherits from RegisteredUser)
class Examiner : public RegisteredUser {
private:
    int examinerID;  // Unique ID for each examiner
    string questions[MAX_QUESTIONS];  // Array to store exam questions
    int questionCount;  // Counter to keep track of how many questions have been added

public:
    // Constructor for Examiner with ID and basic info (name, phone, email)
    Examiner(int id, const string& name, const string& phone, const string& email)
        : RegisteredUser(name, phone, email), examinerID(id), questionCount(0) {}

    // Function to add a question to the examiner's list (if below the max limit)
    void addQuestion(const string& question) {
        if (questionCount < MAX_QUESTIONS) {
            questions[questionCount] = question;
            questionCount++;
            cout << "Question added: " << question << endl;
        } else {
            cout << "Cannot add more questions, maximum limit reached." << endl;
        }
    }

    // Function to display all questions added by the examiner
    void displayQuestions() const {
        cout << "Questions by " << name << ":" << endl;
        for (int i = 0; i < questionCount; i++) {
            cout << "- " << questions[i] << endl;
        }
    }

    // Function to simulate sending notifications to students
    void sendNotification() {
        cout << "Notification sent to students." << endl;
    }

    // Overridden function to retrieve the name of the examiner
    string getName() const {
        return name;
    }
};

// Paper Class (Represents an exam paper with an ID)
class Paper {
private:
    int paperID;  // Unique ID for the paper

public:
    // Constructor to initialize a paper with a given ID
    Paper(int id) : paperID(id) {}

    // Function to set paper details (placeholder for future implementation)
    void setPaperDetails() {
        cout << "Details set for paper ID: " << paperID << endl;
    }

    // Function to display paper details (prints the paper ID)
    void displayPaper() const {
        cout << "Displaying paper ID: " << paperID << endl;
    }
};

// Exam Class (Associates a subject with a paper and exam ID)
class Exam {
private:
    int examID;  // Unique ID for the exam
    string subject;  // Subject name of the exam
    Paper paper;  // Paper object associated with the exam

public:
    // Constructor to initialize exam with ID, subject, and associated paper
    Exam(int id, const string& subject, const Paper& paperObj)
        : examID(id), subject(subject), paper(paperObj) {}

    // Function to display exam details, including subject and paper
    void displayExam() const {
        cout << "Exam ID: " << examID << ", Subject: " << subject << endl;
        paper.displayPaper();
    }
};

// Student Class (Inherits from RegisteredUser and is associated with a Paper)
class Student : public RegisteredUser {
private:
    int studentID;  // Unique ID for the student
    Paper* paper;  // Pointer to a Paper object the student is attempting

public:
    // Constructor to initialize student with ID, name, phone, email, and optional paper
    Student(int id, const string& name, const string& phone, const string& email, Paper* paperObj = nullptr)
        : RegisteredUser(name, phone, email), studentID(id), paper(paperObj) {}

    // Function for the student to attempt the assigned exam
    void attemptExam() const {
        if (paper) {
            cout << name << " is attempting the exam." << endl;
            paper->displayPaper();
        }
        else {
            cout << "No paper assigned." << endl;
        }
    }
};

// Notification Class (Represents a notification with an ID and message)
class Notification {
private:
    int notificationID;  // Unique ID for the notification
    string message;  // Message content of the notification

public:
    // Constructor to initialize notification with ID and message
    Notification(int id, const string& message) : notificationID(id), message(message) {}

    // Function to display the notification message
    void displayNotification() const {
        cout << "Notification: " << message << endl;
    }
};

// Profile Class (Manages user profiles)
class Profile {
private:
    RegisteredUser& user;  // Reference to a RegisteredUser object
    string address;
    int phone;
    string email;
    string password;

public:
    // Constructor to initialize profile details
    Profile(RegisteredUser& user, const string& address, int phone, const string& email, const string& password)
        : user(user), address(address), phone(phone), email(email), password(password) {}

    // Function to simulate account creation
    void createAccount() {
        cout << "Account created for " << user.getName() << endl;
    }

    // Function to delete the user's account
    void deleteAccount() {
        user.deleteAccount();
    }
};

// Admin Class (Inherits from RegisteredUser, additional admin functionalities)
class Admin : public RegisteredUser {
private:
    int adminID;  // Unique ID for the admin

public:
    // Constructor to initialize admin with ID and basic info
    Admin(int id, const string& name, const string& phone, const string& email)
        : RegisteredUser(name, phone, email), adminID(id) {}

    // Function to simulate adding an exam by the admin
    void addExam() {
        cout << "Exam added by admin " << getName() << endl;
    }

    // Function to assign an examiner to an exam (accepts an Examiner object)
    void assignExaminer(Examiner& examiner) {
        cout << "Examiner " << examiner.getName() << " assigned." << endl;
    }
};

// UnregisteredUser Class (Basic functionality for unregistered users)
class UnregisteredUser {
public:
    // Function to simulate user registration
    void registerUser() {
        cout << "User registered." << endl;
    }

    // Function to simulate viewing packages
    void viewPackage() {
        cout << "Viewing package." << endl;
    }
};

// Messages Class (Manages storing messages)
class Messages {
public:
    // Function to store messages (placeholder for future implementation)
    void storeMessages() {
        cout << "Messages stored." << endl;
    }
};

// Package Class (Manages package selection and stopping)
class Package {
public:
    // Function to select a package (placeholder for future implementation)
    void selectPackage() {
        cout << "Package selected." << endl;
    }

    // Function to stop a package (placeholder for future implementation)
    void stopPackage() {
        cout << "Package stopped." << endl;
    }
};

// Main Function
int main() {
    // Creating a Paper object with ID 101
    Paper paper1(101);

    // Creating an Exam object with ID 1, subject "Math", and associated paper
    Exam exam1(1, "Math", paper1);

    // Creating an Examiner object with basic info and adding questions
    Examiner examiner1(1, "Dr. Smith", "1234567890", "smith@example.com");
    examiner1.addQuestion("What is 2+2?");
    examiner1.addQuestion("What is the capital of France?");
    examiner1.displayQuestions();  // Displaying all questions

    // Creating a Student object and simulating an exam attempt
    Student student1(1, "John Doe", "0987654321", "john@example.com", &paper1);
    student1.attemptExam();  // Student attempts the exam

    // Creating a Notification object and displaying it
    Notification notification1(1, "Your exam is due tomorrow");
    notification1.displayNotification();

    // Creating an Admin object and simulating adding an exam
    Admin admin1(1, "Admin", "1112223333", "admin@example.com");
    admin1.addExam();

    // Creating a Profile for the student and simulating account creation
    Profile studentProfile(student1, "123 Main St", 1234567890, "john@example.com", "password123");
    studentProfile.createAccount();

    // Simulating an unregistered user registering
    UnregisteredUser unregUser;
    unregUser.registerUser();

    return 0;
}
