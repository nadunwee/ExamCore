#include <iostream>
#include "Student.h"
#include "Student.cpp"
using namespace std;

int main(void)
{
    student *s1= new student(1,"Chetha",+94704366825,"chethaatapattu@gmail.com");
    
    delete s1;
    return 0;
}