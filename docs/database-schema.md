# Database Schema

This document describes the database structure, relationships, and data flow for my Blog Platform. It showcases my database design skills and understanding of relational data modeling.

## 📊 Database Overview

The Blog Platform uses MySQL as the primary database with the following core tables:

- **users** - User accounts and authentication
- **posts** - Blog posts and content
- **comments** - User comments on posts
- **categories** - Post categorization
- **tags** - Post tagging system
- **post_tag** - Many-to-many relationship between posts and tags

## 🏗️ Table Structures

### Users Table

```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE,
    avatar VARCHAR(255) NULL,
    bio TEXT NULL,
    website VARCHAR(255) NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

**Fields:**
- `id`: Primary key
- `name`: User's display name
- `email`: Unique email address
- `email_verified_at`: Email verification timestamp
- `password`: Hashed password
- `is_admin`: Admin privileges flag
- `avatar`: Profile picture path
- `bio`: User biography
- `website`: User's website URL
- `remember_token`: Laravel remember me token
- `created_at`: Account creation timestamp
- `updated_at`: Last update timestamp

### Posts Table

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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    INDEX idx_posts_user_id (user_id),
    INDEX idx_posts_category_id (category_id),
    INDEX idx_posts_status (status),
    INDEX idx_posts_published_at (published_at)
);
```

**Fields:**
- `id`: Primary key
- `title`: Post title
- `slug`: URL-friendly title
- `excerpt`: Short post summary
- `content`: Full post content (HTML)
- `featured_image`: Featured image path
- `user_id`: Author (foreign key to users)
- `category_id`: Post category (foreign key to categories)
- `status`: Post publication status
- `published_at`: Publication timestamp
- `meta_title`: SEO meta title
- `meta_description`: SEO meta description
- `view_count`: Number of views
- `created_at`: Post creation timestamp
- `updated_at`: Last update timestamp

### Comments Table

```sql
CREATE TABLE comments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    post_id BIGINT UNSIGNED NOT NULL,
    parent_id BIGINT UNSIGNED NULL,
    is_approved BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (parent_id) REFERENCES comments(id) ON DELETE CASCADE,
    INDEX idx_comments_post_id (post_id),
    INDEX idx_comments_user_id (user_id),
    INDEX idx_comments_parent_id (parent_id),
    INDEX idx_comments_is_approved (is_approved)
);
```

**Fields:**
- `id`: Primary key
- `content`: Comment text
- `user_id`: Comment author (foreign key to users)
- `post_id`: Associated post (foreign key to posts)
- `parent_id`: Parent comment for replies (self-referencing)
- `is_approved`: Comment approval status
- `created_at`: Comment creation timestamp
- `updated_at`: Last update timestamp

### Categories Table

```sql
CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description TEXT NULL,
    color VARCHAR(7) DEFAULT '#3B82F6',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_categories_slug (slug)
);
```

**Fields:**
- `id`: Primary key
- `name`: Category name
- `slug`: URL-friendly name
- `description`: Category description
- `color`: Category color (hex)
- `created_at`: Category creation timestamp
- `updated_at`: Last update timestamp

### Tags Table

```sql
CREATE TABLE tags (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_tags_slug (slug)
);
```

**Fields:**
- `id`: Primary key
- `name`: Tag name
- `slug`: URL-friendly name
- `created_at`: Tag creation timestamp
- `updated_at`: Last update timestamp

### Post Tags Pivot Table

```sql
CREATE TABLE post_tag (
    post_id BIGINT UNSIGNED NOT NULL,
    tag_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY (post_id, tag_id),
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE,
    INDEX idx_post_tag_post_id (post_id),
    INDEX idx_post_tag_tag_id (tag_id)
);
```

**Fields:**
- `post_id`: Post ID (part of composite primary key)
- `tag_id`: Tag ID (part of composite primary key)
- `created_at`: Relationship creation timestamp

## 🔗 Relationships

### One-to-Many Relationships

1. **User → Posts**: One user can have many posts
   ```php
   // User model
   public function posts() {
       return $this->hasMany(Post::class);
   }
   
   // Post model
   public function user() {
       return $this->belongsTo(User::class);
   }
   ```

2. **User → Comments**: One user can have many comments
   ```php
   // User model
   public function comments() {
       return $this->hasMany(Comment::class);
   }
   
   // Comment model
   public function user() {
       return $this->belongsTo(User::class);
   }
   ```

3. **Post → Comments**: One post can have many comments
   ```php
   // Post model
   public function comments() {
       return $this->hasMany(Comment::class);
   }
   
   // Comment model
   public function post() {
       return $this->belongsTo(Post::class);
   }
   ```

