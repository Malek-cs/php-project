<?php
if (isset($page_part) && $page_part == 'header'): ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>StudySpaces | Find Your Spot</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand text-dark" href="index.php">STUDYSPACES.</a>
            
            <form class="d-none d-md-flex mx-auto" style="width: 320px;">
                <input class="form-control search-input" type="search" placeholder="Search cafes..." aria-label="Search">
            </form>

            <div class="navbar-nav ms-auto gap-1">
                <a class="nav-link active" href="itemsPage.php">Explore</a>
                <a class="nav-link text-secondary" href="contact.php">Contact</a>
            </div>
        </div>
    </nav>
    <main>
<?php endif; ?>

<?php if (isset($page_part) && $page_part == 'footer'): ?>
    </main>
    <footer class="footer">
        <div class="container text-center">
            </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
<?php endif; ?>