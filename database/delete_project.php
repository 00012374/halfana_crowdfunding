<!-- delete_project.php -->
<?php
require_once 'db_config.php';

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    // Delete project from the database
    $stmt = $pdo->prepare("DELETE FROM projects WHERE project_id = :project_id");
    $stmt->bindParam(':project_id', $project_id);

    try {
        $stmt->execute();
        echo "Project deleted successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
