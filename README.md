# Coral Cove Hotel — Visitor Management System (HVMS)

A simple, professional, interactive web app built with **plain HTML, CSS, JavaScript, PHP, and MySQL** — no frameworks, libraries, or external APIs — based on the CS2001 group project proposal and specification.

## What's included

```
hvms/
├── database.sql              ← run this first to create the database
├── reset_password.php        ← run once if default logins fail, then delete
├── index.php                 ← HOME page: public default view if logged out, redirects to dashboard if logged in
├── login.php / logout.php
├── dashboard.php              ← personalised home view once logged in
├── register_visitor.php      ← visitor registration form
├── visitors.php               ← view / search / check-in / check-out / delete
├── edit_visitor.php           ← edit a visitor record
├── reports.php                 ← date-range visitor reports
├── functionalities.php       ← lists every facility available in the system
├── admin.php                  ← ADMIN hub page — links to all admin tasks
├── admin_users.php            ← add / view / delete staff & admin accounts
├── help.php                    ← built-in help page
├── includes/
│   ├── config.php             ← database connection settings (EDIT THIS)
│   ├── auth.php                ← login/session helper functions
│   ├── header.php / footer.php
├── assets/
│   ├── css/style.css           ← all styling (ocean/coral theme, system fonts only)
│   └── js/app.js                ← plain JS: live search, delete confirmation, clock
```

No external fonts, CDNs, frameworks, or libraries are used anywhere — everything is hand-written HTML/CSS/JS/PHP/SQL, per the "no frameworks/libraries/APIs" rule.

## Required pages (per spec) and where to find them

| Spec requirement | File |
|---|---|
| Login page (first page seen) | `login.php` |
| Home page (default if logged out, personalised if logged in) | `index.php` → `dashboard.php` |
| Admin page (links to all admin tasks) | `admin.php` |
| Functionalities page | `functionalities.php` |
| Help page | `help.php` |

## User roles

- **Administrator** — full access, including the Admin hub for managing accounts.
- **Ordinary user** — everyday staff access (registration, search, check-in/out, reports, functionalities, help) but no account management.
- A **default ordinary user account** is seeded automatically: username `uoc`, password `uoc` (as required by the course spec).
- A default **admin** account is also seeded: username `admin`, password `admin123`.

## How to set this up

You need a local server with **PHP** and **MySQL/MariaDB**. The easiest way is **XAMPP** (Windows/Mac) or **MAMP** (Mac), which bundle both.

### 1. Install a local server (if you don't have one)
- Download **XAMPP**: https://www.apachefriends.org
- Install it, then start the **Apache** and **MySQL** modules from the XAMPP Control Panel.

### 2. Copy the project files
- Copy the entire `hvms` folder into XAMPP's web root:
  - Windows: `C:\xampp\htdocs\hvms`
  - Mac: `/Applications/XAMPP/htdocs/hvms`

### 3. Create the database
- Open **phpMyAdmin** in your browser: `http://localhost/phpmyadmin`
- Click **Import**, choose the file `database.sql`, and click **Go**.
  - This creates the database `coralcove_hvms`, the `users` and `visitors` tables, the default `admin` account, the mandatory default `uoc` ordinary user account, and two sample visitor records.

### 4. Set your database credentials
- Open `includes/config.php`.
- Update `DB_USER` and `DB_PASS` to match your MySQL setup.
  - Default XAMPP credentials are usually `root` with **no password** — already set as the default in this file.

### 5. Run the app
- Visit: `http://localhost/hvms/`
- This is the **Home page**. If you're not logged in, you'll see a public welcome screen with a "Staff Login" button.
- Click it, or go straight to `http://localhost/hvms/login.php`.
- **Admin login:** username `admin`, password `admin123`
- **Ordinary user login:** username `uoc`, password `uoc`

> If either default login doesn't work (this can happen if your PHP build's password hashing differs), visit `http://localhost/hvms/reset_password.php` once in your browser — it resets both the `admin` and `uoc` passwords — then **delete that file**.

### 6. Explore the system
- **Home** (`index.php`) — public landing page when logged out; redirects to the personalised dashboard when logged in.
- **Dashboard** — overview of recent visitor activity and pending check-ins (the logged-in "Home").
- **Register Visitor** — log a new visitor (name, purpose, host, duration).
- **View / Search** — browse all records, filter by name/date/status, check visitors in/out, edit or delete records.
- **Reports** — generate a visitor activity summary for any date range (printable).
- **Functionalities** — a complete list of every feature in the system, split by ordinary-user and admin-only access.
- **Admin** (admin role only) — hub page linking to all administrative tasks: add/view/delete users, reports, functionalities.
- **Help** — built-in guidance page for staff.

## Notes
- Passwords are hashed with PHP's `password_hash()` (bcrypt) — never stored in plain text.
- All database queries use prepared statements (PDO) to prevent SQL injection.
- Unauthorized users are blocked from protected pages via `require_login()` and `require_admin()` in `includes/auth.php`; the Admin hub and account management pages are inaccessible to ordinary users even via direct URL.
- The design uses an ocean/coral palette to match Coral Cove's branding, built entirely with system fonts (no external font services), and is responsive down to mobile.
- All SQL used by the app is in `database.sql` plus the prepared statements inside each `.php` file — include both when compiling your report's required SQL queries section.
