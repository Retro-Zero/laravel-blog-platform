# BlogVerse Troubleshooting Guide

This guide provides solutions to common issues you may encounter while working with BlogVerse. It covers installation, development, and production deployment problems.

## 🚨 Common Issues and Solutions

### Installation Issues

#### 1. Composer Install Fails

**Problem**: `composer install` fails with dependency errors

**Solutions**:
```bash
# Clear composer cache
composer clear-cache

# Update composer
composer self-update

# Remove vendor and reinstall
rm -rf vendor composer.lock
composer install

# If PHP version issue, check PHP version
php --version  # Should be 8.1+
```

#### 2. Node.js Dependencies Fail

**Problem**: `npm install` fails or assets don't compile

**Solutions**:
```bash
# Clear npm cache
npm cache clean --force

# Remove node_modules and reinstall
rm -rf node_modules package-lock.json
npm install

# Check Node.js version
node --version  # Should be 16.0+

# Rebuild assets
npm run build
```

#### 3. Database Connection Errors

**Problem**: Database connection fails during migration

**Solutions**:
```bash
# Check MySQL is running
sudo systemctl status mysql  # Linux
brew services list | grep mysql  # macOS

# Verify database credentials in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogverse
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Test database connection
php artisan tinker
DB::connection()->getPdo();
```

#### 4. Permission Errors

**Problem**: Storage or cache directories not writable

**Solutions**:
```bash
# Set proper permissions (Linux/Mac)
chmod -R 775 storage bootstrap/cache

# Set ownership (Linux)
sudo chown -R $USER:www-data storage bootstrap/cache

# Set ownership (macOS)
sudo chown -R $USER:_www storage bootstrap/cache

# Windows: Ensure proper folder permissions
```

### Development Issues

#### 1. Assets Not Loading

**Problem**: CSS/JS files return 404 errors

**Solutions**:
```bash
# Build assets
npm run build

# Or run in development mode
npm run dev

# Clear view cache
php artisan view:clear

# Check if Vite is running
# Should see Vite dev server in terminal
```

#### 2. Routes Not Working

**Problem**: Routes return 404 or redirect incorrectly

**Solutions**:
```bash
# Clear route cache
php artisan route:clear

# List all routes
php artisan route:list

# Check .htaccess (Apache) or nginx config
# Ensure proper URL rewriting is enabled
```

#### 3. Authentication Issues

**Problem**: Login/register not working

**Solutions**:
```bash
# Clear session cache
php artisan session:clear

# Regenerate application key
php artisan key:generate

# Check mail configuration for password reset
# Set MAIL_MAILER=log for development
```

#### 4. Database Migration Errors

**Problem**: Migrations fail or tables don't exist

**Solutions**:
```bash
# Reset database completely
php artisan migrate:fresh --seed

# Check migration status
php artisan migrate:status

# Rollback and re-run
php artisan migrate:rollback
php artisan migrate

# Check for migration conflicts
php artisan migrate:status
```

### Frontend Issues

#### 1. Tailwind CSS Not Working

**Problem**: Tailwind classes not applying

**Solutions**:
```bash
# Rebuild CSS
npm run build

# Check tailwind.config.js
# Ensure content paths are correct

# Clear browser cache
# Hard refresh: Ctrl+F5 (Windows) or Cmd+Shift+R (Mac)
```

#### 2. JavaScript Errors

**Problem**: Console shows JavaScript errors

**Solutions**:
```bash
# Check browser console for specific errors
# Common issues:
# - Missing dependencies
# - Incorrect file paths
# - Syntax errors

# Rebuild JavaScript
npm run build

# Check for syntax errors
npm run lint  # if configured
```

#### 3. Dark Theme Issues

**Problem**: Dark theme not applying correctly

**Solutions**:
```bash
# Check if dark mode classes are applied
# Look for 'dark:' prefixed classes

# Ensure proper CSS compilation
npm run build

# Check for conflicting CSS
# Review app.css and component styles
```

### Production Issues

#### 1. Performance Problems

**Problem**: Slow page loads or high memory usage

**Solutions**:
```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build production assets
npm run build

# Check server resources
# Monitor memory and CPU usage
```

#### 2. Security Issues

**Problem**: Security vulnerabilities or unauthorized access

**Solutions**:
```bash
# Set production environment
APP_ENV=production
APP_DEBUG=false

# Check for security issues
composer audit

# Update dependencies
composer update

# Review .env security settings
```

