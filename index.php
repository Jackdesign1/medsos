<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
}
else{
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Navbar with Dropdown</title>
  <link rel="stylesheet" type="text/css" href="style.css">
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

  <div class="container-index">
  <div class="column-left">
    <h2>TOP - Picks</h2>
    <div class="box">TOP - Project</div>
    <div class="box">TOP - Mentor</div>
    <div class="box">TOP - Investor</div>
    <div class="box">Industry Project</div>
  </div>

    <div class="column-center">
  <div class="column-center-left">
  <img src="<?php echo $row['profile_picture']; ?>" alt="Profile Picture">
</div>

  <div class="column-center-right">
  <textarea id="status-textarea" class="status-input" placeholder="Tulis status Anda..."></textarea>
  <label for="status-input" class="upload-button">Upload</label>
  <input type="file" id="status-input" class="hidden-input">
</div>



</div>

    <div class="column-right">
      <!-- Konten kolom kanan -->
    </div>
  </div>


</body>
</html>
