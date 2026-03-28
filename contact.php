<?php
$page_part = 'header';
include("templates/layout.php");
?>

<div class="container mt-5">
    <h1 class="mb-4">Contact Us</h1>

    <form method="post" action="">
        
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-dark">Send Message</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<div class='alert alert-success mt-3'>Message sent successfully (not saved)</div>";
    }
    ?>
</div>

<?php
$page_part = 'footer';
include("templates/layout.php");
?>