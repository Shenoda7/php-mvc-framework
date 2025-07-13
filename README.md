# Custom PHP MVC Framework

This is a simple, extensible PHP MVC framework built with reusable core logic and a clean folder structure. It includes routing, controllers, views, middlewares, migrations, and form handling.

---

## Installation & Setup

### 1. **Clone the Repository**

```bash
git clone git@github.com:Shenoda7/php-mvc-framework.git
cd php-mvc-framework
```

### 2. **Install Dependencies**

Ensure you have Composer installed, then run the following command to install the required dependencies, including the core package `shenoda/php-mvc-reusable-core`:

```bash
composer install
```

The `composer.json` file is preconfigured to include the necessary dependencies:

```json
{
    "name": "shenoda/implemnt-mvc-framework",
    "authors": [
        {
            "name": "Shenoda",
            "email": "shenodamakramibrahim@gmail.com"
        }
    ],
    "require": {
        "vlucas/phpdotenv": "^5.6",
        "shenoda/php-mvc-reusable-core": "^1.0"
    },
    "autoload": {
        "psr-4": {
            "app\\": "./"
        }
    }
}
```

### 3. **Configure Environment**

Copy the `.env.example` file to create a `.env` file:

```bash
cp .env.example .env
```

Edit the `.env` file to configure your database connection. The default `.env.example` includes:

```
DB_DSN="mysql:host=localhost;port=3306;dbname=mvc_framework"
DB_USER="root"
DB_PASSWORD=
```

Update the `DB_DSN`, `DB_USER`, and `DB_PASSWORD` to match your database setup.

### 4. **Set Up the Database**

The framework includes a `migrations.php` file for managing database schema migrations. To apply the migrations and set up your database, run:

```bash
php migrations.php
```

Ensure your database is running and the credentials in the `.env` file are correct before executing migrations.

### 5. **Serve the Application**

Use PHP's built-in server to run the application locally:
but first enter the public/

```bash
cd public
php -S localhost:8080
```

Open your browser and navigate to `http://localhost:8080` to access the application.

---

## Contributing

Contributions are welcome! Please fork the repository, create a feature branch, and submit a pull request.

1. Fork the repository.
2. Create a new branch: `git checkout -b feature-name`.
3. Commit your changes: `git commit -m "Add feature-name"`.
4. Push to the branch: `git push origin feature-name`.
5. Submit a pull request.

---

