# XenoPHP Framework

XenoPHP is a secure, microservice-oriented PHP system that integrates multiple frameworks such as CodeIgniter, Laravel, CakePHP, and others. It is built for structured, high-performance API development, supports multi-server architecture, and is optimized for secure APIs using GraphQL and other modern technologies.

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
```

### 3. Configure Environment

```bash
cp .env.example .env
```

> **Note:** Edit the `.env` file to set your specific database credentials.

### 4. Initialize Application


```bash
php xeno key:generate
php xeno migrate

```
> **Important:** Use the `php xeno` prefix instead of `php artisan`.

---

### Development Server

To start the backend server and frontend asset watcher simultaneously:

```bash
php xeno serve
```

*Powered by XenoPHP.*
