<?php
// config.php

// 1. Include Composer autoload
require_once __DIR__ . '/vendor/autoload.php';

// 2. Load environment variables from .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// 3. Access environment variables
$host = $_ENV['DB_HOST'];
$db   = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);

} catch (PDOException $e) {
    // In production, you should log the error, not display it.
    echo "Connection failed: " . $e->getMessage();
    exit;
}
