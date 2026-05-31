<?php
session_start();
require 'Data/config.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

$total_spaces   = $conn->query("SELECT COUNT(*) AS cnt FROM spaces")->fetch_assoc()['cnt'];
$total_users    = $conn->query("SELECT COUNT(*) AS cnt FROM users WHERE is_admin=0")->fetch_assoc()['cnt'];
$total_messages = $conn->query("SELECT COUNT(*) AS cnt FROM contact_messages")->fetch_assoc()['cnt'];
$with_power     = $conn->query("SELECT COUNT(*) AS cnt FROM spaces WHERE has_power_outlets=1")->fetch_assoc()['cnt'];

$by_type = $conn->query("SELECT type, COUNT(*) AS cnt FROM spaces GROUP BY type ORDER BY cnt DESC");
$by_wifi = $conn->query("SELECT wifi_speed, COUNT(*) AS cnt FROM spaces GROUP BY wifi_speed ORDER BY cnt DESC");

$page_part = 'header';
include "templates/layout.php";
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2 class="fw-bold mb-0">Report &amp; Summary</h2>
        <a href="admin_dashboard.php" class="btn btn-outline-dark rounded-pill px-3">&larr; Back to Dashboard</a>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                <i class="fa-solid fa-map-pin fa-2x text-primary mb-2"></i>
                <h2 class="fw-bold"><?php echo $total_spaces; ?></h2>
                <p class="text-muted mb-0">Total Spaces</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                <i class="fa-solid fa-users fa-2x text-success mb-2"></i>
                <h2 class="fw-bold"><?php echo $total_users; ?></h2>
                <p class="text-muted mb-0">Registered Users</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                <i class="fa-solid fa-envelope fa-2x text-warning mb-2"></i>
                <h2 class="fw-bold"><?php echo $total_messages; ?></h2>
                <p class="text-muted mb-0">Contact Messages</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                <i class="fa-solid fa-plug fa-2x text-danger mb-2"></i>
                <h2 class="fw-bold"><?php echo $with_power; ?></h2>
                <p class="text-muted mb-0">Spaces With Power</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3">Spaces by Type</h5>
                <table class="table table-borderless mb-0">
                    <thead class="text-muted small">
                        <tr><th>Type</th><th class="text-end">Count</th></tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $by_type->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['type']); ?></td>
                            <td class="text-end fw-bold"><?php echo $row['cnt']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3">Spaces by WiFi Speed</h5>
                <table class="table table-borderless mb-0">
                    <thead class="text-muted small">
                        <tr><th>WiFi Speed</th><th class="text-end">Count</th></tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $by_wifi->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['wifi_speed']); ?></td>
                            <td class="text-end fw-bold"><?php echo $row['cnt']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$page_part = 'footer';
include "templates/layout.php";
?>
