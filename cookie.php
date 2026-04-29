<?php
setcookie("last_visit", date("Y-m-d H:i:s"), time() + 3600);

$page_part = 'header';
include("layout.php");
?>

<div class="container mt-5">
    <h1>Cookie Demo</h1>

    <?php
    if (isset($_COOKIE['last_visit'])) {
        echo "<div class='alert alert-success'>";
        echo "Your last visit was: " . $_COOKIE['last_visit'];
        echo "</div>";
    } else {
        echo "<div class='alert alert-warning'>";
        echo "This is your first visit!";
        echo "</div>";
    }
    ?>

    <p class="mt-3">Refresh the page to see the cookie in action 👀</p>
</div>

<?php
$page_part = 'footer';
include("layout.php");
?>