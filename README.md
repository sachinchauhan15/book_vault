# Books Management API

Simple Laravel 11 project with JWT authentication, Books CRUD API, MySQL, and a small browser UI.

## Features

- User register and login with JWT token
- Protected profile API
- Protected Books CRUD API
- Search books by title or author
- Pagination
- Form Request validation
- API Resources
- Soft delete for books
- Optional cover image upload
- Seeder, factory, Postman collection, and SQL schema dump

## Tech Stack

- Laravel 11
- PHP 8.2+
- MySQL
- Eloquent ORM
- `php-open-source-saver/jwt-auth`

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
```

Create database:

```sql
CREATE DATABASE book_vault;
```

Update `.env`:

```env
DB_DATABASE=book_vault
DB_USERNAME=your_mysql_user
DB_PASSWORD=your_mysql_password
```

Run project:

```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Open UI:

```text
http://127.0.0.1:8000
```

Demo login after seeding:

```text
Email: demo@example.com
Password: Password123
```

## API Endpoints

### Auth

| Method | URL | Auth |
| --- | --- | --- |
| POST | `/api/auth/register` | No |
| POST | `/api/auth/login` | No |
| GET | `/api/auth/profile` | Yes |

### Books

| Method | URL | Auth |
| --- | --- | --- |
| GET | `/api/books?search=harry&page=1` | Yes |
| POST | `/api/books` | Yes |
| GET | `/api/books/{id}` | Yes |
| PUT | `/api/books/{id}` | Yes |
| DELETE | `/api/books/{id}` | Yes |

## Main Files To Explain

- `routes/api.php`: API routes
- `routes/web.php`: browser UI route
- `app/Http/Controllers/Api/AuthController.php`: register, login, profile
- `app/Http/Controllers/Api/BookController.php`: book CRUD logic
- `app/Models/User.php`: JWT user model
- `app/Models/Book.php`: book model, search scope, soft delete
- `app/Http/Requests/*`: validation rules
- `app/Http/Resources/*`: JSON response formatting
- `resources/views/books-ui.blade.php`: simple UI
- `database/migrations/*`: database tables

## Postman

Import:

```text
postman/Books_Management_API.postman_collection.json
```

Set:

```text
base_url=http://127.0.0.1:8000
```

Some Demo UI screenshot for reference:

<img width="1742" height="777" alt="image" src="https://github.com/user-attachments/assets/bb0c49a0-0a71-4fba-bbae-880f3c10bc34" />


<img width="1749" height="894" alt="image" src="https://github.com/user-attachments/assets/e43d6ccb-7953-4d6a-8861-c7471e72f30e" />


<img width="1524" height="761" alt="image" src="https://github.com/user-attachments/assets/7e588184-9b5e-4a62-82a5-16d4928d7a25" />


