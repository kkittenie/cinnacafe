<?php
include '../config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $level = $_POST['level'];
  
  $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
  $check_stmt->bind_param("ss", $username, $email);
  $check_stmt->execute();
  $check_stmt->store_result();

  if ($check_stmt->num_rows > 0) {
      $insert_error = "Username or email is already in use.";
  } else {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO users (name, username, email, password, level) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sssss", $name, $username, $email, $hashed_password, $level);

      if ($stmt->execute()) {
          $insert_success = true;
      } else {
          $insert_error = "Error: " . $stmt->error;
      }

      $stmt->close();
  }

  $check_stmt->close();
}

$title = 'Create User';

ob_start();
?>

<?php
$menu_title = "Create User";
$link1url = "user_index.php";
$link1 = "User";
$link2 = "Create";

include 'components/breadcrumb.php';
?>

<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <?php if(isset($insert_success) && $insert_success): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              User added successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php endif; ?>
          
        <?php if(isset($insert_error)): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $insert_error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        <h4 class="card-title">Add User</h4>
        <form class="forms-sample" method="POST" action="user_create.php">
          <div class="form-group">
            <label for="exampleInputName1">Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Name" required>
          </div>
          <div class="form-group">
            <label for="exampleInputName1">Username</label>
            <input type="text" name="username" class="form-control" id="exampleInputName1" placeholder="Name" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="Email" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword4">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword4" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label for="exampleSelectGender">Role</label>
            <select class="form-select" name="level">
              <option disabled selected>-- Choose Role --</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
          <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
          <a href="user_create.php" class="btn btn-light">Clear</a>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

include 'layout/mainlayout.php';

?>