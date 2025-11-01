<?php
$page_title = "About - Kelly's Portfolio";
include("data/about_data.php");
include("includes/header.php");
?>

<h2><?php echo htmlspecialchars($about_title); ?></h2>

<div style="display: flex; gap: 30px; align-items: flex-start; margin: 30px 0; flex-wrap: wrap;">
    <?php if (file_exists($image_path)): ?>
        <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Kelly - About Me" style="max-width: 350px; width: 100%; height: auto; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
    <?php endif; ?>
    <div style="flex: 1; min-width: 300px;">
        <p style="font-size: 18px; line-height: 1.8;"><?php echo htmlspecialchars($bio); ?></p>
    </div>
</div>

<h3>Experience</h3>
<ul>
    <?php foreach ($experience as $exp): ?>
        <li style="margin-bottom: 15px;">
            <strong><?php echo htmlspecialchars($exp['role']); ?>:</strong>
            <?php echo htmlspecialchars($exp['description']); ?>
        </li>
    <?php endforeach; ?>
</ul>

<?php include("includes/footer.php"); ?>

