<!-- create_project.php -->
<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_POST['user_id']; // You may set this value based on the logged-in user

    // Insert project data into the database
    $stmt = $pdo->prepare("INSERT INTO projects (title, description, user_id) VALUES (:title, :description, :user_id)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':user_id', $user_id);

    try {
        $stmt->execute();
        echo "Project created successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
