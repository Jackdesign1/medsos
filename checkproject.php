<?php
require 'config.php';
if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];
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
  <title>Navbar with Dropdown</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
.container-new {
  display: grid;
  grid-template-columns: 350px auto; /* Lebar elemen kiri tetap 350px */
  gap: 10px; /* Jarak antara elemen */
  border: 1px solid black;
  padding: 10px;
}

.container-left {
  width: 350px;
  border :1px solid black;
}

.container-right {
  /* Aturan CSS sederhana agar elemen terlihat */
  border :1px solid black;
}

.container-right-1 {
	padding: 5px ;
	border: 1px solid black;
	margin: 5px;
	display: flex;
}


.container-right-2 {
	padding: 5px ;
	border: 1px solid black;
	margin: 5px;
}

.container-right-3 {
	padding: 5px ;
	border: 1px solid black;
	margin: 5px;
}



  </style>
  </head>
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
<body>
<div class="container-new">
<div class="container-left">
<h4>Vision: </h4><p><?php echo $row['vision']; ?></p>

<h4>Mision :</h4><p><?php echo $row['Mision']; ?></p>
<h4>Pitch Deck :</h4><p><?php echo $row['pitchdeck']; ?></p>
</div>	

<div class="container-right">
	<div class="container-right-1">
		<div class="container-right-1-kiri">
			<img src="<?php echo $row['image']; ?>" alt="Profile Picture" style="width :100px;">
		</div>
		<div class="container-right-1-tengah">
			<h1 class="profile-name"><?php echo $row['project_name']; ?></h1>
    <p class="profile-title"><?php echo $row['project_industry']; ?></p>
     <p class="profile-title"><?php echo $row['project_description']; ?></p>
		</div>
		<div class="container-right-1-kanan">
			<button>Follow</button>
		</div>
	</div>
	<div class="container-right-2">
			<button>Post</button>
			<button>Executive Member</button>
			<button>Mentor</button>
			<button>Join Project</button>
	</div>
	<div class="container-right-3">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div>
</div>

</div>

  
  </body>
</html>

