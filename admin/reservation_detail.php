<?php
include '../config.php';
session_start();

$mysql_adm = $conn->prepare("SELECT * FROM users WHERE username = ?");
$mysql_adm->bind_param("s", $_SESSION['username']);
$mysql_adm->execute();
$result_adm = $mysql_adm->get_result();
$data_adm = $result_adm->fetch_assoc();
$mysql_adm->close();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: reservation_index.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT r.*, u.name as admin_name FROM reservations r 
                        LEFT JOIN users u ON r.user_id = u.id 
                        WHERE r.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$reservation = $result->fetch_assoc();
$stmt->close();

if (!$reservation || ($reservation['status'] !== 'accepted' && $reservation['status'] !== 'rejected')) {
    header("Location: reservation_index.php");
    exit;
}

$title = 'Reservation Detail';

ob_start();
?>

<?php
$menu_title = "Reservation";
$link1url = "reservation_index.php";
$link1 = "Reservation";
$link2 = "Detail";

include 'components/breadcrumb.php';
?>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Reservation Detail</h4>
                <p class="card-description">Detailed information about the reservation</p>
                
                <div class="reservation-details mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($reservation['name']); ?></p>
                            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($reservation['phone_number']); ?></p>
                            <p><strong>Guests:</strong> <?php echo htmlspecialchars($reservation['guests']); ?></p>
                            <p><strong>Created At:</strong> <?php echo htmlspecialchars($reservation['created_at']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Date:</strong> <?php echo htmlspecialchars($reservation['date']); ?></p>
                            <p><strong>Time:</strong> <?php echo htmlspecialchars($reservation['time']); ?></p>
                            <p><strong>Status:</strong> 
                                <?php if ($reservation['status'] == 'accepted'): ?>
                                    <span class="badge badge-pill badge-gradient-success">Accepted</span>
                                <?php elseif ($reservation['status'] == 'rejected'): ?>
                                    <span class="badge badge-pill badge-gradient-danger">Rejected</span>
                                <?php endif; ?>
                            </p>
                            <p>
                                <strong>
                                    <?php echo ($reservation['status'] == 'accepted') ? 'Accepted' : 'Rejected'; ?> by:
                                </strong> 
                                <?php echo htmlspecialchars($reservation['admin_name'] ?? 'Unknown'); ?>
                            </p>
                        </div>
                    </div>
                    
                    <?php if(isset($reservation['admin_notes']) && !empty($reservation['admin_notes'])): ?>
                    <div class="row mt-3">
                        <div class="col-12">
                            <p><strong>Admin Notes:</strong></p>
                            <div class="p-3 bg-light rounded">
                                <?php echo htmlspecialchars($reservation['admin_notes']); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-4">
                    <a href="reservation_index.php" class="btn btn-light">
                        <i class="mdi mdi-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

include 'layout/mainlayout.php';
?>