<?php
$page_title = "Blog - Kelly's Portfolio";
$css_path = "../css/style.css";
include("../includes/config.php");
include("../includes/header.php");

$blogs = [];
$query = "SELECT id, title, content, image, created_at FROM blogs ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $blogs[] = $row;
    }
}
?>

<h2>Blog Posts</h2>
<a href="create.php" style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background: #ff9800; color: #fff; text-decoration: none; border-radius: 5px;">Create New Post</a>

<?php if (empty($blogs)): ?>
    <p>No blog posts yet. <a href="create.php">Create your first post</a>!</p>
<?php else: ?>
    <div style="display: grid; gap: 20px; margin-top: 20px;">
        <?php foreach ($blogs as $blog): ?>
            <div style="background: #fff; padding: 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s, box-shadow 0.3s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';">
                <?php if (!empty($blog['image']) && file_exists("../" . $blog['image'])): ?>
                    <img src="../<?php echo htmlspecialchars($blog['image']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" style="width: 100%; height: 250px; object-fit: cover; display: block;">
                <?php endif; ?>
                <div style="padding: 20px;">
                    <h3><a href="view.php?id=<?php echo (int)$blog['id']; ?>" style="color: #222; text-decoration: none;"><?php echo htmlspecialchars($blog['title']); ?></a></h3>
                    <p style="color: #666; font-size: 14px;">Posted on: <?php echo htmlspecialchars($blog['created_at']); ?></p>
                    <p><?php echo htmlspecialchars(substr($blog['content'], 0, 150)); ?><?php echo strlen($blog['content']) > 150 ? '...' : ''; ?></p>
                    <div style="margin-top: 15px;">
                        <a href="view.php?id=<?php echo (int)$blog['id']; ?>" style="color: #ff9800; text-decoration: none; margin-right: 15px;">Read More</a>
                        <a href="edit.php?id=<?php echo (int)$blog['id']; ?>" style="color: #2196F3; text-decoration: none; margin-right: 15px;">Edit</a>
                        <a href="delete.php?id=<?php echo (int)$blog['id']; ?>" style="color: #f44336; text-decoration: none;" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include("../includes/footer.php"); ?>
