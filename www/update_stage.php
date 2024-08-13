<?php
    require 'db.php';
    // Verifica che il parametro ID sia presente
    if (isset($_POST['id'])) {
        $stageId = $_POST['id'];
    
        // Recupera lo stato attuale di `stage_completed`
        $sql = 'SELECT stage_completed FROM stages WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$stageId]);
        $stage = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($stage) {
            $newStatus = $stage['stage_completed'] == 0 ? 1 : 0;
    
            // Aggiorna lo stato di `stage_completed`
            $updateSql = 'UPDATE stages SET stage_completed = ? WHERE id = ?';
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->execute([$newStatus, $stageId]);
    
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo 'Tappa non trovata.';
        }
    } else {
        echo 'ID non specificato.';
    }