<?php
require 'config.php';
if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];
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
  <title>Navbar with Dropdown</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
.profile-container {
  display: flex;
  align-items: flex-start; /* Mengatur elemen berada di sebelah kiri */
  border: 1px solid black;
  margin: 0 50px ;
}

.profile-details {
  margin-top: 0;
  margin-left: 20px; /* Penambahan jarak kiri antara foto, bio, dan tombol */
}

.profile-picture {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  border: 5px solid #fff;
  background-size: cover;
  background-position: center;
}

.profile-picture img {
  width: 100px;
}
.profile-info {
  max width :200px;
}
.profile-name {
  margin-top: 10px;
  font-size: 24px;
}

.profile-bio {
  margin-top: 10px; /* Penambahan jarak atas antara foto dan bio */
  font-size: 16px;
  max-width : 1000px;
  color: #777;
}

.profile-actions {
  margin-top :20px;
margin-left :0;
}

.btn-primary,
.btn-secondary {
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
}

.btn-primary {
  background-color: #1877f2;
  color: #fff;
  margin-right: 10px;
}

.btn-secondary {
  background-color: #fff;
  color: #1877f2;
  border: 1px solid #1877f2;
}

.container-2 {
  display: flex;
  justify-content: flex-start;
  margin-left: 50px;
  margin-right:50px;
  padding :5px;
}

.container-2 button {
  padding: 5px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  margin-right: 5px;
}

.container-2 button:last-child {
  margin-right: 0;
}

.container-3 {
    display: flex;
  justify-content: flex-start;
  margin: 20px;
  border: 1px solid black;
  padding :5px;
}

.container-3 img {
  width :150px
}

.container-post {
	border: 1px solid black;
	padding: 5px;
  margin-right: 50px;
  margin-left: 50px;
}

.container-profil {
	padding: 5px;
	border: 1px solid black;
	display: flex;
}

.container-isi {
	padding: 5px;
	border: 1px solid black;
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
 <div class="profile-container">
  <div class="profile-picture">
    <img src="<?php echo $row['profile_picture']; ?>" alt="Profile Picture">
  </div>
  <div class="profile-info">
    <h1 class="profile-name"><?php echo $row['name']; ?></h1>
    <p class="profile-title"><?php echo $row['title']; ?></p>
    <p class="profile-bio"><?php echo $row['bio']; ?></p>
  </div>
  <div class="profile-actions">
    <button class="btn-primary">Follow</button>
    <button class="btn-secondary">Message</button>
  </div>
</div>

<div class="container-2">
  <button>Post</button>
  <button>Background</button>
</div>

<div class="container-post">
<div class="container-profil">
	<div class="container-profil-left">
<img src="<?php echo $row['profile_picture']; ?>" alt="Profile Picture" style="width :50px; height: 50px; border-radius: 50px; margin-top: 15px; margin-right: 10px;">
</div>
<div class="container-profil-right">
	<p>Muhammad Zaky</p>
	<p>CEO - Nextstep</p>
</div>
</div>
<div class="container-isi">
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	<img src="<?php echo $row['profile_picture']; ?>" alt="Profile Picture" style="width :100px;">
</div>	
<div class="container-isi">

	<button>like</button>
	<button>comment</button>
	<button>share</button>
	
</div>
</div>

  </body>
</html>
