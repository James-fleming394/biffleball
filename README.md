# **Biffleball**

## **[Deployed Site]()**
🚀 Created by James Fleming  

## **Socials**  
[LinkedIn](https://www.linkedin.com/in/james--fleming/) | [GitHub](https://github.com/James-fleming394) | [Twitter](https://twitter.com/jflem394)  

📧 James.Fleming394@gmail.com  

---

## **Description**  
Biffleball is a competitive game where participants select a different Major League Baseball (MLB) team each week. The objective is to pick the team that will win the most games that week. Players accumulate wins over the season, competing for the highest score, bragging rights, and potential prizes.  

The backend powers the Biffleball platform, providing API endpoints for user authentication, team selections, standings, and game logic.

The frontend powers the user interface and design, giving users the access to play the game they love. 

📄 **[Design Document](https://docs.google.com/document/d/1wPYQMhZh-s0pEfC0loNywkKwJXTcIeEaepYe4GjCClA/edit?usp=sharing)**  

---

## **Table of Contents**  
- [Technology](#technology)  
- [Project Setup](#project-setup)  
- [Progress](#progress)  
- [Credits](#credits)  

---

## **Technology**  
The backend is built using:  
✅ `PHP` (Backend & API)  
✅ `MySQL` (Database)  
✅ `Apache/Nginx` (Server)  

---

## **Project Setup**  
To run the backend locally, follow these steps:

### **1. Clone the Repository**  
```bash
git clone https://github.com/James-fleming394/biffleball-backend.git
cd biffleball-backend
```

### **2. Configure Environment Variables**  
Copy `.env.example` to `.env` and update database credentials:  
```bash
cp .env.example .env
```

### **3. Install Dependencies**  
```bash
composer install
```

### **4. Set Up the Database**  
Run the migrations to set up the database schema:  
```bash
php artisan migrate
```

### **5. Start the Development Server**  
```bash
php -S localhost:8000 -t public
```

The API will now be accessible at **[http://localhost:8000](http://localhost:8000)**.  

---

## **Progress**  
✅ **Design Document Completed**  
🔲 **Backend Setup**  
🔲 **Database Design in Progress**  

---

## **Credits**  
- 📚 [MDN Web Docs](https://developer.mozilla.org/en-US/)  
- 🏫 [W3Schools](https://www.w3schools.com/)  
- 🤝 [Stack Overflow](https://stackoverflow.com/)  
- 💾 [MySQL Docs](https://dev.mysql.com/doc/)  

---