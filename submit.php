<?php
session_start();

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['space_name'] ?? '';
    $location = $_POST['location'] ?? '';
    $type = $_POST['type'] ?? '';
    $wifi = $_POST['wifi'] ?? '';

    if (empty($name) || empty($location) || empty($type) || empty($wifi)) {
        $error = "Please fill in all the fields!";
    } else {
        $new_request = [
            'name' => htmlspecialchars($name),
            'status' => 'Pending',
            'date' => date('Y-m-d')
        ];

        if (!isset($_SESSION['my_requests'])) {
            $_SESSION['my_requests'] = [
                ['name' => 'Wild Jordan', 'status' => 'Approved', 'date' => '2026-04-20'],
                ['name' => 'Seven Pennies', 'status' => 'Pending', 'date' => '2026-04-25'],
                ['name' => 'Blue Fig', 'status' => 'Approved', 'date' => '2026-04-15']
            ];
        }

        $_SESSION['my_requests'][] = $new_request;

        $success = "Your study space has been successfully submitted for review!";
    }
}

$page_part = 'header';
include("templates/layout.php"); 
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h2 class="fw-bold mb-4 text-center">Submit a New Study Space</h2>
                
                <?php if(!empty($error)) echo "<div class='alert alert-danger' role='alert'>$error</div>"; ?>
                <?php if(!empty($success)) echo "<div class='alert alert-success' role='alert'>$success</div>"; ?>

                <form method="POST" action="submit.php">
                    <div class="mb-3">
                        <label for="space_name" class="form-label fw-bold">Space Name</label>
                        <input type="text" class="form-control" id="space_name" name="space_name" placeholder="e.g. The Main Library">
                    </div>
                    
                    <div class="mb-3">
                        <label for="location" class="form-label fw-bold">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="e.g. Amman">
                    </div>
                    
                    <div class="mb-3">
                        <label for="type" class="form-label fw-bold">Type of Space</label>
                        <select class="form-select" id="type" name="type">
                            <option value="">Select a type...</option>
                            <option value="Cafe">Cafe</option>
                            <option value="Library">Library</option>
                            <option value="Cultural Space">Cultural Space</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="wifi" class="form-label fw-bold">WIFI Speed</label>
                        <select class="form-select" id="wifi" name="wifi">
                            <option value="">Select WIFI speed.</option>
                            <option value="Slow">Slow</option>
                            <option value="Medium">Medium</option>
                            <option value="Fast">Fast</option>
                            <option value="Excellent">Excellent</option>
                        </select>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-dark btn-lg rounded-pill">Submit Space</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
$page_part = 'footer';
include("templates/layout.php"); 
?>
