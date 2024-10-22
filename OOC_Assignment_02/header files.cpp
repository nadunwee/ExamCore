#include <iostream>
#include <string>

using namespace std;

const int MAX_QUESTIONS = 10;

//RegisteredUser Class
class RegisteredUser {
protected:
    string name;
    string phone;
    string email;

public:
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

    string getName() const {
        return name;
    }
};

//Examiner Class (Inheritance: RegisteredUser)
class Examiner : public RegisteredUser {
private:
    int examinerID;
    string questions[MAX_QUESTIONS];
    int questionCount;

public:
    Examiner(int id, const string& name, const string& phone, const string& email)
        : RegisteredUser(name, phone, email), examinerID(id), questionCount(0) {}

    void addQuestion(const string& question) {
        if (questionCount < MAX_QUESTIONS) {
            questions[questionCount] = question;
            questionCount++;
            cout << "Question added: " << question << endl;
        } else {
            cout << "Cannot add more questions, maximum limit reached." << endl;
        }
    }

    void displayQuestions() const {
        cout << "Questions by " << name << ":" << endl;
        for (int i = 0; i < questionCount; i++) {
            cout << "- " << questions[i] << endl;
        }
    }

    void sendNotification() {
        cout << "Notification sent to students." << endl;
    }

    string getName() const {
        return name;
    }
};

//Paper Class
class Paper {
private:
    int paperID;

public:
    Paper(int id) : paperID(id) {}

    void setPaperDetails() {
        cout << "Details set for paper ID: " << paperID << endl;
    }

    void displayPaper() const {
        cout << "Displaying paper ID: " << paperID << endl;
    }
};

//Exam Class
class Exam {
private:
    int examID;
    string subject;
    Paper paper;

public:
    Exam(int id, const string& subject, const Paper& paperObj)
        : examID(id), subject(subject), paper(paperObj) {}

    void displayExam() const {
        cout << "Exam ID: " << examID << ", Subject: " << subject << endl;
        paper.displayPaper();
    }
};

//Student Class (Aggregation with Paper)
class Student : public RegisteredUser {
private:
    int studentID;
    Paper* paper;

public:
    Student(int id, const string& name, const string& phone, const string& email, Paper* paperObj = nullptr)
        : RegisteredUser(name, phone, email), studentID(id), paper(paperObj) {}

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

//Notification Class (Association with Student)
class Notification {
private:
    int notificationID;
    string message;

public:
    Notification(int id, const string& message) : notificationID(id), message(message) {}

    void displayNotification() const {
        cout << "Notification: " << message << endl;
    }
};

//Profile Class
class Profile {
private:
    RegisteredUser& user;
    string address;
    int phone;
    string email;
    string password;

public:
    Profile(RegisteredUser& user, const string& address, int phone, const string& email, const string& password)
        : user(user), address(address), phone(phone), email(email), password(password) {}

    void createAccount() {
        cout << "Account created for " << user.getName() << endl;
    }

    void deleteAccount() {
        user.deleteAccount();
    }
};

//Admin Class
class Admin : public RegisteredUser {
private:
    int adminID;

public:
    Admin(int id, const string& name, const string& phone, const string& email)
        : RegisteredUser(name, phone, email), adminID(id) {}

    void addExam() {
        cout << "Exam added by admin " << getName() << endl;
    }

    void assignExaminer(Examiner& examiner) {
        cout << "Examiner " << examiner.getName() << " assigned." << endl;
    }
};

//UnregisteredUser Class
class UnregisteredUser {
public:
    void registerUser() {
        cout << "User registered." << endl;
    }

    void viewPackage() {
        cout << "Viewing package." << endl;
    }
};

//Messages Class
class Messages {
public:
    void storeMessages() {
        cout << "Messages stored." << endl;
    }
};

//Package Class
class Package {
public:
    void selectPackage() {
        cout << "Package selected." << endl;
    }

    void stopPackage() {
        cout << "Package stopped." << endl;
    }
};

//Main Function
int main() {
    Paper paper1(101);

    Exam exam1(1, "Math", paper1);

    Examiner examiner1(1, "Dr. Smith", "1234567890", "smith@example.com");
    examiner1.addQuestion("What is 2+2?");
    examiner1.addQuestion("What is the capital of France?");
    examiner1.displayQuestions();

    Student student1(1, "John Doe", "0987654321", "john@example.com", &paper1);
    student1.attemptExam();

    Notification notification1(1, "Your exam is due tomorrow");
    notification1.displayNotification();

    Admin admin1(1, "Admin", "1112223333", "admin@example.com");
    admin1.addExam();

    Profile studentProfile(student1, "123 Main St", 1234567890, "john@example.com", "password123");
    studentProfile.createAccount();

    UnregisteredUser unregUser;
    unregUser.registerUser();

    return 0;
}
