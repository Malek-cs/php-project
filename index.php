<?php
session_start();

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$extra_css = 'home.css'; 

$page_part = 'header';
include("templates/layout.php"); 
?>

<header class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Find Your Perfect Study Spot</h1>
        <p class="lead mb-5 text-muted">Discover quiet cafes, libraries, and collaborative spaces tailored for your productivity.</p>
        
        <div class="d-flex justify-content-center gap-3">
            <a href="itemsPage.php" class="btn btn-dark btn-lg px-5 shadow-sm rounded-pill btn-explore">Explore Spaces</a>
            <a href="contact.php" class="btn btn-outline-dark btn-lg px-5 shadow-sm rounded-pill">Contact Us</a>
        </div>
    </div>
</header>

<section class="container py-5 mb-5">
    <div class="row align-items-center g-5">
        
        <div class="col-lg-6">
            <div class="image-wrapper">
                <img src="./public/StudySpace.jpg" alt="Study Space" class="img-fluid rounded-4 shadow-lg hero-image">
            </div>
        </div>

        <div class="col-lg-6">
            <h2 class="fw-bold mb-4">Why use StudySpaces?</h2>
            <p class="text-secondary mb-4">We know how hard it is to find a good place to focus. Our directory helps you filter and find locations based on what matters most to your study session.</p>
            
            <div class="features-card p-4 rounded-4 shadow-sm border bg-white">
                <h5 class="fw-bold mb-3">What you will find:</h5>
                <ul class="text-secondary mb-0 features-list">
                    <li><strong>Quiet Zones:</strong> Places with strict noise control.</li>
                    <li><strong>Reliable Wi-Fi:</strong> Tested and verified internet speeds.</li>
                    <li><strong>Power Outlets:</strong> Never run out of battery again.</li>
                    <li><strong>Great Coffee:</strong> Access to the best local roasters.</li>
                </ul>
            </div>
        </div>

    </div>
</section>

<?php
$page_part = 'footer';
include("templates/layout.php");
?>