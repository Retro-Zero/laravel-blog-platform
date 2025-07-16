# BlogVerse Development Setup

This guide provides comprehensive instructions for setting up the BlogVerse development environment. It covers local development, testing, debugging, and contribution workflows.

## 🛠️ Development Environment Requirements

### Required Software
- **PHP 8.1+** with extensions:
  - BCMath, Ctype, cURL, DOM, Fileinfo, JSON, Mbstring, OpenSSL, PCRE, PDO, Tokenizer, XML
- **Composer 2.0+** (PHP package manager)
- **Node.js 16.0+** (for asset compilation)
- **MySQL 8.0+** or **MariaDB 10.2+**
- **Git** (version control)

### Recommended Software
- **VS Code** with extensions:
  - Laravel Extension Pack
  - PHP Intelephense
  - Tailwind CSS IntelliSense
  - GitLens
- **Laravel Valet** (macOS) or **Laravel Homestead**
- **Redis** (for caching and sessions)
- **MailHog** (for email testing)

## 🚀 Local Development Setup

### 1. Clone the Repository

```bash
git clone https://github.com/Retro-Zero/laravel-blog-platform.git
cd laravel-blog-platform
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

Edit `.env` for local development:

```env
APP_NAME="BlogVerse by Arian Karimi"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogverse_dev
DB_USERNAME=your_username
DB_PASSWORD=your_password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@blogverse.local"
MAIL_FROM_NAME="${APP_NAME}"
```

### 4. Database Setup

```bash
# Create database
mysql -u root -p -e "CREATE DATABASE blogverse_dev;"

# Run migrations
php artisan migrate

# Seed with demo data
php artisan db:seed
```

### 5. Asset Compilation

```bash
# Development mode (with hot reload)
npm run dev

# Or build for production
npm run build
```

### 6. Start Development Server

```bash
# Start Laravel development server
php artisan serve

# In another terminal, watch for asset changes
npm run dev
```

Visit `http://localhost:8000` to see BlogVerse in action!

## 🧪 Testing Setup

### PHPUnit Configuration

BlogVerse includes comprehensive test suites:

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/PostTest.php

# Run tests with coverage
php artisan test --coverage
```

### Test Structure

```
tests/
├── Feature/              # Feature tests
│   ├── Auth/            # Authentication tests
│   ├── PostTest.php     # Post functionality
│   ├── CommentTest.php  # Comment system
│   └── ProfileTest.php  # User profile
└── Unit/                # Unit tests
    ├── PostTest.php     # Post model tests
    ├── UserTest.php     # User model tests
    └── CategoryTest.php # Category model tests
```

### Writing Tests

Example test for post creation:

```php
public function test_user_can_create_post()
{
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)
        ->post('/posts', [
            'title' => 'Test Post',
            'content' => 'Test content',
            'category_id' => 1
        ]);
    
    $response->assertRedirect();
    $this->assertDatabaseHas('posts', [
        'title' => 'Test Post',
        'user_id' => $user->id
    ]);
}
```

## 🔧 Development Tools

### Laravel Telescope (Debugging)

Install Laravel Telescope for debugging:

```bash
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
```

Access Telescope at `http://localhost:8000/telescope`

### Laravel Debugbar

```bash
composer require barryvdh/laravel-debugbar --dev
```

### Code Quality Tools

```bash
# Install Laravel Pint for code formatting
composer require laravel/pint --dev

# Format code
./vendor/bin/pint

# Install PHPStan for static analysis
composer require nunomaduro/larastan --dev

# Run static analysis
./vendor/bin/phpstan analyse
```

## 🎨 Frontend Development

### Tailwind CSS Development

```bash
# Watch for CSS changes
npm run dev

# Build for production
npm run build
```

### Customizing Styles

Edit `tailwind.config.js` for theme customization:

```javascript
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        // Custom colors
      },
      animation: {
        // Custom animations
      }
    },
  },
  plugins: [],
}
```

### JavaScript Development

Main JavaScript files:
- `resources/js/app.js` - Main entry point
- `resources/js/quill.js` - Rich text editor
- `resources/js/sweetalert.js` - Notifications

## 🔍 Debugging Techniques

### Laravel Logs

```bash
# View Laravel logs
tail -f storage/logs/laravel.log

# Clear logs
php artisan log:clear
```

### Database Debugging

```bash
# Enable query logging
DB::enableQueryLog();
// Your code here
dd(DB::getQueryLog());

# Or use Laravel Debugbar
```

### Frontend Debugging

```bash
# Browser developer tools
# Check console for JavaScript errors
# Use Vue DevTools if using Vue.js
```

## 📝 Code Style and Standards

### PHP Code Style

BlogVerse follows PSR-12 standards:

```bash
# Format PHP code
./vendor/bin/pint

# Check code style
./vendor/bin/pint --test
```

### Blade Template Standards

- Use consistent indentation (4 spaces)
- Keep templates focused and readable
- Use components for reusable elements
- Follow Laravel naming conventions

### JavaScript Standards

- Use ES6+ features
- Follow consistent naming conventions
- Comment complex logic
- Use proper error handling

## 🚀 Deployment Preparation

### Production Build

```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build assets
npm run build

# Set proper permissions
chmod -R 775 storage bootstrap/cache
```

### Environment Variables

Ensure production `.env` has:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

DB_CONNECTION=mysql
DB_HOST=your_db_host
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

## 🔄 Version Control Workflow

### Git Workflow

```bash
# Create feature branch
git checkout -b feature/new-feature

# Make changes and commit
git add .
git commit -m "Add new feature"

# Push to remote
git push origin feature/new-feature

# Create pull request
# Merge after review
```

### Commit Message Standards

```
feat: add new post creation feature
fix: resolve comment display issue
docs: update installation guide
style: improve button styling
refactor: optimize database queries
test: add user authentication tests
```

## 🐛 Common Development Issues

### Permission Issues

```bash
# Fix storage permissions
chmod -R 775 storage bootstrap/cache

# Fix ownership (Linux/Mac)
sudo chown -R $USER:www-data storage bootstrap/cache
```

### Database Issues

```bash
# Reset database
php artisan migrate:fresh --seed

# Clear cache
php artisan config:clear
php artisan cache:clear
```

### Asset Issues

```bash
# Clear and rebuild assets
rm -rf public/build
npm run build

# Clear cache
php artisan view:clear
```

### Composer Issues

```bash
# Clear composer cache
composer clear-cache

# Reinstall dependencies
rm -rf vendor composer.lock
composer install
```

## 📚 Additional Resources

### Laravel Documentation
- [Laravel 10.x Documentation](https://laravel.com/docs/10.x)
- [Laravel Breeze Documentation](https://laravel.com/docs/10.x/starter-kits#laravel-breeze)
- [Laravel Sanctum Documentation](https://laravel.com/docs/10.x/sanctum)

### Frontend Resources
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Quill.js Documentation](https://quilljs.com/docs)
- [SweetAlert2 Documentation](https://sweetalert2.github.io/)

### Development Tools
- [Laravel Valet](https://laravel.com/docs/10.x/valet)
- [Laravel Homestead](https://laravel.com/docs/10.x/homestead)
- [Laravel Telescope](https://laravel.com/docs/10.x/telescope)

---

**Note:** This is a demonstration project by Arian Karimi for portfolio purposes. The development setup showcases modern Laravel development practices and tools. 