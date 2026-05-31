<?php
session_start();

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$page_part = 'header';
include "templates/layout.php";
?>

<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h1 class="display-4 fw-bold">Welcome back, <?php echo htmlspecialchars($_SESSION['user_data']['username']); ?>!</h1>
            <p class="lead text-muted">What would you like to do today?</p>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-4">
                <div class="card-body">
                    <i class="fa-solid fa-map-location-dot fa-3x mb-3 text-primary"></i>
                    <h4 class="card-title fw-bold">Explore Spaces</h4>
                    <p class="card-text text-secondary">Find your next perfect study spot from our directory.</p>
                    <a href="itemsPage.php" class="btn btn-dark rounded-pill px-4">Browse</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-4">
                <div class="card-body">
                    <i class="fa-solid fa-pen-to-square fa-3x mb-3 text-success"></i>
                    <h4 class="card-title fw-bold">Submit a Space</h4>
                    <p class="card-text text-secondary">Know a great place? Request to add it to our list.</p>
                    <a href="submit.php" class="btn btn-dark rounded-pill px-4">Submit Now</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-4">
                <div class="card-body">
                    <i class="fa-solid fa-list-check fa-3x mb-3 text-warning"></i>
                    <h4 class="card-title fw-bold">My Submissions</h4>
                    <p class="card-text text-secondary">View the status of the spaces you have submitted.</p>
                    <a href="my_submissions.php" class="btn btn-dark rounded-pill px-4">View Status</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-4">
                <div class="card-body">
                    <i class="fa-solid fa-upload fa-3x mb-3 text-info"></i>
                    <h4 class="card-title fw-bold">Upload File</h4>
                    <p class="card-text text-secondary">Upload an image or document to the server.</p>
                    <a href="upload.php" class="btn btn-dark rounded-pill px-4">Upload</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-4">
                <div class="card-body">
                    <i class="fa-solid fa-code fa-3x mb-3 text-secondary"></i>
                    <h4 class="card-title fw-bold">JSON Display</h4>
                    <p class="card-text text-secondary">Browse space data fetched and decoded from our JSON API.</p>
                    <a href="json_display.php" class="btn btn-dark rounded-pill px-4">View</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$page_part = 'footer';
include "templates/layout.php";
?>
