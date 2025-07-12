# Quick Start Guide

This guide documents the quick setup process for my Blog Platform project. It shows the streamlined approach I used to get the development environment running efficiently.

## ⚡ Super Quick Setup

### 1. Prerequisites Check
```bash
# Check PHP version
php --version  # Should be >= 8.1

# Check Composer
composer --version

# Check Node.js
node --version  # Should be >= 16.0

# Check MySQL
mysql --version
```

### 2. Clone & Install
```bash
git clone <repository-url>
cd blog
composer install
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup
```bash
# Create database
mysql -u root -p -e "CREATE DATABASE blog_platform;"

# Update .env with your database credentials
# Then run migrations
php artisan migrate --seed
```

### 4. Frontend Setup
```bash
npm install
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
npm run dev
```

### 5. Start Server
```bash
php artisan serve
```

Visit `http://localhost:8000` - you're done! 🎉

## 🚀 What You Get

After quick setup, you'll have:

- ✅ **Working Blog Platform** at `http://localhost:8000`
- ✅ **Sample Blog Posts** (created by seeder)
- ✅ **User Registration/Login** via Laravel Breeze
- ✅ **Admin Panel** at `/admin`
- ✅ **Rich Text Editor** for creating posts
- ✅ **Comment System** on blog posts
- ✅ **Responsive Design** with Tailwind CSS

## 🎯 Default Credentials

### Admin User
- **Email**: admin@blogplatform.com
- **Password**: password

### Regular User
- **Email**: user@blogplatform.com
- **Password**: password

## 📱 Quick Test

1. **Visit Homepage**: `http://localhost:8000`
2. **Register New User**: Click "Register" in navigation
3. **Create Post**: Go to "Create Post" (after login)
4. **Add Comment**: Comment on any blog post
5. **Admin Panel**: Visit `/admin` with admin credentials

## 🔧 Common Quick Fixes

### If assets don't load:
```bash
npm run dev
```

### If database errors:
```bash
php artisan migrate:fresh --seed
```

### If permission errors:
```bash
php artisan storage:link
chmod -R 755 storage bootstrap/cache
```

### If cache issues:
```bash
php artisan config:clear
php artisan cache:clear
```

## 🎨 Quick Customization

### Change App Name
Edit `.env`:
```env
APP_NAME="My Awesome Blog"
```

### Add Your Logo
Replace `public/images/logo.png`

### Customize Colors
Edit `tailwind.config.js`:
```javascript
theme: {
  extend: {
    colors: {
      primary: '#your-color',
    }
  }
}
```

## 📚 Next Steps

After quick setup:

1. **Read [Installation Guide](installation.md)** for detailed setup
2. **Check [Project Structure](project-structure.md)** to understand the codebase
3. **Review [Development Setup](development-setup.md)** for local development
4. **Explore [Features Documentation](blog-post-management.md)** to understand capabilities

## 🆘 Need Help?

- **Installation Issues**: Check [Installation Guide](installation.md)
- **Common Problems**: See [Troubleshooting](troubleshooting.md)
- **Development**: Read [Development Setup](development-setup.md)

---

**Time to Complete**: ~10 minutes  
**Difficulty**: Beginner  
**Prerequisites**: Basic command line knowledge 