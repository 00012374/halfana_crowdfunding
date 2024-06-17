<?php
// project_functions.php

// Function to fetch active projects from the database
function fetchActiveProjects(PDO $pdo) {
    try {
        $sql = "SELECT * FROM projects";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error fetching projects: " . $e->getMessage();
        return array(); // Return an empty array if there's an error
    }
}

// Function to fetch project details including image paths from the database
function fetchProjectDetails(PDO $pdo, $project_id) {
    try {
        $stmt = $pdo->prepare("SELECT title, description, funding_goal, deadline, image_path FROM projects WHERE project_id = ?");
        $stmt->execute([$project_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error fetching project details: " . $e->getMessage();
        return array(); // Return an empty array if there's an error
    }
}

// Function to fetch project details with categories from the database
function fetchProjectsWithCategories(PDO $pdo) {
    try {
        $stmt = $pdo->query("SELECT p.*, c.category_name 
        FROM projects p
        INNER JOIN categories c ON p.category_id = c.category_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error fetching projects with categories: " . $e->getMessage();
        return array(); // Return an empty array if there's an error
    }
}



?>

