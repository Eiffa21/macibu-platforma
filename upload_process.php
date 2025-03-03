<?php
session_start();
require 'config.php'; // Database connection

if (isset($_POST['upload'])) {
    // Retrieve form data
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $user_id = $_SESSION['user_id']; // Assumes user is logged in
    
    // Check if a file was uploaded without errors
    if (isset($_FILES['material_file']) && $_FILES['material_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['material_file']['tmp_name'];
        $fileName = $_FILES['material_file']['name'];
        $fileSize = $_FILES['material_file']['size'];
        $fileType = $_FILES['material_file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Validate file extension (optional, add your allowed types)
        $allowedfileExtensions = ['pdf', 'doc', 'docx', 'jpg', 'png', 'mp4'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Create a unique file name
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            
            // Define upload path
            $uploadFileDir = __DIR__ . '/uploads/';
            $dest_path = $uploadFileDir . $newFileName;
            
            // Move the file to the uploads directory
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Insert the file info into the database
                $stmt = $pdo->prepare("INSERT INTO materials (user_id, title, file_path, category) VALUES (?, ?, ?, ?)");
                if ($stmt->execute([$user_id, $title, $newFileName, $category])) {
                    echo "File is successfully uploaded.";
                } else {
                    echo "Database error: Could not record file info.";
                }
            } else {
                echo "There was an error moving the uploaded file.";
            }
        } else {
            echo "Upload failed. Allowed file types: " . implode(", ", $allowedfileExtensions);
        }
    } else {
        echo "Error: " . $_FILES['material_file']['error'];
    }
}
?>