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
    void login();
    void logout();
    void deleteAccount();
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
    void addQuestion();
    void editQuestion();
    void deleteQuestion();
    void sendNotification();
};

// ============================ Paper Class ============================
class Paper {
private:
    int paperID;

public:
    // Constructor
    Paper(int id) : paperID(id) {}

    // Member functions
    void setPaperDetails();
    void displayPaper();
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
    void displayExam();
};

// ============================ Student Class (Aggregation with Paper) ============================
class Student {
private:
    int studentID;
    string name;
    int phone;
    string email;
    Paper* paper;  // Aggregation: Student has a pointer to Paper (paper can exist independently)

public:
    // Constructor (Aggregation)
    Student(int id, const string& name, int phone, const string& email, Paper* paperObj = nullptr)
        : studentID(id), name(name), phone(phone), email(email), paper(paperObj) {}

    // Member functions
    void attemptExam();
    void viewQuestions();
    void sendPaper();
    void submitPaper();
    void viewSupport();
    void displayNotification();
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

// ============================ Profile Class ============================
class Profile {
private:
    string name;
    string address;
    int phone;
    string email;
    string password;

public:
    // Constructor
    Profile(const string& name, const string& address, int phone, const string& email, const string& password)
        : name(name), address(address), phone(phone), email(email), password(password) {}

    // Member functions
    void createAccount();
    void deleteAccount();
};

// ============================ Admin Class ============================
class Admin {
private:
    int adminID;
    string password;

public:
    // Constructor
    Admin(int id, const string& password) : adminID(id), password(password) {}

    // Member functions
    void addExam();
    void editExam();
    void deleteExam();
    void assignExaminer();
    void addNotification();
};

// ============================ UnregisteredUser Class ============================
class UnregisteredUser {
public:
    // Member functions
    void viewSupport();
    void viewPackage();
    void registerUser();
};

// ============================ Messages Class ============================
class Messages {
public:
    // Member function
    void storeMessages();
};

// ============================ Package Class ============================
class Package {
public:
    // Member functions
    void selectPackage();
    void stopPackage();
};

// ============================ Main Function ============================
int main() {
    // Composition Example: Exam contains a Paper object
    Paper paper1(101);
    Exam exam1(1, "Math", paper1);

    // Aggregation Example: Student has a pointer to a Paper
    Student student1(1, "John", 123456, "john@example.com", &paper1);

    // Association Example: Notification is associated with Student
    Notification notification1(1, "Your exam is due tomorrow");
    notification1.displayNotification();

    return 0;
}
