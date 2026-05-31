<?php
session_start();
require 'Data/config.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        $del_id = intval($_POST['delete_id']);
        $stmt = $conn->prepare("DELETE FROM users WHERE id=? AND is_admin=0");
        $stmt->bind_param("i", $del_id);
        $stmt->execute();
    } elseif (isset($_POST['status_id'], $_POST['new_status'])) {
        $uid = intval($_POST['status_id']);
        $new_status = $_POST['new_status'];
        if (in_array($new_status, ['active', 'banned'])) {
            $stmt = $conn->prepare("UPDATE users SET status=? WHERE id=? AND is_admin=0");
            $stmt->bind_param("si", $new_status, $uid);
            $stmt->execute();
        }
    }
    header("Location: admin_users.php");
    exit();
}

$result = $conn->query("SELECT id, username, status, is_admin, created_at FROM users ORDER BY id ASC");

$page_part = 'header';
include "templates/layout.php";
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Manage Users</h2>
        <a href="admin_dashboard.php" class="btn btn-outline-dark rounded-pill px-3">&larr; Back to Dashboard</a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="ps-4 py-3">#</th>
                    <th class="py-3">Username</th>
                    <th class="py-3">Joined</th>
                    <th class="py-3 text-center">Status</th>
                    <th class="py-3 text-center">Role</th>
                    <th class="py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $result->fetch_assoc()): ?>
                <tr>
                    <td class="ps-4"><?php echo $user['id']; ?></td>
                    <td class="fw-semibold"><?php echo htmlspecialchars($user['username']); ?></td>
                    <td class="text-secondary"><?php echo date('Y-m-d', strtotime($user['created_at'])); ?></td>
                    <td class="text-center">
                        <?php if ($user['is_admin']): ?>
                            <span class="badge bg-dark rounded-pill px-3">Admin</span>
                        <?php elseif ($user['status'] === 'active'): ?>
                            <span class="badge bg-success rounded-pill px-3">Active</span>
                        <?php else: ?>
                            <span class="badge bg-danger rounded-pill px-3">Banned</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <span class="text-muted small"><?php echo $user['is_admin'] ? 'Admin' : 'User'; ?></span>
                    </td>
                    <td class="text-center">
                        <?php if (!$user['is_admin']): ?>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="status_id" value="<?php echo $user['id']; ?>">
                            <input type="hidden" name="new_status" value="<?php echo $user['status'] === 'active' ? 'banned' : 'active'; ?>">
                            <button type="submit" class="btn btn-sm <?php echo $user['status'] === 'active' ? 'btn-outline-warning' : 'btn-outline-success'; ?> rounded-pill me-1">
                                <?php echo $user['status'] === 'active' ? 'Ban' : 'Unban'; ?>
                            </button>
                        </form>
                        <form method="POST" class="d-inline" onsubmit="return confirm('Delete user <?php echo htmlspecialchars($user['username']); ?>?')">
                            <input type="hidden" name="delete_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">Delete</button>
                        </form>
                        <?php else: ?>
                            <span class="text-muted small">&mdash;</span>
                        <?php endif; ?>
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
