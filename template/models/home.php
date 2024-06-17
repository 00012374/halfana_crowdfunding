<?php
include($_SERVER['DOCUMENT_ROOT'] . '/database/db_config.php');

include($_SERVER['DOCUMENT_ROOT'] . '/template/functions.php');

// Retrieve active projects
$projects = fetchActiveProjects($pdo);

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$stmt = $pdo->query("SELECT p.*, c.category_name 
                     FROM projects p
                     LEFT JOIN categories c ON p.category_id = c.category_id");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($projects);

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <!-- Main Content Section -->
            <h2>Welcome to Our Project Platform</h2>
            <p class="lead">Discover amazing projects and support the ones you love.</p>

            <!-- Project Categories Section -->
            <h3>Explore by Categories</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Technology</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Art</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Music</h5>
                        </div>
                    </div>
                </div>
                <!-- Add more category cards as needed -->
            </div>
        </div>
    </div>

    <div id="projectCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php if (!empty($projects)): ?>
            <?php $chunks = array_chunk($projects, 3); ?>
            <?php foreach ($chunks as $index => $chunk): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="row">
                        <?php foreach ($chunk as $project): ?>
                            <?php
                            // Initialize current funding and funding goal
                            $currentFunding = $project['funding_current'] ?? 0;
                            $fundingGoal = $project['funding_goal'] ?? 1; // Prevent division by zero
                            
                            // Calculate percentage
                            $percentage = ($currentFunding / $fundingGoal) * 100;
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card">
                                    <!-- Display project images -->
                                    <?php
                                    // Check if image path exists
                                    if (!empty($project['image_path'])) {
                                        // Display each image
                                        $imagePaths = explode(',', $project['image_path']); // If you stored multiple images as comma-separated values
                                        foreach ($imagePaths as $imagePath) {
                                            echo '<img src="' . $imagePath . '" alt="Project Image">';
                                        }
                                    }
                                    ?>
                                    <div class="card-body">
                                        <p>Category: <?php echo $project['category_name'] ?? 'Uncategorized'; ?></p>
                                        <h5 class="card-title"><?php echo htmlspecialchars($project['title'] ?? ''); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($project['description'] ?? ''); ?></p>
                                        <!-- Progress bar for funding -->
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100">
                                                <span class="progress-value"><?php echo number_format($percentage, 2, ',', '.') . '%'; ?></span>
                                            </div>
                                        </div>
                                        <a href="payment?project_id=<?php echo $project['project_id']; ?>" class="btn btn-primary btn-support">Support</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="carousel-item active">
                <p>No active projects found.</p>
            </div>
        <?php endif; ?>
    </div>
    <a class="carousel-control-prev" href="#projectCarousel" role="button" data-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next" href="#projectCarousel" role="button" data-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>



    <!-- Call-to-Action Section -->
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <h3>Have a project you'd like to fund?</h3>
            <p class="lead">Start your crowdfunding campaign now!</p>
            <a href="user_dashboard" class="btn btn-primary">Start a Project</a>
        </div>
    </div>
</div>
