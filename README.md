# XenoPHP Framework

XenoPHP is a secure, monolithic web platform built on **Laravel 11** and **React**. It is designed to behave like a static site publicly while maintaining a powerful, dynamic backend.

---

## Key Features

### Secure Core

* **Custom Secure Headers**: Implementation of CSP, HSTS, and X-Frame-Options.
* **Request Throttling**: Automated rate limiting to prevent abuse.
* **Native Protection**: CSRF and SQL Injection protection baked into the core.
* **Public Isolation**: Only the `public/` folder is exposed to the web, shielding the application logic.

### Frontend Integration

* **React & Vite**: Modern tooling for a fast development experience.
* **Inertia.js**: Acts as a bridge to provide a seamless Single Page Application (SPA) experience without complex API routing.
* **Pre-built Views**: Simplified "Welcome" and "Dashboard" templates.

### Logging & Monitoring

* **Daily Log Rotation**: System logs are managed via `xenophp.log`.
* **Database Access Logs**: Detailed tracking of every request including IP addresses, routes, and User Agents.
* **Admin Dashboard**: Real-time log monitoring available at `/admin/logs`.

### Xeno CLI

* **Custom Wrapper**: Features a dedicated `xeno` CLI tool that replaces the standard Laravel `artisan` command for framework-specific operations.

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/Asadullah-nadeem/XenoPHP.git
cd XenoPHP

```

### 2. Install Dependencies

```bash
composer install
npm install

```

### 3. Configure Environment

```bash
cp .env.example .env

```

> **Note:** Edit the `.env` file to set your specific database credentials.

### 4. Initialize Application

> **Important:** Use the `php xeno` prefix instead of `php artisan`.

```bash
php xeno key:generate
php xeno migrate

```

---

## Usage

### Development Server

To start the backend server and frontend asset watcher simultaneously:

```bash
# Terminal 1
php xeno serve

# Terminal 2
npm run dev

```

The application will be accessible at `http://localhost:8000`.

### Production Build

To generate optimized assets for deployment:

```bash
npm run build

```

Ensure your web server (Nginx or Apache) is configured to point to the `public/` directory.

---

## Admin Dashboard

To monitor system activity and access logs:

1. **Register**: Create a new user account via the application interface.
2. **Access**: Navigate to the `/admin/logs` endpoint.
3. **Monitor**: View a paginated table containing all incoming request data.

---

## Directory Structure

| File/Folder | Description |
| --- | --- |
| `xeno` | The primary CLI entry point for the framework. |
| `public/` | The only web-accessible folder; contains `index.php`. |
| `resources/js/` | Contains React components and Inertia pages. |
| `app/Http/Middleware/SecureHeaders.php` | Central security header configurations. |
| `app/Http/Middleware/LogActivity.php` | Logic for tracking and storing request activity. |

---

*Powered by XenoPHP.*
