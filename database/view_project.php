<!-- view_project.php -->
<?php
require_once 'db_config.php';

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    // Retrieve project details from the database
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE project_id = :project_id");
    $stmt->bindParam(':project_id', $project_id);

    try {
        $stmt->execute();
        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        // Display project details
        if ($project) {
            echo "<h2>{$project['title']}</h2>";
            echo "<p>{$project['description']}</p>";
            echo "<p>Funding Goal: {$project['funding_goal']}</p>";
            // Add more project details as needed
        } else {
            echo "Project not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
