# BlogVerse Installation Guide

This guide will help you install and set up BlogVerse, a modern blog platform demo project by Arian Karimi.

## 📋 Prerequisites

Before installing BlogVerse, ensure you have the following installed on your system:

- **PHP 8.1+** with the following extensions:
  - BCMath PHP Extension
  - Ctype PHP Extension
  - cURL PHP Extension
  - DOM PHP Extension
  - Fileinfo PHP Extension
  - JSON PHP Extension
  - Mbstring PHP Extension
  - OpenSSL PHP Extension
  - PCRE PHP Extension
  - PDO PHP Extension
  - Tokenizer PHP Extension
  - XML PHP Extension

- **Composer** (PHP package manager)
- **Node.js** (for asset compilation)
- **MySQL** or **MariaDB** (database)
- **Git** (version control)

## 🚀 Installation Steps

### 1. Clone the Repository

```bash
git clone https://github.com/Retro-Zero/laravel-blog-platform.git
cd laravel-blog-platform
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the environment file and configure your settings:

```bash
cp .env.example .env
```

Edit the `.env` file with your database credentials and other settings:

```env
APP_NAME="BlogVerse by Arian Karimi"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogverse
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Database Setup

Create your database and run migrations:

```bash
php artisan migrate
```

### 7. Seed the Database

Populate the database with demo data:

```bash
php artisan db:seed
```

### 8. Build Assets

Compile the frontend assets:

```bash
npm run build
```

### 9. Set Permissions (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
```

### 10. Start the Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` to see BlogVerse in action!

## 🎨 Features Included

### Modern UI/UX
- Dark theme with glassmorphism effects
- Gradient backgrounds and animations
- Responsive design for all devices
- Smooth transitions and hover effects

### Core Functionality
- User authentication (register, login, password reset)
- Blog post creation and management
- Commenting system
- Category organization
- View tracking and analytics

### Demo Content
- Realistic blog posts with images
- Sample categories and users
- Comments and interactions
- Professional content structure

## 🔧 Configuration Options

### Customizing the Theme

The dark theme and styling can be customized in:
- `resources/css/app.css` - Main styles
- `tailwind.config.js` - Tailwind configuration
- Individual Blade templates in `resources/views/`

### Database Configuration

BlogVerse uses MySQL by default. To use a different database:

1. Update your `.env` file with the appropriate database settings
2. Ensure the database driver is installed
3. Run migrations: `php artisan migrate:fresh`

### Email Configuration

For password reset and email verification:

1. Configure your email settings in `.env`
2. Set up a mail driver (Mailtrap for testing)
3. Test email functionality

## 🚀 Production Deployment

### Server Requirements
- PHP 8.1+
- MySQL 5.7+ or MariaDB 10.2+
- Web server (Apache/Nginx)
- SSL certificate (recommended)

### Deployment Steps
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` for security
3. Configure your web server
4. Set up proper file permissions
5. Configure caching: `php artisan config:cache`

## 🐛 Troubleshooting

### Common Issues

**Composer install fails:**
- Ensure PHP version is 8.1+
- Check all required extensions are installed

**Database connection errors:**
- Verify database credentials in `.env`
- Ensure database server is running
- Check database permissions

**Asset compilation fails:**
- Ensure Node.js is installed
- Run `npm install` before `npm run build`

**Permission errors:**
- Set proper permissions on `storage` and `bootstrap/cache`
- Ensure web server can write to these directories

## 📞 Support

For issues specific to this demo project:
- Check the [Troubleshooting Guide](troubleshooting.md)
- Review the [Project Structure](project-structure.md)
- Contact Arian Karimi for portfolio-related questions

---

**Note:** This is a demonstration project created for portfolio purposes. Not intended for production use. 