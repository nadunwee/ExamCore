#pragma once
#include<iostream>
#include './Student/Student.h' // fix file name
#include './examPaper/paper.h'  // fix name
using namespace std;
#define size 2

class Exam{
    private:
        Student * students[size];
        paper * papers[size];
    protected:
        int Exam_ID;
        string Subject;

    public:
        void displayExam();
        Exam(){}
        void addStudents(Student*s1,Student*s2){
            students[0]=s1;
            students[1]=s2;
        }
        Exam(){
            papers[0]=new paper();
            papers[1]=new paper();
        }
        Exam(no1,no2){
            papers[0]=new paper(no1);
            papers[1]=new paper(no2);
        }
        ~Exam(){
            delete papers[0];
            delete papers[1];
        }

};
