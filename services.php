<!DOCTYPE html>
<html>
<head>
  <title>My Projects</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>My Projects</h1>
    <nav>
      <a href="index.php">Home</a> |
      <a href="projects.php">Projects</a> |
      <a href="contact.php">Contact</a>
    </nav>
  </header>

  <main>
    <h2>Project List</h2>
    <ul>
      <?php
      $projects = [
        "Kimbolingo Admin Dashboard (AWS + Terraform)",
        "CI/CD Pipeline for Maven Application",
        "Makeup Page Website",
        "Cooking Business Site (Yabo Foods)"
      ];

      foreach ($projects as $project) {
          echo "<li>$project</li>";
      }
      ?>
    </ul>
  </main>
</body>
</html>