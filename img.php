<?php
if(isset($_FILES['image'])) {
    $targetDir = "uploads/images/";
    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $fileName;
    
    if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
        $conn = new mysqli("localhost", "username", "password", "database");
        $sql = "INSERT INTO images (image_path) VALUES ('$targetFilePath')";
        $conn->query($sql);
        echo "File uploaded successfully!";
    } else {
        echo "Error uploading file.";
    }
}
?>
