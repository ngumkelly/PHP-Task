<?php
include("../includes/config.php");

$blog_id = 0;
$error = "";
$success = false;

if (isset($_GET['id'])) {
    $blog_id = (int)$_GET['id'];
    
    $query_select = "SELECT image FROM blogs WHERE id = " . mysqli_real_escape_string($conn, $blog_id);
    $result_select = mysqli_query($conn, $query_select);
    
    $image_path = "";
    if ($result_select && mysqli_num_rows($result_select) > 0) {
        $row = mysqli_fetch_assoc($result_select);
        $image_path = $row['image'];
    }
    
    $query = "DELETE FROM blogs WHERE id = " . mysqli_real_escape_string($conn, $blog_id);
    
    if (mysqli_query($conn, $query)) {
        if (mysqli_affected_rows($conn) > 0) {
            if (!empty($image_path) && file_exists("../" . $image_path)) {
                unlink("../" . $image_path);
            }
            $success = true;
        } else {
            $error = "Blog post not found.";
        }
    } else {
        $error = "Error deleting blog post: " . mysqli_error($conn);
    }
} else {
    $error = "No blog post ID provided.";
}

if ($success) {
    header("Location: index.php");
    exit();
} else {
    $page_title = "Delete Blog Post - Kelly's Portfolio";
    $css_path = "../css/style.css";
    include("../includes/header.php");
    ?>
    
    <h2>Delete Blog Post</h2>
    
    <?php if ($error): ?>
        <div style="margin-bottom: 20px; padding: 15px; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; color: #721c24;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    
    <a href="index.php">Back to Blog</a>
    
    <?php include("../includes/footer.php"); ?>
<?php } ?>
