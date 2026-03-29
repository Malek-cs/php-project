<?php

function h($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

function getSpaceById($id, $spacesArray) {
    $id = filter_var($id, FILTER_VALIDATE_INT); 
    
    if ($id && array_key_exists($id, $spacesArray)) {
        return $spacesArray[$id];
    }
    return null;
}

function getWifiBadgeClass($speed) {
    $speed = strtolower($speed);
    if ($speed === 'fast' || $speed === 'excellent') {
        return 'text-success'; 
    } elseif ($speed === 'medium') {
        return 'text-warning'; 
    } else {
        return 'text-danger'; 
    }
}

// تم إزالة الستايل المدمج واستبداله بـ Class
function dd($value) {
    echo "<pre class='debug-output'>";
    print_r($value);
    echo "</pre>";
    die();
}
?>