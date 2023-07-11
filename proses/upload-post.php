<?php
session_start();
require '../config.php';
if (isset($_POST['submit'])) {
    $id = $_SESSION["id"];
    $image = $_FILES['foto'];
    if ($image["error"] != 0) {
        die("Image upload failed: " . $image_file["error"]);
    }
    $target_dir = '../uploads/';
    $path  = 'uploads/' . $image['name'];
    $target_file = $target_dir . basename($image["name"]);
    move_uploaded_file($image['tmp_name'], $target_file);
    $description = $_POST['deskripsi'];

    $sql = "INSERT INTO tb_post (deskripsi, foto, id_user) VALUES ('$description', '$path', '$id')";
    mysqli_query($conn, $sql);
    header("Location: ../index.php");
}
