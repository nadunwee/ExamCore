#include <iostream>
using namespace std;
#include "notification.h"

void Notification::displayNotification() {
    cout<<"Notification ID: "<< Notification_ID<<endl;
    cout<<"Notification : "<< Message <<endl;
};