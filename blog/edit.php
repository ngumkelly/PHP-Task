<?php
$page_title = "Edit Blog Post - Kelly's Portfolio";
$css_path = "../css/style.css";
include("../includes/config.php");
include("../includes/header.php");

$blog = null;
$blog_id = 0;
$title = "";
$content = "";
$current_image = "";
$error = "";
$success = false;

if (isset($_GET['id'])) {
    $blog_id = (int)$_GET['id'];
    
    $query = "SELECT id, title, content, image FROM blogs WHERE id = " . mysqli_real_escape_string($conn, $blog_id);
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $blog = mysqli_fetch_assoc($result);
        $title = $blog['title'];
        $content = $blog['content'];
        $current_image = $blog['image'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['content'])) {
        $blog_id = (int)$_POST['id'];
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        
        if (empty($title)) {
            $error = "Title is required.";
        } elseif (empty($content)) {
            $error = "Content is required.";
        } else {
            $image_path = $current_image;
            
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
                        if (!empty($current_image) && file_exists("../" . $current_image)) {
                            unlink("../" . $current_image);
                        }
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
                
                $query = "UPDATE blogs SET title = '$title_escaped', content = '$content_escaped', image = '$image_escaped' WHERE id = " . mysqli_real_escape_string($conn, $blog_id);
                
                if (mysqli_query($conn, $query)) {
                    $success = true;
                } else {
                    if ($image_path != $current_image && !empty($image_path) && file_exists("../" . $image_path)) {
                        unlink("../" . $image_path);
                    }
                    $error = "Error updating blog post: " . mysqli_error($conn);
                }
            }
        }
    }
}

if ($success) {
    header("Location: view.php?id=" . $blog_id);
    exit();
}
?>

<h2>Edit Blog Post</h2>
<a href="index.php" style="color: #ff9800; text-decoration: none; margin-bottom: 20px; display: inline-block;">← Back to Blog</a>

<?php if ($error): ?>
    <div style="margin-bottom: 20px; padding: 15px; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; color: #721c24;">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

<?php if ($blog): ?>
    <form action="edit.php" method="post" enctype="multipart/form-data" style="max-width: 800px;">
        <input type="hidden" name="id" value="<?php echo (int)$blog['id']; ?>">
        
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required style="width: 100%; padding: 10px; margin-top: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;" value="<?php echo htmlspecialchars($title); ?>"><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="15" required style="width: 100%; padding: 10px; margin-top: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;"><?php echo htmlspecialchars($content); ?></textarea><br>

        <label for="image">Image (optional):</label><br>
        <?php if (!empty($current_image) && file_exists("../" . $current_image)): ?>
            <div style="margin-bottom: 10px;">
                <p style="margin-bottom: 5px;">Current image:</p>
                <img src="../<?php echo htmlspecialchars($current_image); ?>" alt="Current image" style="max-width: 300px; max-height: 200px; border-radius: 5px; border: 1px solid #ccc;">
            </div>
        <?php endif; ?>
        <input type="file" id="image" name="image" accept="image/jpeg,image/jpg,image/png,image/gif" style="width: 100%; padding: 10px; margin-top: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;"><br>
        <small style="color: #666;">Accepted formats: JPEG, PNG, GIF (Max 5MB). Leave empty to keep current image.</small><br><br>

        <button type="submit" name="submit" style="padding: 12px 30px; background: #2196F3; color: #fff; font-size: 16px; font-weight: bold; cursor: pointer; border: none; border-radius: 5px;">Update Post</button>
        <a href="view.php?id=<?php echo (int)$blog['id']; ?>" style="margin-left: 10px; padding: 12px 30px; background: #666; color: #fff; text-decoration: none; border-radius: 5px; display: inline-block;">Cancel</a>
    </form>
<?php else: ?>
    <p>Blog post not found.</p>
    <a href="index.php">Back to Blog</a>
<?php endif; ?>

<?php include("../includes/footer.php"); ?>
