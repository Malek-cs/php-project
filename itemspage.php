<?php
session_start();
require 'Data/config.php';
$page_part = 'header';
include "templates/layout.php";

$search = $_GET['q'] ?? '';
if ($search) {
    $stmt = $conn->prepare("SELECT * FROM spaces WHERE name LIKE ? OR location LIKE ? OR type LIKE ?");
    $like = "%$search%";
    $stmt->bind_param("sss", $like, $like, $like);
} else {
    $stmt = $conn->prepare("SELECT * FROM spaces ORDER BY id ASC");
}
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container my-5">
    <div class="row">
        <?php while ($space = $result->fetch_assoc()): ?>
        <div class="col-md-4 mb-5">
            <div class="card border-0 bg-transparent h-100">
                <img src="<?php echo htmlspecialchars($space['img']); ?>" class="cafe-img w-100 shadow-sm mb-3 rounded-4" alt="Image">
                <div class="card-body p-0">
                    <div class="d-flex justify-content-between align-items-center px-2">
                        <div>
                            <h6 class="fw-bold mb-0 text-dark"><?php echo htmlspecialchars($space['name']); ?></h6>
                            <small class="text-secondary"><?php echo htmlspecialchars($space['location']); ?> &bull; <?php echo htmlspecialchars($space['type']); ?></small>
                        </div>
                        <a href="itemDetails.php?id=<?php echo $space['id']; ?>" class="btn btn-dark btn-sm rounded-pill px-4">View</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php
$page_part = 'footer';
include "templates/layout.php";
?>
