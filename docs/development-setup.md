# Development Setup

This guide documents my local development environment setup for the Blog Platform project. It reflects my development workflow and tooling preferences.

## 🛠️ Prerequisites

### Required Software
- **PHP** (>= 8.1)
- **Composer** (>= 2.0)
- **Node.js** (>= 16.0)
- **MySQL** (>= 8.0)
- **Git**

### Recommended Software
- **VS Code** or **PHPStorm** (IDE)
- **TablePlus** or **phpMyAdmin** (Database GUI)
- **Postman** or **Insomnia** (API Testing)
- **Chrome DevTools** (Frontend Debugging)

## 🚀 Local Development Setup

### 1. Clone Repository
```bash
git clone <repository-url>
cd blog
```

### 2. Install Dependencies
```bash
# PHP dependencies
composer install

# Node.js dependencies
npm install
```

### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup
```bash
# Create database
mysql -u root -p -e "CREATE DATABASE blog_platform;"

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed
```

### 5. Frontend Setup
```bash
# Install Tailwind CSS
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p

# Build assets
npm run dev
```

### 6. File Storage
```bash
# Create storage link
php artisan storage:link
```

## 🔧 Development Configuration

### Environment Variables (.env)
```env
APP_NAME="Blog Platform"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_platform
DB_USERNAME=root
DB_PASSWORD=

# Mail (for development)
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@blogplatform.com"
MAIL_FROM_NAME="${APP_NAME}"

# Cache
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### Tailwind Configuration (tailwind.config.js)
```javascript
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#eff6ff',
          500: '#3b82f6',
          600: '#2563eb',
          700: '#1d4ed8',
        }
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
```

### VS Code Extensions (Recommended)
```json
{
  "recommendations": [
    "bmewburn.vscode-intelephense-client",
    "onecentlin.laravel-blade",
    "bradlc.vscode-tailwindcss",
    "esbenp.prettier-vscode",
    "ms-vscode.vscode-typescript-next",
    "formulahendry.auto-rename-tag",
    "christian-kohler.path-intellisense"
  ]
}
```

## 🎯 Development Workflow

### Starting Development Server
```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Asset compilation (watch mode)
npm run dev
```

### Database Workflow
```bash
# Create new migration
php artisan make:migration create_posts_table

# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Reset database
php artisan migrate:fresh --seed
```

### Frontend Workflow
```bash
# Watch for changes
npm run dev

# Build for production
npm run build

# Check for issues
npm run lint
```

## 🧪 Testing Setup

### PHP Testing
```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=PostTest

# Run with coverage
php artisan test --coverage
```

### Frontend Testing
```bash
# Run JavaScript tests (if configured)
npm test

# Run linting
npm run lint
```

## 🔍 Debugging Tools

### Laravel Debugging
```bash
# Enable debug mode
APP_DEBUG=true

# Check logs
tail -f storage/logs/laravel.log

# Use Tinker for debugging
php artisan tinker
```

### Frontend Debugging
```bash
# Browser DevTools
# - Console for JavaScript errors
# - Network tab for API calls
# - Elements tab for CSS issues
# - Sources tab for debugging
```

### Database Debugging
```bash
# Enable query logging
php artisan tinker
DB::enableQueryLog();
// Your code here
dd(DB::getQueryLog());
```

## 📁 Project Structure for Development

### Key Directories
```
blog/
├── app/Http/Controllers/    # Controllers
├── app/Models/             # Eloquent models
├── app/Services/           # Business logic
├── database/migrations/    # Database migrations
├── database/seeders/       # Database seeders
├── resources/views/        # Blade templates
├── resources/css/          # CSS source
├── resources/js/           # JavaScript source
├── routes/                 # Route definitions
└── tests/                  # Test files
```

### Development Files
```
blog/
├── .env                    # Environment variables
├── .env.example           # Environment template
├── composer.json           # PHP dependencies
├── package.json            # Node.js dependencies
├── tailwind.config.js      # Tailwind configuration
├── vite.config.js          # Vite configuration
└── phpunit.xml            # PHPUnit configuration
```

## 🛠️ Development Tools

### Laravel Artisan Commands
```bash
# Create new controller
php artisan make:controller PostController

# Create new model
php artisan make:model Post -m

# Create new migration
php artisan make:migration create_posts_table

# Create new seeder
php artisan make:seeder PostSeeder

# Create new middleware
php artisan make:middleware AdminMiddleware
```

### Composer Commands
```bash
# Install package
composer require package-name

# Update dependencies
composer update

# Check for security issues
composer audit

# Optimize autoloader
composer dump-autoload
```

### NPM Commands
```bash
# Install package
npm install package-name

# Install dev dependency
npm install -D package-name

# Update dependencies
npm update

# Check for security issues
npm audit
```

## 🔧 IDE Configuration

### VS Code Settings (.vscode/settings.json)
```json
{
  "php.validate.executablePath": "/usr/bin/php",
  "php.suggest.basic": false,
  "emmet.includeLanguages": {
    "blade": "html"
  },
  "files.associations": {
    "*.blade.php": "blade"
  },
  "tailwindCSS.includeLanguages": {
    "blade": "html"
  }
}
```

### PHPStorm Configuration
- Enable Laravel plugin
- Configure PHP interpreter
- Set up database connection
- Configure Tailwind CSS support

## 🚀 Quick Development Commands

### Daily Development
```bash
# Start development
php artisan serve
npm run dev

# Check status
php artisan route:list
php artisan migrate:status

# Clear caches
php artisan optimize:clear
```

### Before Committing
```bash
# Run tests
php artisan test

# Check code style
./vendor/bin/pint

# Build assets
npm run build

# Check for issues
composer audit
npm audit
```

## 📚 Development Resources

### Laravel Documentation
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Eloquent](https://laravel.com/docs/eloquent)
- [Laravel Blade](https://laravel.com/docs/blade)

### Frontend Resources
- [Tailwind CSS](https://tailwindcss.com/docs)
- [Quill Editor](https://quilljs.com/docs)
- [Alpine.js](https://alpinejs.dev/)

### Development Tools
- [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
- [Laravel Telescope](https://laravel.com/docs/telescope)
- [Laravel Horizon](https://laravel.com/docs/horizon)

## 🔍 Troubleshooting Development Issues

### Common Issues
1. **Assets not loading**: Run `npm run dev`
2. **Database errors**: Check `.env` configuration
3. **Permission errors**: Set proper file permissions
4. **Cache issues**: Clear all caches

### Debug Commands
```bash
# Check Laravel status
php artisan about

# Check PHP version
php --version

# Check Node.js version
node --version

# Check database connection
php artisan tinker
DB::connection()->getPdo();
```

---

**Last Updated**: July 2024  
**Version**: 1.0.0 