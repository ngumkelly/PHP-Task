<?php
$page_title = "Contact - Kelly's Portfolio";
include("includes/header.php");

$submitted_name = "";
$submitted_email = "";
$submitted_message = "";
$form_submitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if (isset($_POST["name"])) {
        $submitted_name = htmlspecialchars(trim($_POST["name"]));
    }
    if (isset($_POST["email"])) {
        $submitted_email = htmlspecialchars(trim($_POST["email"]));
    }
    if (isset($_POST["message"])) {
        $submitted_message = htmlspecialchars(trim($_POST["message"]));
    }
    $form_submitted = true;
}
?>

<h2>Get in Touch</h2>
<p>You can reach me via the form below:</p>

<form action="contact.php" method="post" style="max-width: 600px;">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($submitted_name); ?>"><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($submitted_email); ?>"><br><br>

    <label for="message">Message:</label><br>
    <textarea id="message" name="message" rows="5" required><?php echo htmlspecialchars($submitted_message); ?></textarea><br><br>

    <button type="submit" name="submit">Send</button>
</form>

<?php if ($form_submitted): ?>
    <div style="margin-top: 30px; padding: 20px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; color: #155724;">
        <h3>Form Submitted Successfully!</h3>
        <p><strong>Name:</strong> <?php echo $submitted_name; ?></p>
        <p><strong>Email:</strong> <?php echo $submitted_email; ?></p>
        <p><strong>Message:</strong> <?php echo $submitted_message; ?></p>
    </div>
<?php endif; ?>

<?php include("includes/footer.php"); ?>
