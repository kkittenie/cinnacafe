<?php
include '../config.php';
session_start();

$mysql_adm = mysqli_query($conn, "select * from users where username='$_SESSION[username]'");
$data_adm = mysqli_fetch_array($mysql_adm);

$title = 'Reservation';

ob_start();
?>

<?php
$menu_title = "Reservation";
$link1url = "reservation_index.php";
$link1 = "Reservation";
$link2 = "List";

include 'components/breadcrumb.php';
?>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Reservation Table</h4>
        </p>
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Created Date</th>
              <th>Name</th>
              <th>Phone Number</th>
              <th>Reservation Date</th>
              <th>Time</th>
              <th>Guest</th>
              <th>Status</th>
              <th width="20%">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM reservations";
            $result = mysqli_query($conn, $query);
            $iteration = 1;
            while($r2 = mysqli_fetch_array($result)){
              $id = $r2['id'];
              $created_at = $r2['created_at'];
              $name = $r2['name'];
              $phone = $r2['phone_number'];
              $date = $r2['date'];
              $time = $r2['time'];
              $guest = $r2['guests'];
              $status = $r2['status'];
            ?>
            <t>
              <td><?php echo $iteration++ ?></td>
              <td><?php echo $created_at; ?></td>
              <td><?php echo $name; ?></td>
              <td><?php echo $phone; ?></td>
              <td><?php echo $date; ?></td>
              <td><?php echo $time; ?></td>
              <td><?php echo $guest; ?></td>
              <td>
                <?php if ($status == 'accepted'): ?>
                  <span class="badge badge-pill badge-gradient-success">Accepted</span>
                <?php elseif ($status == 'rejected'): ?>
                  <span class="badge badge-pill badge-gradient-danger">Rejected</span>
                <?php else: ?>
                  <span class="badge badge-pill badge-gradient-warning">Pending</span>
                <?php endif; ?>
              </td>
              <td>
                <?php if ($status == 'pending'): ?>
                  <a href="reservation_action.php?action=edit&id=<?php echo $id; ?>" class="btn btn-sm btn-gradient-warning">Action</a>
                <?php elseif ($status == 'accepted' || $status == 'rejected'): ?>
                  <a href="reservation_detail.php?id=<?php echo $id; ?>" class="btn btn-sm btn-gradient-info">Detail</a>
                <?php endif; ?>
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