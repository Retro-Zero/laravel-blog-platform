# Blog Platform with CMS

A modern blog platform with a Content Management System (CMS) built with Laravel. This project demonstrates my skills in full-stack web development, featuring user authentication, blog post management, commenting system, and responsive design using Laravel, Blade templates, Tailwind CSS, and MySQL.

## 🚀 Features

### Core Features
- **User Authentication**: Register, login, logout functionality using Laravel Breeze
- **Blog Post Management**: Create, edit, delete, and publish blog posts with rich text editor
- **Rich Text Editor**: Quill editor integrated with Laravel for enhanced content creation
- **Comment System**: User interaction and commenting on posts
- **Tag System**: Posts with tags and basic filtering capabilities
- **Responsive Design**: Mobile and desktop optimized layouts
- **Search Functionality**: Optional search and tag-based post filtering

### Technical Features
- **Server-Side Rendering**: Laravel Blade templates for dynamic content
- **Modern Styling**: Tailwind CSS for clean, responsive design
- **Database Management**: MySQL relational database for data storage
- **SEO Optimization**: Meta tags and SEO-friendly URLs
- **Content Management**: Full CMS functionality for post management
- **File Upload**: Image and media file handling
- **Admin Panel**: Comprehensive admin interface for content management

## 📋 Prerequisites

Before running this project, make sure you have the following installed:

- **PHP** (>= 8.1)
- **Composer** (for Laravel dependencies)
- **Node.js** (>= 16.0) - for Tailwind CSS compilation
- **Git**
- **MySQL** (relational database)
- **Web Server** (Apache/Nginx) or use Laravel's built-in server

## 🛠️ Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd blog
```

### 2. Backend Setup (Laravel)

#### Install PHP Dependencies
```bash
composer install
```

#### Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

#### Database Setup
```bash
# Configure your database in .env file
php artisan migrate
php artisan db:seed
```

#### Start Laravel Development Server
```bash
php artisan serve
```

### 3. Frontend Setup (Tailwind CSS)

#### Install Node.js Dependencies
```bash
npm install
```

#### Install Tailwind CSS
```bash
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
```

#### Build Assets
```bash
npm run dev
# or for production
npm run build
```

## 🏗️ Project Structure

```
blog/
├── app/                    # Laravel application logic
│   ├── Http/
│   │   ├── Controllers/   # Blog controllers
│   │   └── Middleware/    # Custom middleware
│   ├── Models/            # Eloquent models
│   └── Services/          # Business logic services
├── config/                 # Configuration files
├── database/
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders
├── public/                # Public assets
│   ├── css/              # Compiled CSS
│   ├── js/               # JavaScript files
│   └── images/           # Images and media
├── resources/
│   ├── views/            # Blade templates
│   │   ├── layouts/      # Layout templates
│   │   ├── posts/        # Post-related views
│   │   ├── auth/         # Authentication views
│   │   └── admin/        # Admin panel views
│   ├── css/              # Tailwind CSS source
│   └── js/               # JavaScript source
├── routes/                # Route definitions
├── storage/               # File storage
└── tests/                 # Test files
```

## 🎯 Routes & Endpoints

### Authentication (Laravel Breeze)
- `GET /login` - Login page
- `POST /login` - User login
- `GET /register` - Registration page
- `POST /register` - User registration
- `POST /logout` - User logout

### Blog Posts
- `GET /` - Home page with latest posts
- `GET /posts` - All blog posts
- `GET /posts/{id}` - Individual blog post
- `GET /posts/create` - Create new post (authenticated)
- `POST /posts` - Store new post (authenticated)
- `GET /posts/{id}/edit` - Edit post (author/admin)
- `PUT /posts/{id}` - Update post (author/admin)
- `DELETE /posts/{id}` - Delete post (author/admin)

### Comments
- `POST /posts/{id}/comments` - Add comment to a post
- `DELETE /comments/{id}` - Delete comment (author/admin)

### Admin Panel
- `GET /admin` - Admin dashboard
- `GET /admin/posts` - Manage all posts
- `GET /admin/users` - Manage users

## 🎨 Frontend Features

### Pages (Blade Templates)
- **Home Page**: Featured posts and latest articles
- **Blog Listing**: Paginated list of all blog posts with filtering
- **Single Post**: Individual blog post with comments and rich content
- **Create/Edit Post**: Rich text editor interface for content creation
- **User Profile**: User dashboard and post management
- **Admin Panel**: Content management interface for administrators

### Components & Features
- **Responsive Navigation**: Mobile-first navigation using Tailwind CSS
- **Post Cards**: Reusable blog post preview components
- **Rich Text Editor**: Quill editor for enhanced content creation
- **Comment System**: Interactive commenting with real-time updates
- **Search & Filtering**: Tag-based filtering and search functionality
- **Pagination**: Clean pagination for blog listings
- **User Authentication**: Laravel Breeze authentication views

## 🔧 Configuration

### Environment Variables (.env)
```env
APP_NAME="Blog Platform"
APP_ENV=local
APP_KEY=your-app-key
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_db
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Run `php artisan config:cache`
3. Run `php artisan route:cache`
4. Configure your web server (Apache/Nginx)
5. Set up SSL certificate
6. Configure MySQL database for production

### Deployment Options
- **Heroku**: Deploy Laravel app with ClearDB MySQL addon
- **Laravel Forge**: Automated deployment with server management
- **Vercel**: Optional deployment for static assets
- **Traditional Hosting**: Upload to web server with MySQL database

### Database Setup
- Use ClearDB (Heroku) or configure MySQL on your server
- Run migrations: `php artisan migrate --force`
- Seed initial data: `php artisan db:seed --force`

## 🧪 Testing

### Backend Testing
```bash
# Run Laravel tests
php artisan test

# Run specific test suite
php artisan test --filter=PostTest
```

### Frontend Testing
- Manual testing of all user interactions
- Cross-browser compatibility testing
- Mobile responsiveness testing

## 📝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🤝 Support

If you have any questions or need support:
- Create an issue in the repository
- Contact the development team
- Check the documentation in the `docs/` folder

## 🔄 Version History

- **v1.0.0** - Initial release with basic blog functionality
- **v1.1.0** - Added CMS features and admin panel
- **v1.2.0** - Enhanced frontend with modern UI/UX

## 🛠️ Tech Stack Summary

- **Backend**: Laravel (PHP framework for server-side rendering)
- **Frontend**: Laravel Blade templates, Tailwind CSS (styling)
- **Rich Text Editor**: Quill (integrated with Laravel)
- **Database**: MySQL (relational database)
- **Authentication**: Laravel Breeze
- **Deployment**: Heroku or Laravel Forge, MySQL via ClearDB, Vercel (optional)
- **Version Control**: Git/GitHub

---

**Built with ❤️ using Laravel, Blade, Tailwind CSS, and MySQL** 