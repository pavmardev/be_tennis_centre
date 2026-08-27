# 🎾 TennisReserve – Backend

A RESTful API powering the TennisReserve online tennis court reservation platform. This repository contains the backend service built with **Laravel**, utilizing **Laravel Sanctum** for secure, token-based authentication. This project is a fictional reservation system created for educational purposes and software engineering skill enhancement.

---

## Features
Finished API will provide services for:
- User registration, login, and token management via Laravel Sanctum
- Stateless authentication and role-based authorization
- User profile management
- Tennis court booking engine with optional equipment add-ons
- Fictional membership processing to unlock reservation privileges
- Redis/Cache layer for optimized query performance

## 🛠 Tech Stack

* **Laravel 12**
* **Laravel Sanctum** (API Token Authentication)
* **PHP 8.2+**
* **MySQL**
* **Composer**

---

## 📋 Prerequisites

Ensure you have the following installed on your local environment:
* PHP >= 8.2
* Composer
* Database engine (MySQL / PostgreSQL / SQLite)

---

## 🚀 Getting Started

Follow these steps to set up and run the backend API locally.

### 1. Clone the Repository

```bash
git clone https://github.com/pavmardev/be_tennis_centre.git
cd be_tennis_centre
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

Copy the example environment file and generate the application encryption key:

```bash
cp .env.example .env
php artisan key:generate
```
Open the .env file and configure your local database connection variables (DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).
```

### 4. Run Migrations & Seeders

Set up the database tables and populate sample data:

```bash
php artisan migrate --seed
```

### 5. Start Development Server

```bash
php artisan serve
```

The API server will run at `http://127.0.0.1:8000`.

---

## 📝 Authors

Pavol Marko
