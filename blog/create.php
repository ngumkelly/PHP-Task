<?php
$page_title = "Create Blog Post - Kelly's Portfolio";
$css_path = "../css/style.css";
include("../includes/config.php");
include("../includes/header.php");

$title = "";
$content = "";
$error = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if (isset($_POST['title']) && isset($_POST['content'])) {
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        
        if (empty($title)) {
            $error = "Title is required.";
        } elseif (empty($content)) {
            $error = "Content is required.";
        } else {
            $image_path = "";
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                $file_type = $_FILES['image']['type'];
                $file_size = $_FILES['image']['size'];
                
                if (!in_array($file_type, $allowed_types)) {
                    $error = "Invalid file type. Only JPEG, PNG, and GIF images are allowed.";
                } elseif ($file_size > 5000000) {
                    $error = "File size too large. Maximum size is 5MB.";
                } else {
                    $upload_dir = "../uploads/";
                    $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $new_filename = uniqid() . '_' . time() . '.' . $file_extension;
                    $target_path = $upload_dir . $new_filename;
                    
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                        $image_path = "uploads/" . $new_filename;
                    } else {
                        $error = "Failed to upload image.";
                    }
                }
            }
            
            if (empty($error)) {
                $title_escaped = mysqli_real_escape_string($conn, $title);
                $content_escaped = mysqli_real_escape_string($conn, $content);
                $image_escaped = mysqli_real_escape_string($conn, $image_path);
                
                $query = "INSERT INTO blogs (title, content, image) VALUES ('$title_escaped', '$content_escaped', '$image_escaped')";
                
                if (mysqli_query($conn, $query)) {
                    $success = true;
                    $title = "";
                    $content = "";
                } else {
                    if (!empty($image_path) && file_exists("../" . $image_path)) {
                        unlink("../" . $image_path);
                    }
                    $error = "Error creating blog post: " . mysqli_error($conn);
                }
            }
        }
    }
}
?>

<h2>Create New Blog Post</h2>
<a href="index.php" style="color: #ff9800; text-decoration: none; margin-bottom: 20px; display: inline-block;">← Back to Blog</a>

<?php if ($success): ?>
    <div style="margin-bottom: 20px; padding: 15px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; color: #155724;">
        Blog post created successfully! <a href="index.php">View all posts</a>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div style="margin-bottom: 20px; padding: 15px; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; color: #721c24;">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

<form action="create.php" method="post" enctype="multipart/form-data" style="max-width: 800px;">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required style="width: 100%; padding: 10px; margin-top: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;" value="<?php echo htmlspecialchars($title); ?>"><br>

    <label for="content">Content:</label><br>
    <textarea id="content" name="content" rows="15" required style="width: 100%; padding: 10px; margin-top: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;"><?php echo htmlspecialchars($content); ?></textarea><br>

    <label for="image">Image (optional):</label><br>
    <input type="file" id="image" name="image" accept="image/jpeg,image/jpg,image/png,image/gif" style="width: 100%; padding: 10px; margin-top: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;"><br>
    <small style="color: #666;">Accepted formats: JPEG, PNG, GIF (Max 5MB)</small><br><br>

    <button type="submit" name="submit" style="padding: 12px 30px; background: #ff9800; color: #fff; font-size: 16px; font-weight: bold; cursor: pointer; border: none; border-radius: 5px;">Create Post</button>
    <a href="index.php" style="margin-left: 10px; padding: 12px 30px; background: #666; color: #fff; text-decoration: none; border-radius: 5px; display: inline-block;">Cancel</a>
</form>

<?php include("../includes/footer.php"); ?>
