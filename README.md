# PHP Portfolio & Blog Website

A simple PHP portfolio website with a blog section using MySQL.

## Setup Instructions

### 1. Database Setup

1. Start XAMPP and ensure MySQL is running
2. Open phpMyAdmin (http://localhost/phpmyadmin)
3. Import the `database_setup.sql` file or run the following SQL:

```sql
CREATE DATABASE IF NOT EXISTS portfolio_blog;

USE portfolio_blog;

CREATE TABLE IF NOT EXISTS blogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

**Note:** If you already have the database set up, run `database_migration_image.sql` to add the image column. If you get an error that the column already exists, use `database_migration_image_safe.sql` instead, which checks before adding the column.

### 2. Database Configuration

Edit `includes/config.php` and update the database credentials if needed:

```php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "portfolio_blog";
```

### 3. File Permissions

Ensure the web server has read access to all files. The `/uploads` directory is required for blog image uploads and must be writable by the web server.

### 4. Running the Application

1. Place all files in your XAMPP `htdocs` folder (or your web server directory)
2. Access the site at: `http://localhost/PHP-Task/`

## Features

### Portfolio Pages
- **Homepage** (`index.php`) - Displays introduction and featured items
- **About** (`about.php`) - Shows bio and experience
- **Services** (`services.php`) - Lists services offered
- **Contact** (`contact.php`) - Contact form with submission handling

### Blog Section
- **List Posts** (`blog/index.php`) - View all blog posts with images
- **View Post** (`blog/view.php?id=X`) - Read a single blog post with image
- **Create Post** (`blog/create.php`) - Add a new blog post with optional image upload
- **Edit Post** (`blog/edit.php?id=X`) - Edit an existing blog post and update/replace images
- **Delete Post** (`blog/delete.php?id=X`) - Delete a blog post and its associated image

**Image Upload Features:**
- Support for JPEG, PNG, and GIF formats
- Maximum file size: 5MB
- Images are stored in the `/uploads` directory
- Images are automatically deleted when posts are deleted

## File Structure

```
/portfolio_blog/
├── /includes/
│   ├── header.php
│   ├── footer.php
│   └── config.php
├── /data/
│   ├── homepage_data.php
│   ├── about_data.php
│   ├── services_data.php
│   └── image.jpg
├── /blog/
│   ├── index.php
│   ├── view.php
│   ├── create.php
│   ├── edit.php
│   └── delete.php
├── /uploads/
│   └── (blog post images stored here)
├── /css/
│   └── style.css
├── index.php
├── about.php
├── services.php
├── contact.php
└── database_setup.sql
```

## Technology Stack

- **Backend**: PHP (no frameworks)
- **Database**: MySQL (using mysqli_* functions)
- **Frontend**: HTML, CSS, JavaScript
- **Security**: Input sanitization with `htmlspecialchars` and `mysqli_real_escape_string`
- **File Uploads**: Secure image upload handling with type and size validation

