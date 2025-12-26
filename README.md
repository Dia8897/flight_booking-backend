# 🧠 Flight Management System
The Flight Management System is a comprehensive application designed to manage flights, passengers, and user roles. It provides a robust set of features for creating, reading, updating, and deleting (CRUD) flights and passengers, as well as managing user roles and permissions. The application is built using the Laravel framework and utilizes various packages, including Spatie Permission and Laravel Sanctum, to provide a secure and scalable solution.

## 🚀 Features
* **Flight Management**: Create, read, update, and delete flights
* **Passenger Management**: Create, read, update, and delete passengers
* **User Role Management**: Assign and manage user roles and permissions
* **Authentication**: Secure authentication using Laravel Sanctum
* **Authorization**: Role-based access control using Spatie Permission
* **API Endpoints**: Expose API endpoints for flights, passengers, and user roles
* **Rate Limiting**: Apply rate limiting to API endpoints to prevent abuse

## 🛠️ Tech Stack
* **Laravel**: PHP framework for building the application
* **Spatie Permission**: Package for managing user roles and permissions
* **Laravel Sanctum**: Package for secure authentication
* **Eloquent**: ORM system for interacting with the database
* **MySQL**: Database management system
* **Maatwebsite\Excel**: Package for working with Excel files

## 📦 Installation
To install the application, follow these steps:
1. Clone the repository using `git clone`
2. Run `composer install` to install dependencies
3. Run `php artisan migrate` to create the database tables
4. Run `php artisan db:seed` to seed the database with sample data
5. Run `php artisan serve` to start the development server

## 💻 Usage
To use the application, follow these steps:
1. Access the application using `http://localhost:8000`
2. Register a new user account using the registration form
3. Log in to the application using the login form
4. Access the flight management page to create, read, update, and delete flights
5. Access the passenger management page to create, read, update, and delete passengers
6. Access the user role management page to assign and manage user roles and permissions

## 📂 Project Structure
```markdown
app
├── Console
├── Exceptions
├── Http
│   ├── Controllers
│   │   ├── Api
│   │   │   ├── FlightController.php
│   │   │   ├── PassengerController.php
│   │   ├── Controller.php
│   ├── Kernel.php
│   ├── Middleware
│   ├── Requests
├── Models
│   ├── Flight.php
│   ├── Passenger.php
│   ├── User.php
├── Providers
│   ├── RouteServiceProvider.php
config
├── app.php
├── auth.php
├── database.php
├── permission.php
database
├── migrations
public
resources
├── views
routes
├── api.php
├── web.php
tests
vendor
```
