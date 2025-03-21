# Exam Management System Documentation

## Features

✅ **Teacher Features**

- Create, edit, and delete exams
- Manage questions with multiple-choice options
- Set correct answers and assign scores

✅ **Student Features**

- Login using **email and exam ID**
- Take exams with real-time validation
- Submit answers and receive instant results

✅ **Exam Processing**

- Auto-grading based on correct answers
- Store student responses securely
- Pass/Fail calculation based on settings

✅ **Admin Features**

- Configure exam settings (passing score, time limits, etc.)
- Enable/Disable exams dynamically

---

## Installation

### 1. Clone Repository

```sh
    git clone https://github.com/Raheemstan/Task5.git
    cd Task5
```

### 2. Install Dependencies

```sh
    composer install
    npm install
    npm run dev
```

### 3. Configure Environment

Copy `.env.example` to `.env` and update database settings:

```sh
    cp .env.example .env
    php artisan key:generate
```

### 4. Run Migrations & Seed Database

```sh
    php artisan migrate --seed
```

### 5. Start Server

```sh
    php artisan serve
```

---

## Database Schema

### **Tables:**

- **users**: Stores teacher/admin credentials
- **students**: Stores student emails for exam login
- **exams**: Contains exam details (name, subject, date, etc.)
- **questions**: Stores multiple-choice questions and correct answers
- **exam_results**: Stores student scores after taking exams
- **settings**: Stores configurable exam settings (passing score, time limit, etc.)

---

## Routes

### **Authentication & Exam Access**

| Method | URI | Description |
|--------|-----|-------------|
| GET | `/exam/login` | Show student login page |
| POST | `/exam/authenticate` | Validate student and exam ID |
| GET | `/exam/{exam}/start` | Start the exam |
| POST | `/exam/{exam}/submit` | Submit answers & auto-grade |
| GET | `/exam/{exam}/result` | View exam results |

### **Teacher & Admin Routes**

| Method | URI | Description |
|--------|-----|-------------|
| GET | `/exams` | List all exams |
| GET | `/exams/create` | Create a new exam |
| POST | `/exams/store` | Store exam in database |
| GET | `/exams/{exam}/questions` | Manage questions for an exam |
| POST | `/exams/{exam}/questions/store` | Add questions to an exam |
| PUT | `/questions/{question}` | Update a question |
| DELETE | `/questions/{question}` | Delete a question |
| GET | `/settings` | View exam settings |
| PUT | `/settings/update` | Save exam settings |

---

## Exam Workflow

1. **Admin creates an exam** and sets the passing score/time limit.
2. **Teacher adds questions** (at least 2 required, max 4 choices).
3. **Students log in** using email & exam ID.
4. **Students take the exam** by selecting answers.
5. **Upon submission**, the system:
   - Grades automatically ✅
   - Stores results ✅
   - Displays Pass/Fail based on settings ✅
6. **Admin & Students can view results.**

---

## Logging & Error Handling

- **All key actions are logged** (`storage/logs/laravel.log`)
- **Unauthorized access attempts are logged**
- **Exam authentication failures trigger warnings**
- **Validation errors return detailed feedback**

---

## Future Enhancements

- **Timer-based exams** ⏳
- **Detailed answer review for students** 📖
- **Question randomization** 🔀
- **CSV Import/Export for exam data** 📂

---
