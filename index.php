<?php
$page_title = "Home - Kelly's Portfolio";
include("data/homepage_data.php");
include("includes/header.php");
?>

<div style="display: flex; gap: 30px; align-items: center; margin: 30px 0; flex-wrap: wrap;">
    <?php if (file_exists($image_path)): ?>
        <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Kelly - Portfolio" style="max-width: 300px; width: 100%; height: auto; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
    <?php endif; ?>
    <div style="flex: 1; min-width: 300px;">
        <h2><?php echo htmlspecialchars($homepage_title); ?></h2>
        <p style="font-size: 18px; line-height: 1.8;"><?php echo htmlspecialchars($homepage_intro); ?></p>
    </div>
</div>

<h3>Featured Skills</h3>
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
    <?php foreach ($featured_items as $item): ?>
        <div style="background: #fff; padding: 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s, box-shadow 0.3s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';">
            <?php if (isset($item['image']) && file_exists($item['image'])): ?>
                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" style="width: 100%; height: 200px; object-fit: cover; display: block;">
            <?php endif; ?>
            <div style="padding: 20px;">
                <h4 style="margin-top: 0; color: #222;"><?php echo htmlspecialchars($item['title']); ?></h4>
                <p style="margin-bottom: 0; color: #666;"><?php echo htmlspecialchars($item['description']); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include("includes/footer.php"); ?>
