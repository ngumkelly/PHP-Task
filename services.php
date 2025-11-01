<?php
$page_title = "Services - Kelly's Portfolio";
include("data/services_data.php");
include("includes/header.php");
?>

<h2>Services</h2>
<p>Here are the services I offer:</p>

<div style="display: grid; gap: 25px; margin-top: 20px;">
    <?php foreach ($services as $service): ?>
        <div style="background: #fff; padding: 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s, box-shadow 0.3s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';">
            <?php if (isset($service['image']) && file_exists($service['image'])): ?>
                <img src="<?php echo htmlspecialchars($service['image']); ?>" alt="<?php echo htmlspecialchars($service['title']); ?>" style="width: 100%; height: 200px; object-fit: cover; display: block;">
            <?php endif; ?>
            <div style="padding: 25px;">
                <h3 style="margin-top: 0; color: #222;"><?php echo htmlspecialchars($service['title']); ?></h3>
                <p style="margin-bottom: 0; color: #666;"><?php echo htmlspecialchars($service['description']); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include("includes/footer.php"); ?>
