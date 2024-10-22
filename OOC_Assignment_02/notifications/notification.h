#pragma once
#include<iostream>
using namespace std;

class Notification{
    protected:
        int Notification_ID;
        string Message;
    public:
        void displayNotification();
};
