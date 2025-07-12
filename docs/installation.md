# Installation Guide

This guide documents the installation process for my Blog Platform project. It serves as a reference for setting up the development environment and deploying the application.

## 📋 Prerequisites

Before starting, ensure you have the following installed on your system:

### Required Software
- **PHP** (>= 8.1)
- **Composer** (>= 2.0)
- **Node.js** (>= 16.0)
- **MySQL** (>= 8.0)
- **Git**

### Optional Software
- **Redis** (for caching and sessions)
- **Nginx/Apache** (for production)

## 🚀 Step-by-Step Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd blog
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Database

Edit the `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_platform
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Database Migrations

```bash
# Create database tables
php artisan migrate

# Seed initial data
php artisan db:seed
```

### 6. Install Node.js Dependencies

```bash
npm install
```

### 7. Install Tailwind CSS

```bash
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
```

### 8. Configure Tailwind CSS

Create or update `tailwind.config.js`:

```javascript
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

### 9. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 10. Set Up File Storage

```bash
# Create storage link
php artisan storage:link
```

### 11. Install Laravel Breeze (Authentication)

```bash
composer require laravel/breeze --dev
php artisan breeze:install
```

### 12. Install Quill Editor

```bash
npm install quill
```

## 🔧 Configuration

### Application Settings

Update your `.env` file with application-specific settings:

```env
APP_NAME="Blog Platform"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Mail settings (for notifications)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@blogplatform.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Cache Configuration

```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

## 🚀 Start the Development Server

```bash
# Start Laravel development server
php artisan serve

# In another terminal, watch for asset changes
npm run dev
```

Your application should now be running at `http://localhost:8000`

## ✅ Verification

### Check Installation

1. **Database Connection**: Visit `http://localhost:8000` - should load without errors
2. **Authentication**: Try registering a new user
3. **Admin Access**: Check if you can access the admin panel
4. **Asset Loading**: Verify CSS and JS files are loading correctly

### Common Issues

#### Database Connection Error
```bash
# Check if MySQL is running
sudo systemctl status mysql

# Test database connection
php artisan tinker
DB::connection()->getPdo();
```

#### Permission Issues
```bash
# Set proper permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

#### Node.js Issues
```bash
# Clear npm cache
npm cache clean --force

# Reinstall dependencies
rm -rf node_modules package-lock.json
npm install
```

## 🎯 Next Steps

After successful installation:

1. **Create Admin User**: Use the seeder or create manually
2. **Configure Mail**: Set up email for notifications
3. **Set Up Caching**: Configure Redis for better performance
4. **Security**: Review and update security settings
5. **Backup**: Set up database backup procedures

## 📚 Additional Resources

- [Laravel Installation Guide](https://laravel.com/docs/installation)
- [Tailwind CSS Installation](https://tailwindcss.com/docs/installation)
- [Quill Editor Setup](https://quilljs.com/docs/configuration)

---

**Troubleshooting**: If you encounter issues, check the [Troubleshooting Guide](troubleshooting.md) for common solutions. 