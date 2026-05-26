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

<img width="1551" height="740" alt="image" src="https://github.com/user-attachments/assets/a0500e5d-2c49-4e0a-9b58-bb4abcece61c" />


<img width="1584" height="793" alt="image" src="https://github.com/user-attachments/assets/fa9db9e7-0b9b-4577-a50e-d0c94e0434cd" />

<img width="1602" height="890" alt="image" src="https://github.com/user-attachments/assets/0337c0f6-1330-4d50-93c7-cad4533bf699" />


<img width="1789" height="885" alt="image" src="https://github.com/user-attachments/assets/d71b5e00-9ba4-4453-ad55-330e7e4547f9" />

<img width="1708" height="875" alt="image" src="https://github.com/user-attachments/assets/e00337cd-d649-463b-8eae-e3974ca021dd" />

<img width="1555" height="886" alt="image" src="https://github.com/user-attachments/assets/b116c3b6-9081-487f-afad-975ea1ef4713" />

<img width="1598" height="843" alt="image" src="https://github.com/user-attachments/assets/403bf3cc-04b3-45bb-917b-a039708e4e2a" />



