<?php
$page_part = 'header';
include("templates/layout.php");
?>

<div class="container text-center mt-5">
    <h1 style="font-size: 80px;">404</h1>
    <h3>Page Not Found</h3>
    <p class="text-muted">The page you are looking for does not exist.</p>

    <a href="index.php" class="btn btn-dark mt-3">Back to Home</a>
</div>

<?php
$page_part = 'footer';
include("templates/layout.php");
?>