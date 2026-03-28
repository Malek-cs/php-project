<?php 
$page_part = 'header';
include('layout.php'); 


$study_spaces = [
    ["id" => 1, "name" => "Wild Jordan", "type" => "Cafe", "loc" => "Old Amman", "img" => "https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600"],
    ["id" => 2, "name" => "University Library", "type" => "Library", "loc" => "Irbid", "img" => "https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=600"],
    ["id" => 3, "name" => "Seven Pennies", "type" => "Cafe", "loc" => "Amman", "img" => "https://images.unsplash.com/photo-1527192491265-7e15c55b1ed2?w=600"],
    // -> FIXED IMAGE URL BELOW
    ["id" => 7, "name" => "Darat al Funun", "type" => "Cultural Space", "loc" => "Lweibdeh", "img" => "https://images.unsplash.com/photo-1518112166137-85899efda583?w=600"],
    ["id" => 8, "name" => "Blue Fig", "type" => "Cafe", "loc" => "Abdoun", "img" => "https://images.unsplash.com/photo-1559339352-11d035aa65de?w=600"]
];
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
include('layout.php'); 
?>
