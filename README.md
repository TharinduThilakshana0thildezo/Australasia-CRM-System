# Australasia CRM

An enterprise-grade internal CRM and business operations management platform built for the Australasia Group. This system handles multiple modules including Foreign Employment, Consultancy, Academy, Finance, Documents, and Staff Management.

---

## 🛠 Tech Stack
- **Framework:** Laravel 11 (PHP 8.2+)
- **Frontend:** Blade, Tailwind CSS v4, Alpine.js, Chart.js
- **Build Tool:** Vite

---

## 🚀 Getting Started (For New Developers)

Follow these steps to set up the project locally after cloning the repository.

### 1. Prerequisites
Make sure you have the following installed on your machine:
- [PHP](https://www.php.net/downloads) (8.2 or higher)
- [Composer](https://getcomposer.org/)
- [Node.js and npm](https://nodejs.org/) (v18 or higher)
- *(Optional for now)* MySQL or SQLite (Currently bypassed for prototype)

### 2. Installation Steps

**Step 1: Clone the repository & enter the directory**
```bash
git clone <repository-url>
cd australasia-crm
```

**Step 2: Install PHP dependencies**
```bash
composer install
```

**Step 3: Install Node dependencies**
```bash
npm install
```

**Step 4: Set up your environment file**
Copy the example environment file and generate an application key.
```bash
cp .env.example .env
php artisan key:generate
```
*Note for Windows users:* Use `copy .env.example .env` if using Command Prompt.

**Step 5: Configure the Database (For Future Backend Phase)**
Currently, the system is in **Phase 1 (Frontend Prototype)** and uses a mock session-based authentication system to bypass database requirements. You can leave the database config as-is for now. 

However, when backend development starts, ensure your `.env` has:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=australasia_crm
DB_USERNAME=root
DB_PASSWORD=
```
*(And then run `php artisan migrate` once the models/migrations are ready).*

**Step 6: Build frontend assets**
Compile the Tailwind CSS and JavaScript assets via Vite:
```bash
npm run build
```
*(You can also use `npm run dev` if you are actively making changes to the CSS/JS).*

**Step 7: Start the local development server**
```bash
php artisan serve
```
The application will be available at `http://127.0.0.1:8000`.

---

## 🔐 Login Details (Prototype Mode)

Because the system is currently functioning as a frontend prototype, **you do not need a database to log in.** A custom session-based auth system is temporarily active.

To log in, go to `http://127.0.0.1:8000` and use the following demo credentials:

- **Email:** `admin@australasia.lk`
- **Password:** `password`

---

## 📁 Directory Structure Highlights
- **`resources/views/`** - Contains all the module views.
  - `/employment` (Foreign Employment module)
  - `/consultancy` (Consultancy module)
  - `/academy` (Academy module)
  - `/finance` (Finance module)
  - `/auth` (Login views)
  - `/components` (Reusable UI elements like `stat-card`, `status-badge`, `page-header`)
- **`resources/css/app.css`** - The core design system and Tailwind utility configurations.
- **`routes/web.php`** - All 60+ routes are registered here and protected by the `custom.auth` middleware.
