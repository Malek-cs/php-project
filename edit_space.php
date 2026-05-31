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

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $wifi_speed = $_POST['wifi_speed'];
    $has_power = isset($_POST['has_power_outlets']) ? 1 : 0;

    $stmt = $conn->prepare("UPDATE spaces SET name=?, type=?, location=?, wifi_speed=?, has_power_outlets=? WHERE id=?");
    $stmt->bind_param("sssiii", $name, $type, $location, $wifi_speed, $has_power, $id);
    $stmt->execute();
    $message = 'success';
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
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h2 class="fw-bold mb-4">Edit Space</h2>

                <?php if ($message === 'success'): ?>
                    <div class="alert alert-success">Space updated successfully!</div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($space['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Type</label>
                        <select name="type" class="form-select">
                            <?php foreach (['Cafe', 'Library', 'Cultural Space', 'Other'] as $t): ?>
                                <option value="<?php echo $t; ?>" <?php echo $space['type'] == $t ? 'selected' : ''; ?>><?php echo $t; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Location</label>
                        <input type="text" name="location" class="form-control" value="<?php echo htmlspecialchars($space['location']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">WiFi Speed</label>
                        <select name="wifi_speed" class="form-select">
                            <?php foreach (['Slow', 'Medium', 'Fast', 'Excellent'] as $w): ?>
                                <option value="<?php echo $w; ?>" <?php echo $space['wifi_speed'] == $w ? 'selected' : ''; ?>><?php echo $w; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="has_power_outlets" id="power" <?php echo $space['has_power_outlets'] ? 'checked' : ''; ?>>
                            <label class="form-check-label fw-bold" for="power">Has Power Outlets</label>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">Save Changes</button>
                        <a href="admin_dashboard.php" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$page_part = 'footer';
include "templates/layout.php";
?>
