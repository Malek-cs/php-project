<?php 
$page_part = 'header';
include("templates/layout.php"); 
require('data/items.php');
?>

<div class="container my-5">
    <div class="row">
        <?php foreach ($study_spaces as $space): ?>
        <div class="col-md-4 mb-5">
            <div class="card border-0 bg-transparent h-100">
                <img src="<?= $space['img'] ?>" class="cafe-img w-100 shadow-sm mb-3 rounded-4" alt="<?= $space['name'] ?>">
                
                <div class="card-body p-0">
                    <div class="d-flex justify-content-between align-items-center px-2">
                        <div>
                            <h6 class="fw-bold mb-0 text-dark"><?= $space['name'] ?></h6>
                            <small class="text-secondary"><?= $space['loc'] ?> • <?= $space['type'] ?></small>
                        </div>
                        <a href="itemDetails.php?id=<?= $space['id'] ?>" class="btn btn-dark btn-sm rounded-pill px-4">View</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php 
$page_part = 'footer';
include("templates/layout.php"); 
?>