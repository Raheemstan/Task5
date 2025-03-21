# **Exam & Result Processing System with Automated Grading**  

## **📖 Overview**  

This system allows teachers to create and manage exams, students to take exams, and results to be processed automatically based on school-defined grading criteria.  

---

## **🚀 Features**  

### **🔹 Teachers Can Create Exam Papers**  

- Each question has a **different mark assigned**.  
- Supports **multiple-choice questions** with a correct answer.  

### **🔹 Automated Result Processing**  

- System calculates **total score** and assigns **grades (A, B, C, etc.)**.  
- Uses **school-defined grading criteria** from settings.  

### **🔹 Remedial Class Flagging**  

- Students who **fail more than 2 subjects** are **flagged for remedial classes**.  
- Flags are automatically removed if the student later meets the passing criteria.  

### **🔹 Student Exam Login**  

- Students **enter their email & exam ID** to start an exam.  
- Only valid **registered students** can access an exam.  

### **🔹 Exam Result Page**  

- Displays **total score, grade, and pass/fail status**.  
- Shows **correct answers** for review.  

### **🔹 Notifications**  

- Students flagged for **remedial classes receive an email notification**.  
- Admins can view a list of **students requiring extra classes**.  

---

## **🛠️ Installation & Setup**  

### **1️⃣ Clone the Repository**  

```sh
git clone https://github.com/Raheemstan/Task5.git
cd Task5
composer install
```

### **2️⃣ Configure the Environment**  

Copy `.env.example` to `.env` and set up the database:  

```sh
cp .env.example .env
php artisan key:generate
```

### **3️⃣ Set Up the Database**  

Run migrations and seed default settings:  

```sh
php artisan migrate --seed
```

### **4️⃣ Start the Application**  

```sh
php artisan serve
```

---

## **🔗 Routes & API Endpoints**  

### **🔹 Authentication Routes**  

| Method | Route                | Description                    |
|--------|----------------------|--------------------------------|
| GET    | `/exam/login`        | Show the student exam login form |
| POST   | `/exam/authenticate` | Verify student and exam ID |

### **🔹 Exam Management**  

| Method | Route                  | Description                |
|--------|------------------------|----------------------------|
| GET    | `/exams`               | List all exams             |
| GET    | `/exams/create`        | Show exam creation form    |
| POST   | `/exams/store`         | Store new exam             |
| GET    | `/exams/{exam}`        | View a specific exam       |
| DELETE | `/exams/{exam}/delete` | Delete an exam             |

### **🔹 Exam Taking & Result Processing**  

| Method | Route                | Description                        |
|--------|----------------------|------------------------------------|
| GET    | `/exam/login` | Login to exam usig studet emai and exam id                     |
| GET    | `/exam/{exam}/start` | Start an exam                     |
| POST   | `/exam/{exam}/submit` | Submit answers and process grading |
| GET    | `/exam/{exam}/result` | Show student result page           |

---

## **📊 Grading System**  

The grading system is configurable via the **Settings Page**.  

| Grade | Minimum Score |
|-------|--------------|
| A     | 90          |
| B     | 80          |
| C     | 70          |
| D     | 60          |
| F     | 0           |

Grades are applied automatically when an exam is submitted.

---

## **💡 Remedial Class Logic**  

- If a student **fails more than 2 subjects**, they are **flagged for remedial classes**.  
- If the student later **passes enough subjects**, the flag is **automatically removed**.  

---

## **🔔 Notification System**  

- **When a student is flagged for remedial classes**, they receive an email.  
- **Admins can review all flagged students** from the system dashboard.  

---

## **✅ Next Steps & Enhancements**  

1️⃣ **Improve Student Performance Tracking**  
2️⃣ **Allow Students to Review Their Past Exam Attempts**  
3️⃣ **Add Timed Exams Feature** (Auto-submit after a certain duration)  

---

### **📌 Summary**  

✅ **Exams can be created and taken**  
✅ **Grades are assigned based on a flexible grading system**  
✅ **Students who fail too many subjects are flagged**  
✅ **Notifications are sent when remedial action is needed**  

---
