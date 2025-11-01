<!DOCTYPE html>
<html>
<head>
    <title>Contact - My Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Contact Me</h1>
        <nav>
            <a href="index.php">Home</a> |
            <a href="projects.php">Projects</a> |
            <a href="contact.php">Contact</a>
        </nav>
    </header>

    <main>
        <h2>Get in Touch</h2>
        <p>You can reach me via the form below:</p>

        <form action="contact.php" method="post">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="5" required></textarea><br><br>

            <button type="submit">Send</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $message = htmlspecialchars($_POST["message"]);
            echo "<p>✅ Thank you, $name! Your message has been received.</p>";
        }
        ?>
    </main>

    <footer>
        <p>&copy; 2025 Kelly's Portfolio</p>
    </footer>
</body>
</html>
