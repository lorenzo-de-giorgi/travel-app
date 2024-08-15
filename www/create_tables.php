<?php
    require 'db.php';

    try {
        $sql = "
        
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        );

        CREATE TABLE IF NOT EXISTS travels (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            name VARCHAR(255) NOT NULL,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );

        CREATE TABLE IF NOT EXISTS stages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            stage_name VARCHAR(255) NOT NULL,
            stage_address VARCHAR(255) NOT NULL,
            stage_description TEXT,
            stage_latitude DECIMAL(12, 10) NOT NULL,
            stage_longitude DECIMAL(12, 10) NOT NULL,
            stage_completed BOOLEAN NOT NULL DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
        
        ";

        $pdo->exec($sql);
        echo "Tables created successfully.";
    } catch (PDOException $e) {
        echo "Error creating tables: " . $e->getMessage();
    }

    // travel_id INT NOT NULL,
    // FOREIGN KEY (travel_id) REFERENCES travels(id) ON DELETE CASCADE