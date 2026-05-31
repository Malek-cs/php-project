<?php
session_start();
require 'Data/config.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id === 0) {
    header("Location: admin_dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    $stmt = $conn->prepare("DELETE FROM spaces WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin_dashboard.php?deleted=1");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM spaces WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$space = $stmt->get_result()->fetch_assoc();

if (!$space) {
    header("Location: admin_dashboard.php");
    exit();
}

$page_part = 'header';
include "templates/layout.php";
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                <i class="fa-solid fa-triangle-exclamation fa-3x text-danger mb-3"></i>
                <h2 class="fw-bold mb-2">Delete Space</h2>
                <p class="text-muted mb-4">Are you sure you want to delete <strong><?php echo htmlspecialchars($space['name']); ?></strong>? This cannot be undone.</p>
                <form method="POST" class="d-flex justify-content-center gap-3">
                    <button type="submit" name="confirm" class="btn btn-danger rounded-pill px-4">Yes, Delete</button>
                    <a href="admin_dashboard.php" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$page_part = 'footer';
include "templates/layout.php";
?>
