#include <iostream>
#include "notification.h"
using namespace std;

void Notification::displayNotification() {
    cout<<"Notification ID: "<< Notification_ID<<endl;
    cout<<"Notification : "<< Message <<endl;
};