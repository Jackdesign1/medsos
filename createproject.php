<?php
require 'config.php';

if (!empty($_SESSION["id"])) {
  $user_id = $_SESSION["id"];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];

    // Proses penyimpanan data project ke tabel tb_project
    $query = "INSERT INTO tb_project (project_name, project_description, user_id) VALUES ('$project_name', '$project_description', '$user_id')";
    mysqli_query($conn, $query);

    // Cek jika ada file gambar yang diupload
    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] === UPLOAD_ERR_OK) {
      $targetDir = "uploads/"; // Direktori penyimpanan gambar
      $allowedExtensions = ['jpg', 'jpeg', 'png']; // Ekstensi yang diperbolehkan
      $filename = $_FILES['project_image']['name'];
      $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

      // Memeriksa ekstensi file yang diunggah
      if (in_array($fileExtension, $allowedExtensions)) {
        $targetPath = $targetDir . $filename; // Path lengkap file yang akan disimpan
        move_uploaded_file($_FILES['project_image']['tmp_name'], $targetPath);

        // Memperbarui kolom image di tabel tb_project
        $query = "UPDATE tb_project SET image = '$targetPath' WHERE id = LAST_INSERT_ID()";
        mysqli_query($conn, $query);
      }
    }

    header("Location: createproject.php");
    exit();
  }
} else {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Create Project</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    .create-project-container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
    }

    .create-project-container h1 {
      text-align: center;
    }

    .create-project-container form {
      margin-top: 20px;
    }

    .create-project-container label {
      display: block;
      margin-bottom: 5px;
    }

    .create-project-container input[type="text"],
    .create-project-container textarea {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .create-project-container button[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .create-project-container button[type="submit"]:hover {
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

  <div class="create-project-container">
    <h1>Create Project</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
      <label for="project_name">Project Name</label>
      <input type="text" id="project_name" name="project_name" placeholder="Enter project name" required>

      <label for="project_description">Project Description</label>
      <textarea id="project_description" name="project_description" placeholder="Enter project description" required></textarea>

      <label for="project_image">Project Image</label>
      <input type="file" id="project_image" name="project_image" accept="image/jpeg,image/png">

      <img id="preview_image" src="#" alt="Preview Image" style="display: none;">
      <script>
        // Fungsi untuk menampilkan gambar yang diupload pada form
        function previewImage() {
          var fileInput = document.getElementById('project_image');
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

      <button type="submit">Create Project</button>
    </form>
  </div>

</body>
</html>
