<?php
    require 'db.php';

    try {
        $db_name = 'travel-app_db';
        $pdo = new PDO("mysql:host=$host", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE DATABASE IF NOT EXISTS `$db_name`";
        $pdo->exec($sql);
        echo "Database creato con successo (se non esisteva già).<br>";

        $pdo->exec("USE `$dbname`");
        $sql = "
        
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NULLABLE,
            email VARCHAR(255) NULLABLE,
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
            user_id INT NOT NULL,
            travel_id INT NOT NULL,
            stage_name VARCHAR(255) NOT NULL,
            stage_address VARCHAR(255) NOT NULL,
            stage_description TEXT,
            stage_latitude DECIMAL(12, 10) NOT NULL,
            stage_longitude DECIMAL(12, 10) NOT NULL,
            stage_completed BOOLEAN NOT NULL DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (travel_id) REFERENCES travels(id) ON DELETE CASCADE
        );
        
        ";

        $pdo->exec($sql);
        echo "Tables created successfully.";
    } catch (PDOException $e) {
        echo "Error creating tables: " . $e->getMessage();
    }