<?php
session_start();

if (!isset($_SESSION['is_logged_in'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['my_requests'])) {
    $_SESSION['my_requests'] = [];
}

$status = $_GET['status'] ?? 'All';
$list = [];

foreach ($_SESSION['my_requests'] as $req) {
    if ($status === 'All' || $req['status'] === $status) {
        $list[] = $req;
    }
}

$page_part = 'header';
include("templates/layout.php"); 
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">My Submissions</h2>
        
        <div class="btn-group shadow-sm">
            <a href="?status=All" class="btn btn-sm <?php echo $status == 'All' ? 'btn-dark' : 'btn-outline-dark'; ?>">All</a>
            <a href="?status=Approved" class="btn btn-sm <?php echo $status == 'Approved' ? 'btn-success' : 'btn-outline-success'; ?>">Approved</a>
            <a href="?status=Pending" class="btn btn-sm <?php echo $status == 'Pending' ? 'btn-warning' : 'btn-outline-warning'; ?>">Pending</a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="ps-4 py-3 border-0">Space Name</th>
                    <th class="py-3 border-0">Date</th>
                    <th class="py-3 text-center border-0">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $row): ?>
                <tr>
                    <td class="ps-4 py-4 fw-semibold"><?php echo htmlspecialchars($row['name']); ?></td>
                    <td class="py-4 text-secondary"><?php echo $row['date']; ?></td>
                    <td class="py-4 text-center">
                        <?php 
                        $badge_color = ($row['status'] == 'Approved') ? 'text-bg-success' : 'text-bg-warning';
                        ?>
                        <span class="badge rounded-pill <?php echo $badge_color; ?> px-3 py-2">
                            <?php echo $row['status']; ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>

                <?php if (empty($list)): ?>
                <tr>
                    <td colspan="3" class="text-center py-5 text-muted">
                        <i class="fa-regular fa-folder-open fs-1 mb-3 opacity-50 d-block"></i>
                        No submissions found.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
$page_part = 'footer';
include("templates/layout.php"); 
?>