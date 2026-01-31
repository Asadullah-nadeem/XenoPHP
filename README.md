# XenoPHP Framework

XenoPHP is a secure, monolithic web platform built on **Laravel 11** and **React**. It is designed to behave like a static site publicly while maintaining a powerful, dynamic backend.

## Key Features

- **Secure Core**:
  - Custom **Secure Headers** (CSP, HSTS, X-Frame-Options).
  - Automated **Request Throttling** and Rate Limiting.
  - **CSRF** & **SQL Injection** protection baked in.
  - Public isolation: Only the `public/` folder is exposed to the web.
- **Frontend**:
  - Powered by **React** and **Vite**.
  - **Inertia.js** bridging for a seamless SPA experience.
  - Simplified "Welcome" and "Dashboard" views.
- **Logging & Monitoring**:
  - **Daily Log Rotation** (`xenophp.log`).
  - **Database Access Logs**: Tracks every request (IP, Route, User Agent).
  - **Admin Dashboard**: View logs in real-time at `/admin/logs`.
- **Xeno CLI**:
  - Custom CLI wrapper `xeno` (replaces standard `artisan`).

---

## Installation

1. **Clone the Repository**

    ```bash
    git clone <repository_url>
    cd XenoPHP
    ```

2. **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Configure Environment**

    ```bash
    cp .env.example .env
    ```

    *Edit `.env` to set your database credentials.*

4. **Initialize Application**
    > **Note:** Use `php xeno` instead of `php artisan`.

    ```bash
    php xeno key:generate
    php xeno migrate
    ```

---

## Usage

### Development Server

Start the backend server and frontend builder:

```bash
php xeno serve
npm run dev
```

Visit `http://localhost:8000`.

### Production Build

Generate optimized static assets:

```bash
npm run build
```

Point your web server (Nginx/Apache) to the `public/` directory.

---

## Admin Dashboard

To view the access logs:

1. Register a new user account.
2. Navigate to `/admin/logs`.
3. You will see a paginated table of all incoming requests to the system.

---

## Structure

- `xeno`: CLI Entry point.
- `public/`: The ONLY public folder. Contains `index.php` and built assets.
- `resources/js/`: React components and pages.
- `app/Http/Middleware/SecureHeaders.php`: Security configuration.
- `app/Http/Middleware/LogActivity.php`: Logging logic.

---

*Powered by XenoPHP.*
