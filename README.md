# 🚀 Task Management System API (Laravel 11)

A robust, production-ready RESTful API built with **Laravel 11** and **Laravel Sanctum**. This application provides complete backend functionality for managing projects and tasks, featuring authentication, role-ready architecture, dynamic status filtering, and file attachments.

---

## ✨ Features

- **🔐 Authentication & Security:** Secure registration and login issuing Bearer Tokens via **Laravel Sanctum**.
- **📁 Project Management:** Full CRUD operations for organizing projects under authenticated users.
- **📋 Task Tracking:** Assign tasks to specific projects with statuses (`pending`, `in_progress`, `completed`) and due dates.
- **📎 File Attachments:** Multipart file upload handling for task attachments (stored securely in `storage/app/public`).
- **🔍 Advanced Filtering:** Dynamic query filtering for tasks based on their status via API endpoints.
- **🛡️ Request Validation & Errors:** Custom API error responses with standard HTTP status codes (`401`, `422`, `404`).

---

## 🛠️ Tech Stack

- **Framework:** Laravel 11.x
- **Language:** PHP 8.2+
- **Authentication:** Laravel Sanctum
- **Database:** SQLite / MySQL
- **API Testing:** Postman

---

## 🚀 Quick Setup Guide

### 1. Clone the repository
```bash
git clone [https://github.com/Hassanmekawy/task-management-api.git](https://github.com/Hassanmekawy/task-management-api.git)
cd task-management-api