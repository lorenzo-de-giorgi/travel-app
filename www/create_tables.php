<?php
require 'db.php';

    try {
        $sql = "
        CREATE TABLE IF NOT EXISTS travels (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS stages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            travel_id INT NOT NULL,
            stage_name VARCHAR(255) NOT NULL,
            stage_description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (travel_id) REFERENCES travels(id) ON DELETE CASCADE
        );";

        $pdo->exec($sql);
        echo "Tables created successfully.";
    } catch (PDOException $e) {
        echo "Error creating tables: " . $e->getMessage();
    }