4. **Category → Posts**: One category can have many posts
   ```php
   // Category model
   public function posts() {
       return $this->hasMany(Post::class);
   }
   
   // Post model
   public function category() {
       return $this->belongsTo(Category::class);
   }
   ```

### Many-to-Many Relationships

1. **Posts ↔ Tags**: Many posts can have many tags
   ```php
   // Post model
   public function tags() {
       return $this->belongsToMany(Tag::class);
   }
   
   // Tag model
   public function posts() {
       return $this->belongsToMany(Post::class);
   }
   ```

### Self-Referencing Relationships

1. **Comments → Comments**: Comments can have parent comments (replies)
   ```php
   // Comment model
   public function parent() {
       return $this->belongsTo(Comment::class, 'parent_id');
   }
   
   public function replies() {
       return $this->hasMany(Comment::class, 'parent_id');
   }
   ```

## 📊 Sample Data

### Default Categories
```sql
INSERT INTO categories (name, slug, description, color) VALUES
('Technology', 'technology', 'Tech-related posts', '#3B82F6'),
('Lifestyle', 'lifestyle', 'Lifestyle and personal posts', '#10B981'),
('Travel', 'travel', 'Travel experiences and tips', '#F59E0B'),
('Food', 'food', 'Food and cooking posts', '#EF4444'),
('Business', 'business', 'Business and entrepreneurship', '#8B5CF6');
```

### Default Tags
```sql
INSERT INTO tags (name, slug) VALUES
('laravel', 'laravel'),
('php', 'php'),
('web-development', 'web-development'),
('tutorial', 'tutorial'),
('tips', 'tips'),
('coding', 'coding'),
('design', 'design'),
('productivity', 'productivity');
```

## 🔍 Common Queries

### Get Published Posts with Author and Category
```sql
SELECT 
    p.*,
    u.name as author_name,
    c.name as category_name
FROM posts p
JOIN users u ON p.user_id = u.id
LEFT JOIN categories c ON p.category_id = c.id
WHERE p.status = 'published'
ORDER BY p.published_at DESC;
```

### Get Posts with Tags
```sql
SELECT 
    p.*,
    GROUP_CONCAT(t.name) as tags
FROM posts p
LEFT JOIN post_tag pt ON p.id = pt.post_id
LEFT JOIN tags t ON pt.tag_id = t.id
WHERE p.status = 'published'
GROUP BY p.id
ORDER BY p.published_at DESC;
```

### Get Comments with User Info
```sql
SELECT 
    c.*,
    u.name as user_name,
    u.avatar as user_avatar
FROM comments c
JOIN users u ON c.user_id = u.id
WHERE c.post_id = ? AND c.is_approved = 1
ORDER BY c.created_at ASC;
```

## 🛠️ Migrations

### Create Posts Migration
```php
public function up()
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('excerpt')->nullable();
        $table->longText('content');
        $table->string('featured_image')->nullable();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
        $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
        $table->timestamp('published_at')->nullable();
        $table->string('meta_title')->nullable();
        $table->text('meta_description')->nullable();
        $table->integer('view_count')->default(0);
        $table->timestamps();
        
        $table->index(['user_id', 'status']);
        $table->index('published_at');
    });
}
```

### Create Comments Migration
```php
public function up()
{
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->text('content');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('post_id')->constrained()->onDelete('cascade');
        $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
        $table->boolean('is_approved')->default(true);
        $table->timestamps();
        
        $table->index(['post_id', 'is_approved']);
    });
}
```

## 📈 Performance Considerations

### Indexes
- Primary keys are automatically indexed
- Foreign keys should be indexed for better JOIN performance
- Frequently queried columns (status, published_at) are indexed
- Slug columns are indexed for URL lookups

### Query Optimization
- Use eager loading to prevent N+1 queries
- Implement pagination for large datasets
- Cache frequently accessed data
- Use database transactions for data integrity

### Example Optimized Query
```php
// Eager load relationships to prevent N+1 queries
$posts = Post::with(['user', 'category', 'tags'])
    ->where('status', 'published')
    ->orderBy('published_at', 'desc')
    ->paginate(10);
```

## 🔒 Security Considerations

### Data Validation
- Validate all user inputs
- Sanitize HTML content before storage
- Use prepared statements (Laravel Eloquent handles this)

### Access Control
- Implement proper authorization checks
- Validate user permissions for admin actions
- Protect against SQL injection (Laravel handles this)

### Data Integrity
- Use foreign key constraints
- Implement soft deletes where appropriate
- Regular database backups

## 📚 Related Documentation

- [Installation Guide](installation.md) - Database setup
- [Development Setup](development-setup.md) - Local database configuration
- [API Documentation](api-documentation.md) - Database operations via API

---

**Last Updated**: July 2024  
**Version**: 1.0.0 