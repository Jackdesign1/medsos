<?php
session_start();
require 'config.php';

if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {
      $name = $_POST['name'];
      $query = "UPDATE tb_user SET name = '$name' WHERE id = $id";
      mysqli_query($conn, $query);
    }

    if (isset($_POST['title'])) {
      $title = $_POST['title'];
      $query = "UPDATE tb_user SET title = '$title' WHERE id = $id";
      mysqli_query($conn, $query);
    }

    if (isset($_POST['bio'])) {
      $bio = $_POST['bio'];
      $query = "UPDATE tb_user SET bio = '$bio' WHERE id = $id";
      mysqli_query($conn, $query);
    }

    // Upload foto profil jika ada file yang dipilih
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
      $targetDir = "uploads/"; // Direktori penyimpanan foto profil
      $allowedExtensions = ['jpg', 'jpeg', 'png']; // Ekstensi yang diperbolehkan
      $filename = $_FILES['profile_picture']['name'];
      $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

      // Memeriksa ekstensi file yang diunggah
      if (in_array($fileExtension, $allowedExtensions)) {
        $targetPath = $targetDir . $id . '.' . $fileExtension; // Path lengkap file yang akan disimpan
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetPath);

        // Memperbarui kolom profile_picture di tabel tb_user
        $query = "UPDATE tb_user SET profile_picture = '$targetPath' WHERE id = $id";
        mysqli_query($conn, $query);
      }
    }

    header("Location: editprofile.php");
    exit();
  }

  // Mendapatkan data profil pengguna
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
} else {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Edit Profile</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    .edit-profile-container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
    }

    .edit-profile-container h1 {
      text-align: center;
    }

    .edit-profile-container form {
      margin-top: 20px;
    }

    .edit-profile-container label {
      display: block;
      margin-bottom: 5px;
    }

    .edit-profile-container input[type="text"],
    .edit-profile-container input[type="email"],
    .edit-profile-container textarea {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .edit-profile-container textarea {
      height: 100px;
    }

    .edit-profile-container button[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .edit-profile-container button[type="submit"]:hover {
      background-color: #45a049;
    }

    #preview_image {
      display: none;
      width: 200px;
      height: auto;
      margin-top: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <div class="navbar-left">
      <a class="logo" href="index.php">Facebook</a>
    </div>
    <div class="navbar-center">
      <a class="nav-link active" href="index.php">Home</a>
      <a class="nav-link" href="#">Friends</a>
      <a class="nav-link" href="#">Messages</a>
      <a class="nav-link" href="#">Requests</a>
    </div>
    <div class="navbar-right">
      <div class="dropdown-1">
        <input type="checkbox" id="profile-toggle" class="toggle">
        <label for="profile-toggle" class="profile-link">Project</label>
        <div class="dropdown-content-1">
          <a href="createproject.php">Create Project</a>
          <a href="editproject.php">Edit Project</a>
          <a href="checkproject.php">Check Project</a>
        </div>
      </div>
      <div class="dropdown-2">
        <input type="checkbox" id="group-toggle" class="toggle">
        <label for="group-toggle" class="group-link">Profile</label>
        <div class="dropdown-content-2">
          <a href="editprofile.php">Edit Profile</a>
          <a href="checkprofile.php">Check Profile</a>
          <a href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="edit-profile-container">
    <h1>Edit Profile</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
      <label for="profile_picture">Profile Picture</label>
      <input type="file" id="profile_picture" name="profile_picture" accept="image/jpeg,image/png">
      <img id="preview_image" src="#" alt="Preview Image" style="display: none;">
      <script>
        // Fungsi untuk menampilkan gambar yang diupload pada form
        function previewImage() {
          var fileInput = document.getElementById('profile_picture');
          var previewImage = document.getElementById('preview_image');

          // Mengatur event listener ketika gambar dipilih
          fileInput.addEventListener('change', function() {
            var file = fileInput.files[0];
            var reader = new FileReader();

            // Mengatur event listener ketika pembacaan file selesai
            reader.addEventListener('load', function() {
              previewImage.src = reader.result;
              previewImage.style.display = 'block'; // Tampilkan gambar
            });

            if (file) {
              reader.readAsDataURL(file); // Membaca file sebagai URL data
            }
          });
        }

        // Panggil fungsi previewImage saat halaman selesai dimuat
        window.addEventListener('DOMContentLoaded', previewImage);
      </script>


      <label for="name">Name</label>
      <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">

      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>">

      <label for="title">Title</label>
      <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>">

      <label for="bio">Bio</label>
      <textarea id="bio" name="bio"><?php echo $row['bio']; ?></textarea>


      <button type="submit">Save Changes</button>
    </form>
  </div>

</body>

</html>