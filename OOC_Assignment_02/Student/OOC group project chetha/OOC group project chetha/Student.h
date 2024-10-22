#pragma once
#include <iostream>
#include "Student.cpp"
using namespace std;

class student {
private:
	int Student_ID;
    string Name;
    int PhoneNo;
    string Email;
public:
    student(int Student_ID, string Name, int PhoneNo,string Email);
	void attemptExams();
    void answerQuestions();
    void sendSupportRequests();
    void manageProfile();
    void viewNotification();
    ~student();
};

