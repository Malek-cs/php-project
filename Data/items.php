<?php

$study_spaces = [
    1 => [
        "id" => 1, 
        "name" => "Wild Jordan", 
        "type" => "Cafe", 
        "loc" => "Old Amman", 
        "img" => "public/WildJordan.jpg",
        "wifi_speed" => "Fast",
        "has_power_outlets" => true
    ],
    2 => [
        "id" => 2, 
        "name" => "University Library", 
        "type" => "Library", 
        "loc" => "Irbid", 
        "img" => "public/UniversityLibrary.jpg",
        "wifi_speed" => "Medium",
        "has_power_outlets" => false
    ],
    3 => [
        "id" => 3, 
        "name" => "Seven Pennies", 
        "type" => "Cafe", 
        "loc" => "Amman", 
        "img" => "public/SevenPennies.jpg",
        "wifi_speed" => "Excellent",
        "has_power_outlets" => true
    ],
    4 => [
        "id" => 4, 
        "name" => "Darat al Funun", 
        "type" => "Cultural Space", 
        "loc" => "Lweibdeh", 
        "img" => "public/darat-al-funun.webp",
        "wifi_speed" => "Slow",
        "has_power_outlets" => false
    ],
    5 => [
        "id" => 5, 
        "name" => "Blue Fig", 
        "type" => "Cafe", 
        "loc" => "Abdoun", 
        "img" => "public/BlueFig.jpg",
        "wifi_speed" => "Fast",
        "has_power_outlets" => true
    ]
];

$spaceId = $_GET['id'] ?? '';

if ($spaceId && !isset($study_spaces[$spaceId])) {
    header("Location: 404.php");
    exit;
}

$space = $study_spaces[$spaceId] ?? null;

?>