#pragma once
#include <iostream>
using namespace std;

class Allprofiles
{
protected:
	string name;
	string address;
	int phoneNo;
	string email;
	string password;
public:
	Allprofiles(){}
	Allprofiles(string userName, string adrs, int pNo, string emailAdrs, string pwd) {
		name = userName;
		address = adrs;
		phoneNo = pNo;
		email = emailAdrs;
		password = pwd;
	};
	void loginAccount();
	void createAccount();
	void deleteAccount();
	~Allprofiles();
};

