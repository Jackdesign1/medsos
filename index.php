<?php
session_start();
require 'config.php';
if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
  $post_result = mysqli_query($conn, "SELECT tb_post.*, tb_user.* FROM tb_post JOIN tb_user ON tb_post.id_user= tb_user.id WHERE tb_post.id_user = $id");
} else {
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
        <form action="proses/upload-post.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <textarea id="status-textarea" name="deskripsi" class="status-input" placeholder="Tulis status Anda..."></textarea>
          </div>
          <div class="form-group">
            <input type="file" name="foto">
          </div>
          <button type="submit" name="submit" class="upload-button" style="display: block; width: 100%;">Upload</button>
        </form>
      </div>
    </div>


    <div class="column-right">
      <!-- Konten kolom kanan -->

    </div>
  </div>

  <div class="post">
    <table id="post-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Deskripsi</th>
          <th>Foto</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($post = mysqli_fetch_array($post_result)) {
        ?>

          <tr>
            <td><?= $no++ ?></td>
            <td><?= $post['deskripsi'] ?></td>
            <td><img src="<?= $post['foto'] ?>" alt="" width="100px"></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>


</body>

</html>