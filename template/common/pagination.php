<?php
// Pagination settings
$projectsPerPage = 10; // Number of projects to display per page
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $projectsPerPage;

// Fetch user's projects count
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM projects WHERE user_id = ?");
$stmt->execute([$user_id]);
$projectsTotal = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Calculate total pages
$totalPages = ceil($projectsTotal / $projectsPerPage);
?>

<nav aria-label="Projects Pagination">
    <ul class="pagination justify-content-center">
        <?php if ($current_page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo ($current_page === $i) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
        <?php if ($current_page < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $current_page + 1; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
