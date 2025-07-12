# Troubleshooting Guide

This guide documents the issues I encountered during development and the solutions I implemented. It demonstrates my problem-solving approach and technical debugging skills.

## 🚨 Common Issues

### Installation Problems

#### 1. Composer Install Fails
**Error**: `composer install` fails with dependency conflicts

**Solutions**:
```bash
# Clear composer cache
composer clear-cache

# Update composer
composer self-update

# Remove composer.lock and reinstall
rm composer.lock
composer install

# If still failing, try with --ignore-platform-reqs
composer install --ignore-platform-reqs
```

#### 2. Node.js Dependencies Fail
**Error**: `npm install` fails or assets don't build

**Solutions**:
```bash
# Clear npm cache
npm cache clean --force

# Remove node_modules and reinstall
rm -rf node_modules package-lock.json
npm install

# Update npm
npm install -g npm@latest

# Try with legacy peer deps
npm install --legacy-peer-deps
```

#### 3. Database Connection Issues
**Error**: `SQLSTATE[HY000] [1045] Access denied for user`

**Solutions**:
```bash
# Check MySQL is running
sudo systemctl status mysql

# Start MySQL if not running
sudo systemctl start mysql

# Reset MySQL root password
sudo mysql_secure_installation

# Create database user
mysql -u root -p
CREATE USER 'bloguser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON blog_platform.* TO 'bloguser'@'localhost';
FLUSH PRIVILEGES;
```

### Runtime Issues

#### 4. 500 Server Error
**Error**: White screen or 500 error on all pages

**Solutions**:
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Check file permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Regenerate app key
php artisan key:generate
```

#### 5. Assets Not Loading
**Error**: CSS/JS files return 404 or don't load

**Solutions**:
```bash
# Build assets
npm run dev

# For production
npm run build

# Check if storage link exists
php artisan storage:link

# Clear view cache
php artisan view:clear
```

#### 6. Database Migration Errors
**Error**: `SQLSTATE[42S01]: Base table or view already exists`

**Solutions**:
```bash
# Rollback all migrations
php artisan migrate:rollback

# Fresh install with seed
php artisan migrate:fresh --seed

# If table exists, drop it manually
php artisan tinker
DB::statement('DROP TABLE IF EXISTS posts');
```

### Authentication Issues

#### 7. Laravel Breeze Not Working
**Error**: Login/register pages not found

**Solutions**:
```bash
# Install Laravel Breeze
composer require laravel/breeze --dev
php artisan breeze:install

# Publish routes
php artisan vendor:publish --tag=breeze-routes

# Clear route cache
php artisan route:clear
```

#### 8. Password Reset Not Working
**Error**: Password reset emails not sending

**Solutions**:
```bash
# Configure mail settings in .env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password

# Test mail configuration
php artisan tinker
Mail::raw('Test email', function($message) {
    $message->to('test@example.com')->subject('Test');
});
```

### Frontend Issues

#### 9. Tailwind CSS Not Working
**Error**: Tailwind classes not applying

**Solutions**:
```bash
# Install Tailwind CSS
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p

# Update tailwind.config.js
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

# Build assets
npm run dev
```

#### 10. Quill Editor Not Loading
**Error**: Rich text editor not appearing

**Solutions**:
```bash
# Install Quill
npm install quill

# Check if Quill is imported in app.js
import Quill from 'quill';

# Verify Quill CSS is loaded
// In your blade template
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
```

### Performance Issues

#### 11. Slow Page Loads
**Error**: Pages take too long to load

**Solutions**:
```bash
# Enable caching
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev

# Check database queries
php artisan tinker
DB::enableQueryLog();
// Run your query
dd(DB::getQueryLog());
```

#### 12. Memory Issues
**Error**: `Allowed memory size exhausted`

**Solutions**:
```bash
# Increase PHP memory limit in php.ini
memory_limit = 512M

# Or temporarily increase
php -d memory_limit=512M artisan serve

# Optimize images
# Use image optimization tools
```

## 🔧 Development Issues

### 13. Artisan Commands Not Working
**Error**: `php artisan` commands fail

**Solutions**:
```bash
# Check if you're in the right directory
pwd

# Check if .env exists
ls -la .env

# Regenerate autoloader
composer dump-autoload

# Clear bootstrap cache
php artisan config:clear
```

### 14. File Upload Issues
**Error**: Images not uploading or not displaying

**Solutions**:
```bash
# Create storage link
php artisan storage:link

# Check storage permissions
chmod -R 775 storage
chown -R www-data:www-data storage

# Check upload directory exists
mkdir -p storage/app/public/uploads
```

### 15. Email Issues
**Error**: Emails not sending in development

**Solutions**:
```bash
# Use Mailtrap for testing
# Add to .env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password

# Or use log driver for development
MAIL_MAILER=log
```

## 🐛 Debugging Tips

### Enable Debug Mode
```bash
# In .env
APP_DEBUG=true
APP_ENV=local
```

### Check Logs
```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Error logs
tail -f storage/logs/error.log

# Access logs (if using Apache/Nginx)
tail -f /var/log/apache2/error.log
```

### Database Debugging
```bash
# Enable query logging
php artisan tinker
DB::enableQueryLog();

# Run your code
// Your code here

# Check queries
dd(DB::getQueryLog());
```

### Frontend Debugging
```bash
# Check browser console for JavaScript errors
# Check Network tab for failed requests
# Check Elements tab for CSS issues
```

## 🔍 Common Error Messages

### Database Errors
- **`SQLSTATE[HY000] [2002] Connection refused`**: MySQL not running
- **`SQLSTATE[42S02] Base table or view not found`**: Migration not run
- **`SQLSTATE[23000] Integrity constraint violation`**: Foreign key constraint

### PHP Errors
- **`Class 'App\User' not found`**: Autoloader issue
- **`Call to undefined method`**: Method doesn't exist
- **`Undefined variable`**: Variable not defined

### Laravel Errors
- **`Route not defined`**: Route missing or cache issue
- **`View not found`**: Blade template missing
- **`Method not allowed`**: HTTP method mismatch

## 🛠️ Maintenance Commands

### Regular Maintenance
```bash
# Clear all caches
php artisan optimize:clear

# Update dependencies
composer update
npm update

# Backup database
mysqldump -u username -p blog_platform > backup.sql

# Check for security updates
composer audit
npm audit
```

### Performance Optimization
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

## 📞 Getting Help

### Before Asking for Help
1. Check this troubleshooting guide
2. Search Laravel documentation
3. Check GitHub issues
4. Enable debug mode and check logs

### Useful Commands
```bash
# Check Laravel version
php artisan --version

# Check PHP version
php --version

# Check Composer version
composer --version

# Check Node.js version
node --version

# Check npm version
npm --version
```

### Debug Information
When reporting issues, include:
- Laravel version
- PHP version
- Database type and version
- Error message and stack trace
- Steps to reproduce
- Environment (local/production)

## 📚 Additional Resources

- [Laravel Troubleshooting](https://laravel.com/docs/troubleshooting)
- [Laravel Debugging](https://laravel.com/docs/debugging)
- [Tailwind CSS Issues](https://tailwindcss.com/docs/installation)
- [Quill Editor Issues](https://quilljs.com/docs/configuration)

---

**Last Updated**: July 2024  
**Version**: 1.0.0 