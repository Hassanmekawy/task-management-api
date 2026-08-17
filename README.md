# Task Management System API (Laravel 11)

A production-style RESTful API for managing projects and tasks, built with **Laravel 11** and **Laravel Sanctum**. Includes authentication, project/task CRUD, status filtering, and file attachments.

## Features

- **Authentication & Security** – Registration and login issuing Bearer tokens via Laravel Sanctum.
- **Project Management** – Full CRUD for projects scoped to the authenticated user.
- **Task Tracking** – Tasks assigned to projects with statuses (`pending`, `in_progress`, `completed`) and due dates.
- **File Attachments** – Multipart file upload for task attachments, stored in `storage/app/public`.
- **Advanced Filtering** – Query tasks dynamically by status.
- **Validation & Error Handling** – Standardized API error responses (`401`, `422`, `404`).

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 11.x |
| Language | PHP 8.2+ |
| Auth | Laravel Sanctum |
| Database | MySQL / SQLite |
| API Testing | Postman |

## Getting Started

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL or SQLite

### Installation

```bash
git clone https://github.com/Hassanmekawy/task-management-api.git
cd task-management-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve
```

## API Endpoints

| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/register` | Register a new user |
| POST | `/api/login` | Authenticate and receive a Bearer token |
| GET/POST | `/api/projects` | List / create projects |
| GET/PUT/DELETE | `/api/projects/{id}` | Show / update / delete a project |
| GET/POST | `/api/tasks` | List / create tasks (supports `?status=` filter) |
| PUT/DELETE | `/api/tasks/{id}` | Update / delete a task |
| POST | `/api/tasks/{id}/attachments` | Upload a file attachment to a task |

## Postman Collection

A Postman collection with all endpoints and example requests is available at: `docs/postman_collection.json` *(add link once exported)*.

## License

This project is open-sourced for portfolio and learning purposes.
