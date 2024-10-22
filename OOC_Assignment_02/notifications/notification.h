#pragma once
#include<iostream>
#include <string>
using namespace std;

class Notification{
    protected:
        int Notification_ID;
        string Message;
    public:
        void displayNotification();
};
