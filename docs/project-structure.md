# Project Structure

This document explains the organization and structure of my Blog Platform codebase. It reflects my architectural decisions and coding organization patterns.

## 📁 Root Directory Structure

```
blog/
├── app/                    # Application logic
├── bootstrap/              # Framework bootstrap files
├── config/                 # Configuration files
├── database/               # Database files
├── docs/                   # Documentation (this folder)
├── public/                 # Publicly accessible files
├── resources/              # Frontend resources
├── routes/                 # Route definitions
├── storage/                # File storage
├── tests/                  # Test files
├── vendor/                 # Composer dependencies
├── node_modules/           # Node.js dependencies
├── .env                    # Environment configuration
├── .env.example           # Environment template
├── composer.json           # PHP dependencies
├── package.json            # Node.js dependencies
├── tailwind.config.js      # Tailwind CSS configuration
└── README.md              # Project overview
```

## 🏗️ Core Application Structure

### `/app` - Application Logic

```
app/
├── Console/                # Artisan commands
├── Exceptions/             # Exception handlers
├── Http/
│   ├── Controllers/        # Request handlers
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   ├── BlogController.php
│   │   ├── CommentController.php
│   │   └── HomeController.php
│   ├── Middleware/         # Request middleware
│   │   ├── AdminMiddleware.php
│   │   └── AuthMiddleware.php
│   └── Requests/           # Form request validation
│       ├── CreatePostRequest.php
│       └── UpdatePostRequest.php
├── Models/                 # Eloquent models
│   ├── User.php
│   ├── Post.php
│   ├── Comment.php
│   ├── Category.php
│   └── Tag.php
├── Providers/              # Service providers
├── Services/               # Business logic services
│   ├── BlogService.php
│   ├── CommentService.php
│   └── FileUploadService.php
└── Traits/                 # Reusable traits
    └── HasSlug.php
```

### `/config` - Configuration Files

```
config/
├── app.php                 # Application configuration
├── auth.php                # Authentication settings
├── database.php            # Database configuration
├── filesystems.php         # File storage settings
├── mail.php                # Email configuration
├── queue.php               # Queue settings
├── session.php             # Session configuration
└── services.php            # Third-party services
```

### `/database` - Database Files

```
database/
├── factories/              # Model factories for testing
│   ├── UserFactory.php
│   ├── PostFactory.php
│   └── CommentFactory.php
├── migrations/             # Database migrations
│   ├── 2014_10_12_000000_create_users_table.php
│   ├── 2024_01_01_000001_create_posts_table.php
│   ├── 2024_01_01_000002_create_comments_table.php
│   ├── 2024_01_01_000003_create_categories_table.php
│   └── 2024_01_01_000004_create_tags_table.php
└── seeders/                # Database seeders
    ├── DatabaseSeeder.php
    ├── UserSeeder.php
    ├── PostSeeder.php
    └── CategorySeeder.php
```

### `/resources` - Frontend Resources

```
resources/
├── css/                    # CSS source files
│   ├── app.css            # Main CSS file with Tailwind
│   └── components.css     # Component-specific styles
├── js/                     # JavaScript source files
│   ├── app.js             # Main JS file
│   ├── components/         # Vue components (if using)
│   └── quill/             # Quill editor configuration
├── lang/                   # Language files
│   └── en/                # English translations
└── views/                  # Blade templates
    ├── layouts/            # Layout templates
    │   ├── app.blade.php
    │   └── admin.blade.php
    ├── components/         # Reusable components
    │   ├── post-card.blade.php
    │   ├── comment-form.blade.php
    │   └── pagination.blade.php
    ├── auth/               # Authentication views
    │   ├── login.blade.php
    │   └── register.blade.php
    ├── posts/              # Blog post views
    │   ├── index.blade.php
    │   ├── show.blade.php
    │   ├── create.blade.php
    │   └── edit.blade.php
    ├── admin/              # Admin panel views
    │   ├── dashboard.blade.php
    │   ├── posts/          # Post management
    │   └── users/          # User management
    └── partials/           # Partial templates
        ├── header.blade.php
        ├── footer.blade.php
        └── navigation.blade.php
```

