# Blog MS
## Note: All designs are done with AI.
This repository contains a Laravel-based microservice for a blogging system (admin panel, categories, blog posts, and user favorites). The instructions below show how to set up and run the project locally on Windows (PowerShell).

**Quick Overview**
- **Framework:** Laravel (PHP)
- **Assets:** Vite + npm
- **Auth scaffold:** Breeze

**Requirements**
- **PHP:** install and verify with `php -v` (project requires a PHP version compatible with the repository; run `php -v` to confirm).
- **Composer:** `composer` (dependency manager for PHP).
- **Node.js & npm:** used to build frontend assets. Check with `node -v` and `npm -v`.
- **Database:** MySQL / MariaDB / SQLite or other supported database. Create a database for the project before running migrations.

**1. Clone & Install Dependencies**
Open PowerShell in the workspace and run:

```powershell
git clone https://github.com/Zaher-Sankari/Laravel_blog_ms
Laravel_blog_ms
composer install
npm install
```

**2. Environment**
Copy the example env and set your environment variables in `.env` (DB connection, mail, etc.):

```powershell
copy .env.example .env
php artisan key:generate
```

**3. Storage & Permissions**
Make the storage link (so uploaded images are available via `public/storage`):

```powershell
php artisan storage:link
```

**4. Database**
Import Database to mysql using the blog_ms.db file

**5. Serve the Application**
Start the Laravel development server:

```powershell
php artisan serve
```

This will typically start the app at `http://127.0.0.1:8000`.

**6. Authentication & Admin Access**
- Use the following account as an admin accout:
```powershell
username: admin@admin.com
password: 12345678
```
- and use this account as a user accout:
```powershell
username: user@user.com
password: 12345678
```
and you create as many users as you want.

