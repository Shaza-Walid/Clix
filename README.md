# 🌐 Clix - Posts Website

A simple full-stack web application that allows users to register, login, create posts, like posts, and manage their profile.

---

## 🚀 Features

* 🔐 User Authentication (Signup & Login)
* 📝 Create Posts
* ❤️ Like Posts
* 👤 User Profile (View your posts)
* ✏️ Edit Posts
* 🗑️ Delete Posts
* 📊 Dynamic post loading using JavaScript (Fetch API)

---

## 🛠️ Technologies Used

Frontend:

* HTML5
* CSS3
* JavaScript (Fetch API)

Backend:

* PHP (Core PHP)
* MySQL (Database)

Environment:

* Laragon (Local Server)

---

## 📂 Project Structure

clix/
│
├── connect.php
├── login.php
├── signup.php
├── profile.php
├── posts.php
├── like.php
├── delete.php
├── edit.php
│
├── login.html
├── signup.html
├── profile.html
├── posts.html
├── home.html
│
├── login.js
├── signup.js
├── profile.js
├── posts.js
│
├── style.css
└── README.md

---

## ⚙️ Setup Instructions

1. Clone the repository:
   git clone https://github.com/Shaza-Walid/Clix.git

2. Move the project folder to:
   C:\laragon\www\

3. Start Laragon and open:
   http://localhost/clix

4. Create a MySQL database named:
   clix

5. Import your database tables (users, posts, likes)

---

## 🗄️ Database Tables

users:

* id
* username
* email
* password

posts:

* id
* user_id
* content
* created_at

likes:

* id
* user_id
* post_id

---

## 💡 How It Works

* User signs up → automatically logged in (session created)
* User creates posts → stored in database
* All posts appear on home page
* Users can like posts (only once)
* Profile page shows only user's posts
* User can edit or delete their posts

---

## 📌 Future Improvements

* 💬 Add comments system
* 🔁 Like/Unlike toggle
* 🔐 Password hashing (security)
* 📱 Responsive design
* 🔎 Search functionality

---

## 👩‍💻 Author

Shaza Walid

---

## ⭐ If you like this project

Give it a star ⭐ on GitHub!
