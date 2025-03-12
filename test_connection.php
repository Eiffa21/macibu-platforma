<?php
require 'config.php';

if ($pdo) {
    echo "Database connection successful!";
} else {
    echo "Failed to connect to database.";
}