### `/routes` - Route Definitions

```
routes/
├── web.php                 # Web routes
├── api.php                 # API routes (if needed)
├── admin.php               # Admin routes
└── auth.php                # Authentication routes
```

### `/public` - Public Assets

```
public/
├── css/                    # Compiled CSS
│   └── app.css
├── js/                     # Compiled JavaScript
│   └── app.js
├── images/                 # Static images
│   ├── logo.png
│   └── uploads/           # User uploaded images
├── storage/                # Storage symlink
└── index.php              # Application entry point
```

## 🎯 Key Files Explained

### Models (`/app/Models/`)

- **User.php**: User authentication and profile management
- **Post.php**: Blog post content and relationships
- **Comment.php**: User comments on posts
- **Category.php**: Post categorization
- **Tag.php**: Post tagging system

### Controllers (`/app/Http/Controllers/`)

- **HomeController.php**: Homepage and public views
- **BlogController.php**: Blog post management
- **CommentController.php**: Comment functionality
- **AdminController.php**: Admin panel functionality
- **AuthController.php**: Authentication (Laravel Breeze)

### Views (`/resources/views/`)

- **layouts/app.blade.php**: Main application layout
- **layouts/admin.blade.php**: Admin panel layout
- **posts/show.blade.php**: Individual blog post view
- **posts/create.blade.php**: Post creation form
- **components/post-card.blade.php**: Reusable post component

### Routes (`/routes/`)

- **web.php**: Main application routes
- **admin.php**: Admin panel routes
- **auth.php**: Authentication routes (Breeze)

## 🔧 Configuration Files

### Environment (`.env`)
```env
APP_NAME="Blog Platform"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_platform
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
```

### Tailwind CSS (`tailwind.config.js`)
```javascript
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#3B82F6',
      }
    },
  },
  plugins: [],
}
```

## 📦 Package Dependencies

### PHP Dependencies (`composer.json`)
```json
{
  "require": {
    "laravel/framework": "^10.0",
    "laravel/breeze": "^1.0"
  },
  "require-dev": {
    "fakerphp/faker": "^1.9.1",
    "laravel/pint": "^1.0",
    "laravel/sail": "^1.18"
  }
}
```

### Node.js Dependencies (`package.json`)
```json
{
  "devDependencies": {
    "tailwindcss": "^3.0.0",
    "postcss": "^8.0.0",
    "autoprefixer": "^10.0.0"
  },
  "dependencies": {
    "quill": "^1.3.7"
  }
}
```

## 🎨 Frontend Architecture

### CSS Structure
- **Tailwind CSS**: Utility-first CSS framework
- **Custom Components**: Component-specific styles
- **Responsive Design**: Mobile-first approach

### JavaScript Structure
- **Vanilla JS**: For simple interactions
- **Quill Editor**: Rich text editing
- **Alpine.js**: Lightweight reactivity (optional)

### Blade Templates
- **Layouts**: Reusable page structures
- **Components**: Modular, reusable UI elements
- **Partials**: Small, reusable template parts

## 🔍 Understanding the Flow

1. **Request**: User visits a URL
2. **Routes**: Route definition matches URL to controller
3. **Controller**: Handles request and business logic
4. **Model**: Interacts with database
5. **View**: Renders response using Blade templates
6. **Response**: Returns HTML to user

## 📚 Related Documentation

- [Installation Guide](installation.md) - Setting up the project
- [Development Setup](development-setup.md) - Local development
- [Database Schema](database-schema.md) - Database structure
- [Frontend Guide](frontend-guide.md) - Blade and Tailwind usage

---

**Last Updated**: July 2024  
**Version**: 1.0.0 