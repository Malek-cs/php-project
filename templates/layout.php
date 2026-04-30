<?php
if (isset($page_part) && $page_part == 'header'): ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>StudySpaces | Find Your Spot</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg sticky-top bg-white border-bottom">
        <div class="d-flex align-items-center me-auto" style="flex: 1;">
            <?php if (isset($_SESSION['is_logged_in'])): ?>
               
                <a href="logout.php" class="btn btn-sm btn-outline-danger rounded-pill px-3 me-2">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                </a>
                <a href="dashboard.php" class="text-secondary small fw-bold d-none d-lg-inline text-decoration-none">
                    Hi, <?php echo htmlspecialchars($_SESSION['user_data']['username'] ?? 'User'); ?>
                </a>
            <?php endif; ?>
        </div>
    
        <div class="container">
            <a class="navbar-brand fw-bold text-dark" href="index.php">STUDYSPACES.</a>

            <form action="itemsPage.php" method="GET" class="d-none d-md-flex mx-auto" style="width: 320px;">
                <div class="input-group">
            
                    <input name="q" type="search" class="form-control rounded-pill-start" placeholder="Search cafes..." value="<?php echo $_GET['q'] ?? ''; ?>">
                    <button class="btn btn-outline-secondary rounded-pill-end" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>

            <div class="navbar-nav ms-auto gap-1">
                <?php if (isset($_SESSION['is_logged_in'])): ?>
                    <a class="nav-link text-secondary" href="dashboard.php">Dashboard</a>
                <?php endif; ?>
                <a class="nav-link active" href="itemsPage.php">Explore</a>
                <a class="nav-link text-secondary" href="contact.php">Contact</a>
            </div>
        </div>
    </nav>
    <main>
<?php endif; ?>

<?php if (isset($page_part) && $page_part == 'footer'): ?>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
<?php endif; ?>