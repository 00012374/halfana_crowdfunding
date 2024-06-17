<?php
// Include the database configuration file
include($_SERVER['DOCUMENT_ROOT'] . '/database/db_config.php');

// Check if project ID is provided
if (isset($_GET['id'])) {
    $project_id = $_GET['id'];

    // Delete project from the database
    $stmt = $pdo->prepare("DELETE FROM projects WHERE project_id = ?");
    $stmt->execute([$project_id]);

    // Redirect the user to a success page or back to the project list
    header("Location: /user_dashboard");
    exit();
} else {
    echo "Project ID not provided.";
}
?>
