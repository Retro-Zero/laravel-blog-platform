# BlogVerse Database Schema

This document provides a comprehensive overview of the BlogVerse database structure, including tables, relationships, and data models.

## 📊 Database Overview

BlogVerse uses MySQL/MariaDB as the primary database system. The schema is designed for a modern blog platform with user authentication, content management, and analytics capabilities.

## 🗄️ Table Structure

### Users Table

**Purpose**: Store user account information and authentication data

```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Key Features**:
- Email verification support
- Remember me functionality
- Password hashing via Laravel's Hash facade
- Timestamp tracking for account creation and updates

**Relationships**:
- `hasMany` Posts
- `hasMany` Comments
- `hasMany` PostViews (for authenticated users)

### Categories Table

**Purpose**: Organize blog posts into logical categories

```sql
CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Key Features**:
- SEO-friendly slug generation
- Optional description field
- Unique constraint on slug for URL routing

**Relationships**:
- `hasMany` Posts

### Posts Table

**Purpose**: Store blog post content and metadata

```sql
CREATE TABLE posts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    excerpt TEXT NULL,
    content LONGTEXT NOT NULL,
    featured_image VARCHAR(255) NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    category_id BIGINT UNSIGNED NULL,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    published_at TIMESTAMP NULL,
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    view_count INT DEFAULT 0,
    reading_time INT DEFAULT 5,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);
```

**Key Features**:
- SEO optimization fields (meta_title, meta_description)
- Status management (draft, published, archived)
- View count tracking
- Reading time calculation
- Featured image support
- Excerpt for post previews

**Relationships**:
- `belongsTo` User
- `belongsTo` Category
- `hasMany` Comments
- `hasMany` PostViews

### Comments Table

**Purpose**: Store user comments on blog posts

```sql
CREATE TABLE comments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    content LONGTEXT NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    post_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);
```

**Key Features**:
- Rich text content support
- Automatic timestamp tracking
- Cascade deletion when post or user is deleted

**Relationships**:
- `belongsTo` User
- `belongsTo` Post

### Post Views Table

**Purpose**: Track anonymous and authenticated post views for analytics

```sql
CREATE TABLE post_views (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    post_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NOT NULL,
    user_agent TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_anonymous_post_view (post_id, ip_address, user_agent(255))
);
```

**Key Features**:
- Anonymous view tracking via IP address
- User agent logging for analytics
- Unique constraint to prevent duplicate views
- Optional user association for authenticated views

**Relationships**:
- `belongsTo` Post
- `belongsTo` User (optional)

### Personal Access Tokens Table

**Purpose**: Support API authentication via Laravel Sanctum

```sql
CREATE TABLE personal_access_tokens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tokenable_type VARCHAR(255) NOT NULL,
    tokenable_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    token VARCHAR(64) UNIQUE NOT NULL,
    abilities TEXT NULL,
    last_used_at TIMESTAMP NULL,
    expires_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    INDEX personal_access_tokens_tokenable_type_tokenable_id_index (tokenable_type, tokenable_id)
);
```

**Key Features**:
- API token management
- Token expiration support
- Ability-based permissions
- Last used tracking

## 🔗 Relationships Overview

### One-to-Many Relationships

1. **User → Posts**: A user can create multiple posts
2. **User → Comments**: A user can write multiple comments
3. **Category → Posts**: A category can contain multiple posts
4. **Post → Comments**: A post can have multiple comments
5. **Post → PostViews**: A post can have multiple views

### Many-to-One Relationships

1. **Posts → User**: Each post belongs to one user
2. **Posts → Category**: Each post belongs to one category
3. **Comments → User**: Each comment belongs to one user
4. **Comments → Post**: Each comment belongs to one post
5. **PostViews → Post**: Each view belongs to one post
6. **PostViews → User**: Each view can be associated with one user (optional)

## 📈 Data Flow

### Post Creation Flow
1. User creates post via form
2. Post saved with `status = 'draft'`
3. User publishes post → `status = 'published'`
4. `published_at` timestamp set
5. Post becomes visible on public pages

### View Tracking Flow
1. User visits post page
2. System checks for existing view (IP + User Agent)
3. If unique, creates new PostView record
4. Updates post `view_count` for performance
5. Analytics data available for reporting

### Comment Flow
1. User submits comment on post
2. Comment saved with user and post relationships
3. Comment appears on post page
4. Email notifications sent (if configured)

## 🔍 Indexes and Performance

### Primary Indexes
- All tables have `id` as primary key
- Foreign key columns are indexed automatically

### Unique Indexes
- `users.email` - Ensures unique email addresses
- `posts.slug` - Ensures unique post URLs
- `categories.slug` - Ensures unique category URLs
- `personal_access_tokens.token` - Ensures unique API tokens
- `post_views` composite unique - Prevents duplicate anonymous views

### Performance Considerations
- `posts.status` indexed for filtering published posts
- `posts.published_at` indexed for chronological ordering
- `posts.user_id` indexed for user post queries
- `posts.category_id` indexed for category filtering

## 🛡️ Security Features

### Data Protection
- Passwords hashed using Laravel's Hash facade
- Email addresses validated and sanitized
- Content sanitized to prevent XSS attacks
- SQL injection protection via Eloquent ORM

### Access Control
- User authentication required for post creation
- Comment moderation capabilities
- Post status management (draft/published/archived)
- API token expiration and ability management

## 📊 Analytics and Reporting

### View Analytics
- Anonymous view tracking via IP address
- User agent logging for device/browser analytics
- View count aggregation for performance
- Time-based view analysis capabilities

### Content Analytics
- Post popularity based on view count
- Comment engagement metrics
- User activity tracking
- Category performance analysis

## 🔧 Migration Management

### Migration Files
- `0001_01_01_000000_create_users_table.php`
- `0001_01_01_000001_create_cache_table.php`
- `0001_01_01_000002_create_jobs_table.php`
- `2025_07_12_140300_create_categories_table.php`
- `2025_07_12_140342_create_posts_table.php`
- `2025_07_13_153253_create_personal_access_tokens_table.php`
- `2025_07_13_161643_create_comments_table.php`
- `2025_07_14_135710_create_post_views_table.php`
- `2025_07_16_145523_add_reading_time_to_posts_table.php`

### Seeding
- `DatabaseSeeder.php` - Main seeder orchestration
- `RealPostsSeeder.php` - Demo content creation
- Factory classes for testing data generation

## 🚀 Scaling Considerations

### Database Optimization
- Proper indexing for common queries
- Efficient relationship loading
- View count caching strategies
- Database connection pooling

### Content Management
- Image optimization and CDN integration
- Content caching strategies
- Search optimization
- SEO-friendly URL structures

---

**Note:** This schema is designed for a demonstration project by Arian Karimi. For production use, additional security, performance, and scalability considerations would be implemented. 