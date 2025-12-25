# 🏷️ VAULT – E-Auction System

VAULT is a PHP-based online auction platform that allows users to participate in auctions and place bids, while administrators can create, manage, and monitor auction listings through a secure admin interface.

---

## 📌 Features

### 👤 User Features
- User authentication (login system)
- Secure session-based access
- View available auctions
- Place bids on auctions

### 🛠️ Admin Features
- Admin authentication
- Create and manage auctions
- View bids placed by users
- Control auction listings

---

## 🧱 Tech Stack
- **Frontend:** HTML, CSS, Bootstrap, JavaScript  
- **Backend:** PHP (PDO)  
- **Database:** MySQL  
- **Server:** Apache (XAMPP)  
- **Version Control:** Git & GitHub  

---

## 📂 Project Structure

```
VAULT-E-Auction/
├── admin/
│   ├── create_auction.php
│   ├── save_auction.php
│   └── view_bids.php
│
├── config/
│   └── database.example.php
│
├── css/
│   ├── bootstrap.min.css
│   └── style.css
│
├── img/
│   └── (project images)
│
├── index.php
├── login.php
├── bid.php
├── about.php
├── contact.php
├── nav.php
└── README.md


🔐 Authentication Logic
Passwords are stored using MD5 hashing

Login validation is handled via PHP sessions

Admin access is controlled using the is_admin flag in the database

▶️ How to Run Locally

Install XAMPP
Start Apache and MySQL

Copy the project folder to:
C:\xampp\htdocs\

Import the database using phpMyAdmin

Open your browser and visit:
http://localhost/auction/index.php

🚀 Future Enhancements
1.Replace MD5 with password_hash() for stronger security
2.More advance features
3.Email notifications
4.Advanced admin analytics

👨‍💻 Author
Aryan Shete
GitHub: https://github.com/Aryanshete
