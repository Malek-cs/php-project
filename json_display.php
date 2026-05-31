<?php
session_start();

$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$api_url  = $protocol . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/api.php';

$json_raw = file_get_contents($api_url);
$decoded  = json_decode($json_raw, true);
$spaces   = $decoded['data'] ?? [];

$page_part = 'header';
include "templates/layout.php";
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">JSON Display</h2>
        <a href="api.php" target="_blank" class="btn btn-outline-dark rounded-pill px-3">View Raw JSON</a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <h6 class="fw-bold text-muted mb-2">Raw JSON from <code>api.php</code></h6>
        <pre class="bg-light rounded-3 p-3 mb-0" style="font-size:0.78rem;max-height:220px;overflow:auto;"><?php echo htmlspecialchars($json_raw); ?></pre>
    </div>

    <h5 class="fw-bold mb-3">Decoded with <code>json_decode()</code> &mdash; <?php echo count($spaces); ?> spaces</h5>
    <div class="row g-3">
        <?php foreach ($spaces as $space): ?>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($space['name']); ?></h6>
                <small class="text-muted"><?php echo htmlspecialchars($space['type']); ?> &bull; <?php echo htmlspecialchars($space['location']); ?></small>
                <div class="mt-2 d-flex gap-2 flex-wrap">
                    <span class="badge bg-secondary rounded-pill"><?php echo htmlspecialchars($space['wifi_speed']); ?></span>
                    <?php if ($space['has_power_outlets']): ?>
                        <span class="badge bg-success rounded-pill">Power Outlets</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
$page_part = 'footer';
include "templates/layout.php";
?>
