#pragma once
#include <iostream>
#include "./profile/Allprofiles.h"
using namespace std;

class Admin : public Allprofiles
{
protected:
	int adminId;

public:
	Admin(){}
	Admin(int id) {
		adminId = id;
	};
	void addAnExam();
	void editExam();
	void deleteExam();
	void assignExaminer();
	void addNotifications();
	~Admin();
};

