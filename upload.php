<?php
session_start();

if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header("Location: login.php");
    exit();
}

if (!is_dir('uploads')) {
    mkdir('uploads', 0755, true);
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'pdf', 'doc', 'docx'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $max_size = 5 * 1024 * 1024;

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $error = "Upload failed. Please try again.";
    } elseif (!in_array($ext, $allowed)) {
        $error = "File type not allowed. Allowed: " . implode(', ', $allowed);
    } elseif ($file['size'] > $max_size) {
        $error = "File too large. Maximum size is 5MB.";
    } else {
        $filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($file['name']));
        $dest = 'uploads/' . $filename;
        if (move_uploaded_file($file['tmp_name'], $dest)) {
            $message = "File uploaded successfully: <strong>" . htmlspecialchars($filename) . "</strong>";
        } else {
            $error = "Failed to save file. Check uploads/ directory permissions.";
        }
    }
}

$page_part = 'header';
include "templates/layout.php";
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h2 class="fw-bold mb-4">Upload File</h2>

                <?php if ($message): ?>
                    <div class="alert alert-success"><?php echo $message; ?></div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Choose File</label>
                        <input type="file" name="file" class="form-control" required>
                        <div class="form-text">Allowed: jpg, jpeg, png, webp, gif, pdf, doc, docx &mdash; Max: 5MB</div>
                    </div>
                    <button type="submit" class="btn btn-dark rounded-pill px-4">Upload</button>
                </form>

                <?php
                $files = is_dir('uploads') ? array_diff(scandir('uploads'), ['.', '..']) : [];
                if ($files): ?>
                <hr class="my-4">
                <h5 class="fw-bold mb-3">Uploaded Files</h5>
                <ul class="list-group list-group-flush">
                    <?php foreach ($files as $f): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted small"><?php echo htmlspecialchars($f); ?></span>
                        <a href="uploads/<?php echo rawurlencode($f); ?>" target="_blank" class="btn btn-sm btn-outline-dark rounded-pill">View</a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
$page_part = 'footer';
include "templates/layout.php";
?>
