<?php

if (!isset($_SESSION['username']) || !isset($_SESSION['level'])) {
  header('Location: ../login.php');
  exit();
}

if ($_SESSION['level'] !== 'admin') {
  header('Location: ../login.php');
  exit();
}

$mysql_adm = mysqli_query($conn, "select * from users where username='$_SESSION[username]'");
$data_adm = mysqli_fetch_array($mysql_adm);
$name = $data_adm['name'];
$level = $data_adm['level'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CinnaCafe | <?= $title ?? ''; ?></title>
  <?php include BASE_PATH . '/admin/layout/partials/head.php'; ?>
</head>

<body>
  <div class="container-scroller">
    <?php include BASE_PATH . '/admin/layout/partials/header.php'; ?>
    <div class="container-fluid page-body-wrapper">
      <?php include BASE_PATH . '/admin/layout/partials/sidebar.php'; ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <?php echo $content ?? ''; ?>
        </div>
        <?php include BASE_PATH . '/admin/layout/partials/foot.php'; ?>
      </div>
    </div>
  </div>

  <?php include BASE_PATH . '/admin/layout/partials/footer.php'; ?>
</body>

</html>