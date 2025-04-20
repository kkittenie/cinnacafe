<?php
include '../config.php';
session_start();

$title = 'Edit User';
$edit_id = '';
$user_data = null;

if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    
    $stmt = $conn->prepare("SELECT id, name, username, email, level FROM users WHERE id = ?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
    } else {
        header('Location: user_index.php');
        exit();
    }
    
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $level = $_POST['level'];
    
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, email = ?, password = ?, level = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $name, $username, $email, $hashed_password, $level, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, email = ?, level = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $name, $username, $email, $level, $id);
    }
    
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?");
    $check_stmt->bind_param("ssi", $username, $email, $id);
    $check_stmt->execute();
    $check_stmt->store_result();
    
    if ($check_stmt->num_rows > 0) {
        $update_error = "Username or email is already in use by another user.";
    } else {
        if ($stmt->execute()) {
            $update_success = true;
            
            $stmt = $conn->prepare("SELECT id, name, username, email, level FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user_data = $result->fetch_assoc();
        } else {
            $update_error = "Error updating record: " . $stmt->error;
        }
    }
    
    $stmt->close();
    $check_stmt->close();
}

ob_start();
?>

<?php
$menu_title = "Edit User";
$link1url = "user_index.php";
$link1 = "User";
$link2 = "Edit";

include 'components/breadcrumb.php';
?>

<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <?php if(isset($update_success) && $update_success): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            User updated successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        
        <?php if(isset($update_error)): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $update_error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        
        <h4 class="card-title">Edit User</h4>
        <?php if($user_data): ?>
        <form class="forms-sample" method="POST" action="user_edit.php">
          <input type="hidden" name="id" value="<?php echo $user_data['id']; ?>">
          
          <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" name="name" class="form-control" id="inputName" value="<?php echo htmlspecialchars($user_data['name']); ?>" required>
          </div>
          
          <div class="form-group">
            <label for="inputUsername">Username</label>
            <input type="text" name="username" class="form-control" id="inputUsername" value="<?php echo htmlspecialchars($user_data['username']); ?>" required>
          </div>
          
          <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" name="email" class="form-control" id="inputEmail" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
          </div>
          
          <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Leave blank to keep current password">
            <small class="form-text text-muted">Fill only if you want to change the password</small>
          </div>
          
          <div class="form-group">
            <label for="selectRole">Role</label>
            <select class="form-select" name="level" id="selectRole">
              <option value="admin" <?php echo ($user_data['level'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
              <option value="user" <?php echo ($user_data['level'] == 'user') ? 'selected' : ''; ?>>User</option>
            </select>
          </div>
          
          <button type="submit" name="update" class="btn btn-gradient-primary me-2">Update</button>
          <a href="user_index.php" class="btn btn-light">Back</a>
        </form>
        <?php else: ?>
          <div class="alert alert-warning">
            User not found or invalid ID.
          </div>
          <a href="user_index.php" class="btn btn-light">Back to Users List</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

include 'layout/mainlayout.php';
?>