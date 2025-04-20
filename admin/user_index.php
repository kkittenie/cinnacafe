<?php
include '../config.php';
session_start();

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
  $user_id = $_GET['id'];
  
  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
  
  $stmt->bind_param("i", $user_id);
  
  if ($stmt->execute()) {
    header('Location: user_index.php?status=deleted');
    exit();
  } else {
    $delete_error = "Error deleting record: " . $conn->error;
  }
  
  $stmt->close();
}

$mysql_adm = mysqli_query($conn, "select * from users where username='$_SESSION[username]'");
$data_adm = mysqli_fetch_array($mysql_adm);

$title = 'User';

ob_start();
?>

<?php
$menu_title = "User";
$link1url = "user_index.php";
$link1 = "User";
$link2 = "List";

include 'components/breadcrumb.php';
?>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <?php if(isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data deleted successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <?php if(isset($delete_error)): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $delete_error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        <h4 class="card-title">User Table</h4>
        </p>
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Role</th>
              <th width="20%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM users";
            $result = mysqli_query($conn, $query);
            $iteration = 1;
            while($r2 = mysqli_fetch_array($result)){
              $id = $r2['id'];
              $name = $r2['name'];
              $username = $r2['username'];
              $email = $r2['email'];
              $level = $r2['level'];
            ?>
            <t>
              <td><?php echo $iteration++ ?></td>
              <td><?php echo $name; ?></td>
              <td><?php echo $username; ?></td>
              <td><?php echo $email; ?></td>
              <td><?php echo $level; ?></td>
              <td>
                <a href="user_edit.php?action=edit&id=<?php echo $id; ?>" class="btn btn-sm btn-gradient-warning">Ubah</a>
                <?php 
                  if ($id != $data_adm['id']){
                ?>
                    <form action="user_index.php" method="GET" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this data?')">
                      <input type="hidden" name="action" value="delete">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <button type="submit" class="btn btn-sm btn-gradient-danger">Hapus</button>
                    </form>
                <?php  
                  }
                ?>
              </td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

include 'layout/mainlayout.php';

?>