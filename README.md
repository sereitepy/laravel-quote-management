

# Laravel Quote Management API Project

Allows users to fetch random quotes from an external API, save their favorites, and manage them via CRUD operations with proper authentication.

## Setup Instructions

### I'm using:

- PHP 8.4.3
- Laravel Framework 12.2.0
- Composer 2.8.6
- MySQL (Port 8889) Ver 8.0.40 for macos12.7 on arm64 (Source distribution)
- MAMP Pro

### Installation Steps

1. Clone this repository to your local machine:
   ```bash
    git clone https://github.com/sereitepy/laravel-quote-management.git
    cd quote-management
   ```


2. My `.env` file:
   according to what my MAMP settings are.
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=8889
   DB_DATABASE=quote-management
   DB_USERNAME=root
   DB_PASSWORD=
   DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock
   ```

3. Run database migrations:
   ```bash
   php artisan migrate
   ```

4. Start the development server:
   ```bash
   php artisan serve
   ```
---
## Testing with Postman

### Important Notes! Really important!
- Set Headers `Accept: application/json` for **ALL** requests
- For authenticated endpoints, set Headers `Authorization: Bearer {your_token}` after logging in
- The random quotes endpoint may take around 5 seconds to respond as it fetches 10 quotes from an API that fetches 1 quote at a time. 'https://zenquotes.io/api/random'
<img width="858" alt="Screenshot 2025-03-15 at 1 31 06 in the afternoon" src="https://github.com/user-attachments/assets/619835ff-15fd-436f-ab71-de73df703683" />

---
### API Endpoints

#### Authentication
- **Register**: `POST http://127.0.0.1:8000/api/register`
  ```json
  {
    "name": "animalLover",
    "email": "ani@gmail.com",
    "password": "password123"
  }
  ```
<img width="840" alt="Screenshot 2025-03-15 at 1 32 26 in the afternoon" src="https://github.com/user-attachments/assets/ee002a99-1edc-4df9-8bb7-e932a31b61c1" />

- The database should include the user that has been registered. In this image, it should include:
  ```json
  {
    "user": {
        "name": "animalLover",
        "email": "ani@gmail.com",
        "updated_at": "2025-03-15T04:59:09.000000Z",
        "created_at": "2025-03-15T04:59:09.000000Z",
        "id": 4
    },
    "token": "3|U6vPECcKOb6l4q1lFInB3txz1NWWP2UVDkvVuIQw7c65ff5a"
  }
  ```
  
<img width="1280" alt="Screenshot 2025-03-15 at 1 33 18 in the afternoon" src="https://github.com/user-attachments/assets/a37986a3-4931-41c6-b79e-fa2879ced4a6" />

---
- **Login**: `POST http://127.0.0.1:8000/api/login`
  ```json
  {
    "email": "ani@gmail.com",
    "password": "password123"
  }
  ```
  **Important**: Save the token returned as it's required for all authenticated requests!
<img width="853" alt="Screenshot 2025-03-15 at 1 37 01 in the afternoon" src="https://github.com/user-attachments/assets/02361ba4-cecc-4736-b1b6-113227fc0da6" />

---
#### Quotes (Authenticated Routes)
- **Get Random Quotes**: `GET http://127.0.0.1:8000/api/quotes/random`
  - Note: This request takes around 5 seconds as it fetches 10 quotes
<img width="1137" alt="Screenshot 2025-03-15 at 1 38 30 in the afternoon" src="https://github.com/user-attachments/assets/dda0e7aa-fe2c-4f91-87f8-b19bef758646" />

---
- **Save a Quote**: `POST http://127.0.0.1:8000/api/quotes`
  ```json
  {
      "content": "We think too much and feel too little.",
      "author": "Charlie Chaplin"
  }
  ```
<img width="855" alt="Screenshot 2025-03-15 at 1 40 27 in the afternoon" src="https://github.com/user-attachments/assets/fca5a54f-fbe0-4136-a01e-c71c542c7fca" />

- The database should contain the saved quote
<img width="1236" alt="Screenshot 2025-03-15 at 1 41 13 in the afternoon" src="https://github.com/user-attachments/assets/5adff872-b599-4acc-8876-2eee86461f19" />

---
- **Get Saved Quotes**: `GET http://127.0.0.1:8000/api/quotes`
<img width="858" alt="Screenshot 2025-03-15 at 1 41 59 in the afternoon" src="https://github.com/user-attachments/assets/a737107b-b20c-4025-b13d-d4c00f1595cb" />

---
- **Delete a Quote**: `DELETE http://127.0.0.1:8000/api/quotes/{id}`
- The saved quote id is: 3
<img width="849" alt="Screenshot 2025-03-15 at 1 43 09 in the afternoon" src="https://github.com/user-attachments/assets/46e9f628-c200-465e-9e5d-d0866a842f5a" />

- Inside the database, the 'Quotes', should be empty.
<img width="1280" alt="Screenshot 2025-03-15 at 1 43 35 in the afternoon" src="https://github.com/user-attachments/assets/6a8b912e-8870-4e85-8b22-9f66c3b5c030" />

---
## Project Structure

- `app/Http/Controllers/` - Contains all the controllers
- `app/Models/` - Database models
- `database/migrations/` - Database migrations
- `routes/api.php` - API route definitions

## Features

- User registration and authentication using Laravel Sanctum
- Integration with ZenQuotes API to fetch random quotes 'https://zenquotes.io/api/random'
- CRUD operations for managing favorite quotes
- Form validation and error handling
- Token-based API authentication

## Security

This project implements:
- Password hashing using Laravel's built-in mechanisms
- Protected API routes using Sanctum middleware
- Input validation for all endpoints
- Protection against common vulnerabilities (CSRF, XSS, SQL Injection)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
