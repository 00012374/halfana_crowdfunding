<?php

// Include necessary files and configurations
include($_SERVER['DOCUMENT_ROOT'] . '/database/db_config.php');
// Define base URL
$base_url = "/"; // Change this to the actual directory if your project is in a subdirectory

// Get the requested URL
$request_uri = $_SERVER['REQUEST_URI'];
$uri_segments = explode('?', $request_uri, 2);
$uri = rtrim($uri_segments[0], '/');

// echo "Requested URI: $uri<br>";

// Define routes
$routes = array(
    '/' => 'home.php',
    '/login' => 'login.php',
    '/register' => 'register.php',
    '/user_dashboard' => 'user_dashboard.php',
    '/admin_dashboard' => 'admin_dashboard.php',
    '/register_process' => 'register_process.php',
    '/login_process' => 'login_process.php',
    '/logout' => 'logout.php',
    '/add-project' => 'add_project.php',
    '/add-project-process' => 'add_project_process.php',
    '/edit-project' => 'edit_project.php',
    '/edit-project-process' => 'edit_project_process.php',
    '/delete-project-process' => 'delete_project_process.php',
    '/payment' => 'payment.php',
    '/payment_process' => 'payment_process.php',
    '/success' => 'success.php',
    // Add more routes as needed
);

// Debug: Print all routes
// echo "Available Routes:<br>";
// print_r($routes);
// echo "<br>";

if (array_key_exists($uri, $routes)) {
    $headerPath = $_SERVER['DOCUMENT_ROOT'] . '/template/common/header.php';
    $footerPath = $_SERVER['DOCUMENT_ROOT'] . '/template/common/footer.php';
    $modelPath = $_SERVER['DOCUMENT_ROOT'] . '/template/models/' . $routes[$uri];

    // Check if files exist before including
    if (file_exists($headerPath) && file_exists($modelPath) && file_exists($footerPath)) {
        // Include the corresponding page with header and footer
        include($headerPath);
        include($modelPath);
        include($footerPath);
    } else {
        // Handle file not found error
        include($_SERVER['DOCUMENT_ROOT'] . '/template/models/404.php');
    }
} else {
    // Handle 404 error
    include($_SERVER['DOCUMENT_ROOT'] . '/template/models/404.php');
}

// Close database connection if needed
if (isset($conn)) {
    $conn->close();
}
?>
