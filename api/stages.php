<?php
    require_once '../www/db.php';

    $stmt = $pdo->query('SELECT stage_latitude, stage_longitude FROM stages');
    $stages = $stmt->fetchAll();
    
    header('Content-Type: application/json');
    echo json_encode(['stages' => $stages]);