#### 3. Email Not Working

**Problem**: Password reset or verification emails not sending

**Solutions**:
```bash
# Check mail configuration
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls

# Test email functionality
php artisan tinker
Mail::raw('Test email', function($message) {
    $message->to('test@example.com')->subject('Test');
});
```

### Database Issues

#### 1. Foreign Key Constraint Errors

**Problem**: Cannot delete records due to foreign key constraints

**Solutions**:
```bash
# Check foreign key relationships
# Use proper cascade deletes in migrations

# For immediate fix, disable foreign key checks
SET FOREIGN_KEY_CHECKS = 0;
-- Your operations here
SET FOREIGN_KEY_CHECKS = 1;
```

#### 2. Unique Constraint Violations

**Problem**: Duplicate entries causing unique constraint errors

**Solutions**:
```bash
# Check for duplicate data
# Review seeders for unique constraints

# Clear and reseed database
php artisan migrate:fresh --seed

# Check unique indexes in migrations
```

#### 3. Database Performance Issues

**Problem**: Slow database queries

**Solutions**:
```bash
# Enable query logging
DB::enableQueryLog();
// Your code here
dd(DB::getQueryLog());

# Add proper indexes
# Review migration files for missing indexes

# Use eager loading to prevent N+1 queries
$posts = Post::with(['user', 'category'])->get();
```

### Environment-Specific Issues

#### Windows Issues

**Problem**: Path issues or permission problems on Windows

**Solutions**:
```bash
# Use Windows Subsystem for Linux (WSL)
# Or ensure proper PATH configuration

# Check file permissions
# Right-click folders → Properties → Security

# Use Git Bash for better compatibility
```

#### macOS Issues

**Problem**: Permission or path issues on macOS

**Solutions**:
```bash
# Use Homebrew for package management
brew install php mysql node

# Set proper permissions
sudo chown -R $USER:_www storage bootstrap/cache

# Use Laravel Valet for local development
composer global require laravel/valet
valet install
```

#### Linux Issues

**Problem**: Package conflicts or permission issues

**Solutions**:
```bash
# Update package manager
sudo apt update  # Ubuntu/Debian
sudo yum update  # CentOS/RHEL

# Install required packages
sudo apt install php8.1-mysql php8.1-xml php8.1-curl

# Set proper permissions
sudo chown -R $USER:www-data storage bootstrap/cache
```

## 🔧 Debugging Tools

### Laravel Debugging

```bash
# Enable debug mode
APP_DEBUG=true

# View logs
tail -f storage/logs/laravel.log

# Use Tinker for debugging
php artisan tinker

# Check application status
php artisan about
```

### Database Debugging

```bash
# Enable query logging
DB::enableQueryLog();
// Your code here
dd(DB::getQueryLog());

# Check database connection
php artisan tinker
DB::connection()->getPdo();
```

### Frontend Debugging

```bash
# Browser developer tools
# - Console for JavaScript errors
# - Network tab for API calls
# - Elements tab for CSS issues

# Check for JavaScript errors
# Look for 404 errors in Network tab
```

## 📞 Getting Help

### Before Asking for Help

1. **Check the logs**: `storage/logs/laravel.log`
2. **Search existing issues**: Check GitHub issues
3. **Provide context**: Include error messages and steps to reproduce
4. **Check versions**: PHP, Laravel, Node.js versions

### Useful Commands

```bash
# System information
php --version
node --version
composer --version
mysql --version

# Laravel status
php artisan about
php artisan route:list
php artisan migrate:status

# Clear all caches
php artisan optimize:clear
```

### Common Error Messages

#### "Class not found"
```bash
composer dump-autoload
```

#### "Target class does not exist"
```bash
php artisan config:clear
php artisan cache:clear
```

#### "No application encryption key has been specified"
```bash
php artisan key:generate
```

#### "SQLSTATE[HY000] [2002] Connection refused"
- Check if MySQL is running
- Verify database credentials in `.env`

## 🚀 Performance Optimization

### Database Optimization

```bash
# Add indexes for frequently queried columns
# Use eager loading to prevent N+1 queries
# Implement caching for expensive queries
```

### Asset Optimization

```bash
# Minify CSS and JavaScript
npm run build

# Use CDN for external libraries
# Enable gzip compression
```

### Application Optimization

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache
```

---

**Note:** This is a demonstration project by Arian Karimi for portfolio purposes. For production deployments, additional security and performance considerations should be implemented. 