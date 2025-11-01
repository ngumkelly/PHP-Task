<?php
$page_title = "View Blog Post - Kelly's Portfolio";
$css_path = "../css/style.css";
include("../includes/config.php");
include("../includes/header.php");

$blog = null;
$blog_id = 0;

if (isset($_GET['id'])) {
    $blog_id = (int)$_GET['id'];
    
    $query = "SELECT id, title, content, image, created_at FROM blogs WHERE id = " . mysqli_real_escape_string($conn, $blog_id);
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $blog = mysqli_fetch_assoc($result);
    }
}
?>

<?php if ($blog): ?>
    <div style="max-width: 800px;">
        <a href="index.php" style="color: #ff9800; text-decoration: none; margin-bottom: 20px; display: inline-block;">← Back to Blog</a>
        
        <h2><?php echo htmlspecialchars($blog['title']); ?></h2>
        <p style="color: #666; font-size: 14px; margin-bottom: 20px;">Posted on: <?php echo htmlspecialchars($blog['created_at']); ?></p>
        
        <?php if (!empty($blog['image']) && file_exists("../" . $blog['image'])): ?>
            <img src="../<?php echo htmlspecialchars($blog['image']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" style="width: 100%; max-height: 500px; object-fit: cover; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <?php endif; ?>
        
        <div style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); line-height: 1.8;">
            <?php echo nl2br(htmlspecialchars($blog['content'])); ?>
        </div>
        
        <div style="margin-top: 30px;">
            <a href="edit.php?id=<?php echo (int)$blog['id']; ?>" style="display: inline-block; padding: 10px 20px; background: #2196F3; color: #fff; text-decoration: none; border-radius: 5px; margin-right: 10px;">Edit</a>
            <a href="delete.php?id=<?php echo (int)$blog['id']; ?>" style="display: inline-block; padding: 10px 20px; background: #f44336; color: #fff; text-decoration: none; border-radius: 5px;" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
        </div>
    </div>
<?php else: ?>
    <p>Blog post not found.</p>
    <a href="index.php">Back to Blog</a>
<?php endif; ?>

<?php include("../includes/footer.php"); ?>
