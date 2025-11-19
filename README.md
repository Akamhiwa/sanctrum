Laravel Sanctum Authentication API

A clean and simple Laravel-based REST API implementing secure token authentication using Laravel Sanctum.
This project includes basic authentication features such as registration, login, logout, and user profile management.

🚀 Project Overview

This project provides a lightweight API authentication system using Laravel Sanctum. It is designed for mobile apps, SPAs, or any front-end client that needs secure token-based authentication.
It includes essential endpoints for managing user sessions and accessing protected routes.

✅ Features

🔐 User Registration

🔑 User Login

🚪 User Logout

👤 Authenticated User Profile

🛡️ Token-based authentication using Laravel Sanctum

🔒 Protected API routes for logged-in users only

🛠️ Tech Stack

Laravel (Latest Version)

Laravel Sanctum

MySQL (or any preferred database)

PHP 8+

Composer

📌 Requirements

Before installing, ensure your machine has:

PHP 8.1+

Composer

MySQL / MariaDB

Laravel CLI (optional but recommended)

Postman / Thunder Client (for testing)

⚙️ Installation
# 1. Clone the repository
git clone https://github.com/your-username/your-repo.git

# 2. Enter the project folder
cd your-repo

# 3. Install dependencies
composer install

# 4. Copy environment file
cp .env.example .env

# 5. Generate app key
php artisan key:generate

# 6. Configure your database in .env
# Then run migrations:
php artisan migrate

# 7. Install Sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

▶️ Running the Project
php artisan serve


API will be available at:

http://127.0.0.1:8000

🌍 Environment Setup (.env)

Update your .env with your database configuration:

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:xxxxxxx
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sanctum_api
DB_USERNAME=root
DB_PASSWORD=

📡 API Endpoints
Authentication Endpoints
Method	Endpoint	Description	Auth Required
POST	/api/register	User registration	❌ No
POST	/api/login	User login (token)	❌ No
POST	/api/logout	Logout & revoke token	✅ Yes
GET	/api/profile	Get authenticated user	✅ Yes
📘 Example API Requests
Register User
POST /api/register
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password",
  "password_confirmation": "password"
}

Login
POST /api/login
{
  "email": "john@example.com",
  "password": "password"
}

Profile

(Requires Bearer token)

GET /api/profile
Authorization: Bearer your_token_here

Logout
POST /api/logout
Authorization: Bearer your_token_here

🔒 How Sanctum Authentication Works (Brief)

Laravel Sanctum provides a simple token-based authentication system:

When a user logs in, Sanctum generates a personal access token.

The client stores the token and sends it in the Authorization: Bearer header.

Sanctum validates the token and authenticates the request.

Tokens can be revoked on logout, enhancing session security.

Sanctum is ideal for:

SPAs (React, Vue, Next.js)

Mobile apps

External API consumers

🧪 Testing with Postman / Thunder Client

Import the endpoints manually or create a collection.

For authenticated routes:

Login first → copy the returned token.

Add it to headers:

Authorization: Bearer your_generated_token


Then test /api/profile and /api/logout.

📄 License

This project is open-source and available under the MIT License.
