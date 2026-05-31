<?php
session_start();
require 'Data/config.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM spaces ORDER BY id ASC");

$page_part = 'header';
include "templates/layout.php";
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Admin Dashboard</h2>
        <div class="d-flex gap-2">
            <a href="admin_users.php" class="btn btn-outline-dark rounded-pill px-3">Manage Users</a>
            <a href="report.php" class="btn btn-outline-dark rounded-pill px-3">Reports</a>
        </div>
    </div>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success alert-dismissible fade show">Space deleted successfully. <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="ps-4 py-3">#</th>
                    <th class="py-3">Name</th>
                    <th class="py-3">Type</th>
                    <th class="py-3">Location</th>
                    <th class="py-3">WiFi</th>
                    <th class="py-3 text-center">Power</th>
                    <th class="py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="ps-4"><?php echo $row['id']; ?></td>
                    <td class="fw-semibold"><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['type']); ?></td>
                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                    <td><?php echo htmlspecialchars($row['wifi_speed']); ?></td>
                    <td class="text-center">
                        <?php echo $row['has_power_outlets']
                            ? '<i class="fa-solid fa-check text-success"></i>'
                            : '<i class="fa-solid fa-xmark text-danger"></i>'; ?>
                    </td>
                    <td class="text-center">
                        <a href="edit_space.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-dark rounded-pill me-1">Edit</a>
                        <a href="delete_space.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$page_part = 'footer';
include "templates/layout.php";
?>
