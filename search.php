<?php
session_start();


if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

require_once 'Data/items.php';

$query = $_GET['q'] ?? '';
$results = [];


if (isset($study_spaces) && is_array($study_spaces)) {
    foreach ($study_spaces as $space) {
        if ($query === '' || stripos($space['name'], $query) !== false) {
            $results[] = $space;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Spaces</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="messi">
        <form class="ronaldo" method="GET">
            <input type="text" name="q" class="form-control" placeholder="Search spaces..." value="<?= htmlspecialchars($query) ?>">
        
        </form>

        <?php if (!empty($results)): ?>
            <?php foreach ($results as $item): ?>
                <div class="neymar">
                    <img src="<?= htmlspecialchars($item['img']) ?>" alt="Image">
                    <div class="mbappe">
                        <h3><?= htmlspecialchars($item['name']) ?></h3>
                        <p><?= htmlspecialchars($item['type']) ?> - <?= htmlspecialchars($item['loc']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; margin-top: 20px;">No study spaces found matching your search.</p>
        <?php endif; ?>
    </div>
</body>
</html>