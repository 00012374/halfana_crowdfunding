<!-- edit_project.php -->
<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $project_id = $_POST['project_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Update project data in the database
    $stmt = $pdo->prepare("UPDATE projects SET title = :title, description = :description WHERE project_id = :project_id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':project_id', $project_id);

    try {
        $stmt->execute();
        echo "Project updated successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
