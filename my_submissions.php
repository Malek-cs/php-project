<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['my_requests'])) {
    $_SESSION['my_requests'] = [
        ['name' => 'Wild Jordan', 'status' => 'Approved', 'date' => '2026-04-20'],
        ['name' => 'Seven Pennies', 'status' => 'Pending', 'date' => '2026-04-25'],
        ['name' => 'Blue Fig', 'status' => 'Approved', 'date' => '2026-04-15']
    ];
}

$status = $_GET['status'] ?? 'All';
$list = [];

foreach ($_SESSION['my_requests'] as $req) {
    if ($status === 'All' || $req['status'] === $status) {
        $list[] = $req;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Submissions</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="zidane">
        <h2>My Submissions</h2>

        <div class="modric">
            <span>Filter: </span>
            <a href="?status=All" class="<?= $status == 'All' ? 'active' : '' ?>">All</a>
            <a href="?status=Approved" class="<?= $status == 'Approved' ? 'active' : '' ?>">Approved</a>
            <a href="?status=Pending" class="<?= $status == 'Pending' ? 'active' : '' ?>">Pending</a>
        </div>

        <table class="kroos">
            <tr>
                <th>Space Name</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <?php foreach ($list as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= $row['date'] ?></td>
                <td><span class="salah <?= $row['status'] ?>"><?= $row['status'] ?></span></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>