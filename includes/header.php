<?php 
if (!isset($conn)) {
    if (file_exists(__DIR__ . "/config.php")) {
        include(__DIR__ . "/config.php");
    } elseif (file_exists("../includes/config.php")) {
        include("../includes/config.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : $site_name; ?></title>
    <link rel="stylesheet" href="<?php echo isset($css_path) ? $css_path : 'css/style.css'; ?>">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($site_name); ?></h1>
        <nav>
            <a href="<?php echo isset($css_path) ? '../' : ''; ?>index.php">Home</a> |
            <a href="<?php echo isset($css_path) ? '../' : ''; ?>about.php">About</a> |
            <a href="<?php echo isset($css_path) ? '../' : ''; ?>services.php">Services</a> |
            <a href="<?php echo isset($css_path) ? '../' : ''; ?>contact.php">Contact</a> |
            <a href="<?php echo isset($css_path) ? 'index.php' : 'blog/index.php'; ?>">Blog</a>
        </nav>
    </header>
    <main>
