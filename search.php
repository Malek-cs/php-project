<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'Data/items.php';

$query = $_GET['q'] ?? '';
$results = [];

foreach ($study_spaces as $space) {
    if ($query === '' || stripos($space['name'], $query) !== false) {
        $results[] = $space;
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
            <button type="submit" class="btn-dark">Search</button>
        </form>

        <?php foreach ($results as $item): ?>
            <div class="neymar">
                <img src="<?= $item['img'] ?>" alt="Image">
                <div class="mbappe">
                    <h3><?= $item['name'] ?></h3>
                    <p><?= $item['type'] ?> - <?= $item['loc'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>