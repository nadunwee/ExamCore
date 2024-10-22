#include <iostream>
#include <string>

using namespace std;

// ============================ Account Class ============================
class Account {
protected:
    string user_name;
    string address;
    int phNo;
    string emailAddress;
    string password;

public:
    Account() {};
    Account(string name, string adres, int phone, string email, string pw)
        : user_name(name), address(adres), phNo(phone), emailAddress(email), password(pw) {}

    virtual void createAccount() {}
    virtual void setAccountDetails() {}
    virtual void loginAccount() {}
    virtual void deleteAccount() {}

    ~Account() {}
};

// ============================ Customer Class ============================
class Payment; // Forward declaration
class Order;

class Customer : public Account {
protected:
    int customerId;
    Payment* pay[2];
    Order* orders[2];

public:
    Customer() {};
    Customer(int id) : customerId(id) {}

    void searchProduct() {}
    void makePayments() {}
    void placeOrder() {}
    void cancelOrder() {}

    ~Customer() {}
};

// ============================ Seller Class ============================
class Product; // Forward declaration

class Seller : public Account {
protected:
    int sellerId;
    Product* product[2];

public:
    Seller() {};
    Seller(int id) : sellerId(id) {}

    void restock() {}
    void receivePayment() {}
    void addProduct(Product* product1) {}

    ~Seller() {}
};

// ============================ Admin Class ============================
class Admin : public Account {
protected:
    int adminId;

public:
    Admin() {};
    Admin(int id) : adminId(id) {}

    void addNewItem() {}
    void assignOrder() {}

    ~Admin() {}
};

// ============================ Deliverer Class ============================
class Deliverer : public Account {
protected:
    int delivererId;
    Order* order[2];

public:
    Deliverer() {};
    Deliverer(int id) : delivererId(id) {}

    void deliver() {}
    void acceptOrder() {}
    void rejectOrder() {}
    void addOrderDetails(Order* order1) {}

    ~Deliverer() {}
};

// ============================ Sales Manager Class ============================
class Advertiser; // Forward declaration

class SalesManager : public Account {
protected:
    int salesManagerId;
    Advertiser* advertisers[2];

public:
    SalesManager() {};
    SalesManager(int id) : salesManagerId(id) {}

    void hireAdvertiser() {}
    void approvePayment() {}
    void addAdvertisers(Advertiser* advertiser1) {}

    ~SalesManager() {}
};

// ============================ Product Class ============================
class Product {
private:
    int productId;
    string productName;
    string productDescription;
    float productPrice;
    int quantity;
    Order* order[1];  // for a example only, we can have many objects
    Seller* sell[2];

public:
    Product() {};
    Product(int id, string name, string description, float price, int qty, int oid, int oqty, string ostatus)
        : productId(id), productName(name), productDescription(description), productPrice(price), quantity(qty) {
        order[0] = new Order(oid, oqty, ostatus);
    }

    void updateAvailability() {}
    void add() {}
    void restock() {}

    ~Product() {
        for (int i = 0; i < 1; i++) {
            delete order[i];
        }
    }
};

// ============================ Payment Class ============================
class Payment {
private:
    int paymentId;
    float paymentAmount;
    string paymentStatus;
    string paymentDate;
    Customer* customers[2];
    Order* orders[2];

public:
    Payment() {};
    Payment(int id, float amount, string status, string date)
        : paymentId(id), paymentAmount(amount), paymentStatus(status), paymentDate(date) {}

    void make() {}
    void receive() {}
    void beApproved() {}
    void addCustomerDetails(Customer* customer1) {}
    void addOrderDetails(Order* order) {}

    ~Payment() {}
};

// ============================ Order Class ============================
class Order {
protected:
    int orderId;
    int orderQuantity;
    string orderStatus;
    Customer* customers[2];
    Payment* payments[2];
    Deliverer* deliverers[2];

public:
    Order() {};
    Order(int id, int qty, string status) : orderId(id), orderQuantity(qty), orderStatus(status) {}

    void getOrderDetails() {}
    void addCustomerDetails(Customer* customer1) {}

    ~Order() {}
};

// ============================ Advertiser Class ============================
class Advertiser {
protected:
    int advertiserId;
    string advertiserName;
    string advertiserAddress;
    int advertiserPhoneNo;
    string advertiserEmail;
    SalesManager* salesManagers[2];

public:
    Advertiser() {};
    Advertiser(int id, string name, string address, int phone, string email)
        : advertiserId(id), advertiserName(name), advertiserAddress(address), advertiserPhoneNo(phone), advertiserEmail(email) {}

    void createAd() {}

    ~Advertiser() {}
};

// ============================ Main Function ============================
int main() {
    Account* a1 = new Account("John Doe", "123 Main St", 1234567890, "johndoe@example.com", "password123");
    Customer* c1 = new Customer(1001);
    Seller* s1 = new Seller(2001);
    Admin* a2 = new Admin(3001);
    Deliverer* d1 = new Deliverer(4001);
    SalesManager* sm1 = new SalesManager(5001);
    Product* p1 = new Product(10001, "Laptop", "High-performance laptop", 1500.00, 10, 6001, 2, "Shipped");
    Payment* pay1 = new Payment(7001, 1500.00, "Completed", "2024/10/22");
    Advertiser* adv = new Advertiser(8001, "Jane Smith", "456 Market St", 9876543210, "jane.smith@ads.com");
    Order* o1 = new Order(9001, 2, "Delivered");

    pay1->addCustomerDetails(c1);
    sm1->addAdvertisers(adv);
    o1->addCustomerDetails(c1);
    pay1->addOrderDetails(o1);
    s1->addProduct(p1);
    d1->addOrderDetails(o1);

    return 0;
}
