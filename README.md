# WebDevelopmentProject
Developed a Basic Banking Website.
#  Basic Banking System

## Index
- [Description]
- First Time Installation
- How To Run


## Description:Name of Project:   "Bank Management System Project"
Language:PHP
Databases used:MySQL
Design used:HTML JavaScript,Bootstrap
Browser used: Google Chrome
Software used:XAMPP

- This project is built on HTML/CSS, Bootstrap, PHP and MySQL.
- Details of Customers are maintained as `Name`, `Email`, `Amount` are fields.
 

## First Time Installation
- Clone the Repository.
- Make sure you have installed XAMP on your computer.
- Copy this folder (bank) to XAMP installation Directory and then inside htdocs folder.

```
For Example
C:\xampp\htdocs\
```
- Open Xamp Control Panel. Click on Start button near Apache and MySQL.
- Open PHPMyAdmin (http://localhost/phpmyadmin)
- Open a browser and go to URL “http://localhost/phpmyadmin/”
- Click on the databases tab
-Create a database naming “mybank
- Open browser type the following into search bar.
```
http://localhost/bank/login.php
```
- If everything works fine you would see this on your browser.
```
Conection was established Succesfully.
DATABASE Created Successfully.
Customer Table Created Successfully.
Entries added to table Successfully.
Transaction Table Created Successfully.
```
- This means that you have created a database name mybank, a table name customers also added 10 entries to table and finally creating a table name Transaction.
- You will land to Homepage of Bank Website.
- Login Credentials: Utilize the following credentials to access different user roles:
Manager:
Username: manager@manager.com
Password: manager
Cashier:
Username: cashier@cashier.com
Password: cashier
User:
Username: some@gmail.com
Password: some
<img width="1873" height="997" alt="Screenshot 2025-07-11 102439" src="https://github.com/user-attachments/assets/dccb0253-2302-4923-b995-f4e8ebd4a513" />
<img width="1841" height="987" alt="Screenshot 2025-07-11 102703" src="https://github.com/user-attachments/assets/fe324d5c-a6d3-4046-839c-b059d7ba7b43" />
<img width="1918" height="946" alt="Screenshot 2025-07-11 102812" src="https://github.com/user-attachments/assets/9f31170b-b4d8-4f6f-b285-557fd88bbc90" />

- Click On `View all Customer` from Navigation OR `Get Started` button for viewing detail of all Customers.
- You will see Customer details in table with deatils like(Name, Email, Current balance, etc.).
- Click on `Send` Button Corresponding Any row of table.
- Now We are on Money Transfering Page. Now Enter a Valid Name in `To` textbox and also Enter Amount, Click on checkbox and finally Click on `Send` Button To Start Transfer.
- Make sure the Amount you enter is not grator then current balance of the Person Selected, else it will pop Message.
- If the Transaction is successful Message will displayed and Changes made by above Transaction will be updated to customer table. 
