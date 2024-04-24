# Installation

## Prerequisites

-   PHP 8.3
-   Composer
-   Node.js
-   NPM
-   MySQL

## Installation

1. Clone the repository and navigate into the directory

```bash
git clone https://github.com/carlosupreme/futbolpass.git
cd futbolpass
```

2. Install PHP dependencies

```bash
composer install
```

3. Install Javascript dependencies

```bash
npm install
```

4. Create the `.env` file copying the `.env.example` file

```bash
cp .env.example .env
```

5. Create a new database

```bash
mysql -u root -p
```

```sql
MySQL > CREATE DATABASE futbolpass;
```

6. Configure the database connection in the `.env` file

```
// .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=futbolpass
DB_USERNAME=root
DB_PASSWORD="your_secret_password"
```

7. Generate a new application key

```bash
php artisan key:generate
```

8. Run the migrations

```bash
php artisan migrate
```

9. Create a link to the storage folder

```bash
php artisan storage:link
```

10. Run the server

```bash
php artisan serve
```

11. At the same time run the vite project

```bash
npm run dev
```

Visit the application in your browser `http://localhost:8000`
