<?php
require 'config.php';

if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['project_name'])) {
      $project_name = $_POST['project_name'];
      $query = "UPDATE tb_project SET project_name = '$project_name' WHERE id = $id";
      mysqli_query($conn, $query);
    }

    if (isset($_POST['project_industry'])) {
      $project_industry = $_POST['project_industry'];
      $query = "UPDATE tb_project SET project_industry = '$project_industry' WHERE id = $id";
      mysqli_query($conn, $query);
    }

    if (isset($_POST['project_description'])) {
      $project_description = $_POST['project_description'];
      $query = "UPDATE tb_project SET project_description = '$project_description' WHERE id = $id";
      mysqli_query($conn, $query);
    }

    if (isset($_POST['vision'])) {
      $vision = $_POST['vision'];
      $query = "UPDATE tb_project SET vision = '$vision' WHERE id = $id";
      mysqli_query($conn, $query);
    }

    if (isset($_POST['Mision'])) {
      $Mision = $_POST['Mision'];
      $query = "UPDATE tb_project SET Mision = '$Mision' WHERE id = $id";
      mysqli_query($conn, $query);
    }

    if (isset($_POST['pitchdeck'])) {
      $pitchdeck = $_POST['pitchdeck'];
      $query = "UPDATE tb_project SET pitchdeck = '$pitchdeck' WHERE id = $id";
      mysqli_query($conn, $query);
    }

    // Proses upload gambar profil jika ada
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
      $targetDir = "uploads/"; // Direktori penyimpanan gambar
      $allowedExtensions = ['jpg', 'jpeg', 'png']; // Ekstensi yang diperbolehkan
      $filename = $_FILES['profile_picture']['name'];
      $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

      // Memeriksa ekstensi file yang diunggah
      if (in_array($fileExtension, $allowedExtensions)) {
        $targetPath = $targetDir . $filename; // Path lengkap file yang akan disimpan
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetPath);

        // Memperbarui kolom image di tabel tb_project
        $query = "UPDATE tb_project SET image = '$targetPath' WHERE id = $id";
        mysqli_query($conn, $query);
      }
    }
  }

  $result = mysqli_query($conn, "SELECT * FROM tb_project WHERE id = $id");
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
  <title>Edit Project</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    .edit-project-container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
    }

    .edit-project-container h1 {
      text-align: center;
    }

    .edit-project-container form {
      margin-top: 20px;
    }

    .edit-project-container label {
      display: block;
      margin-bottom: 5px;
    }

    .edit-project-container input[type="text"],
    .edit-project-container textarea {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .edit-project-container button[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .edit-project-container button[type="submit"]:hover {
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

  <div class="edit-project-container">
    <h1>Edit Project</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
      <label for="profile_picture">Profile Picture</label>
      <input type="file" id="profile_picture" name="profile_picture" accept="image/jpeg,image/png">
      <img id="preview_image" src="<?php echo $row['image']; ?>" alt="Preview Image">

      <label for="project_name">Project Name</label>
      <input type="text" id="project_name" name="project_name" value="<?php echo $row['project_name']; ?>">

      <label for="project_industry">Project Industry</label>
      <select id="project_industry" name="project_industry">
      <option value="technology" <?php if ($row['project_industry'] == 'technology') echo 'selected'; ?>>Technology</option>
      <option value="finance" <?php if ($row['project_industry'] == 'finance') echo 'selected'; ?>>Finance</option>
      <option value="healthcare" <?php if ($row['project_industry'] == 'healthcare') echo 'selected'; ?>>Healthcare</option>
      </select>

      <label for="vision">Vision</label>
      <input type="text" id="vision" name="vision" value="<?php echo $row['vision']; ?>">

      <label for="mision">Mision</label>
      <input type="text" id="Mision" name="Mision" value="<?php echo $row['Mision']; ?>">

      <label for="pitchdeck">Pitch Deck</label>
      <input type="text" id="pitchdeck" name="pitchdeck" value="<?php echo $row['pitchdeck']; ?>">

      <label for="project_description">Project Description</label>
      <textarea id="project_description" name="project_description"><?php echo $row['project_description']; ?></textarea>

      <button type="submit">Save Changes</button>
    </form>
  </div>

</body>
</html>
