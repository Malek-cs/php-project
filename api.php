<?php
require 'Data/config.php';

$result = $conn->query("SELECT * FROM spaces ORDER BY id ASC");
$spaces = [];
while ($row = $result->fetch_assoc()) {
    $row['has_power_outlets'] = (bool) $row['has_power_outlets'];
    $spaces[] = $row;
}

header('Content-Type: application/json');
echo json_encode([
    'status' => 'success',
    'count'  => count($spaces),
    'data'   => $spaces
], JSON_PRETTY_PRINT);
?>
