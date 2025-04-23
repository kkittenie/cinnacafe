<?php
include '../config.php';
session_start();

$mysql_adm = $conn->prepare("SELECT * FROM users WHERE username = ?");
$mysql_adm->bind_param("s", $_SESSION['username']);
$mysql_adm->execute();
$result_adm = $mysql_adm->get_result();
$data_adm = $result_adm->fetch_assoc();
$mysql_adm->close();

$admin_id = $data_adm['id'];

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: reservation_index.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM reservations WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$reservation = $result->fetch_assoc();
$stmt->close();

if (!$reservation || $reservation['status'] !== 'pending') {
    header("Location: reservation_index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $notes = $_POST['notes'];
        
        if ($action === 'accept' || $action === 'reject') {
            $status = ($action === 'accept') ? 'accepted' : 'rejected';
            
            $update_stmt = $conn->prepare("UPDATE reservations SET status = ?, admin_notes = ?, user_id = ? WHERE id = ?");
            $update_stmt->bind_param("ssii", $status, $notes, $admin_id, $id);
            $update_stmt->execute();
            $update_stmt->close();
            
            $message = ($action === 'accept') ? "Reservation has been accepted" : "Reservation has been rejected";
            header("Location: reservation_index.php?success=" . urlencode($message));
            exit;
        }
    }
}

$title = 'Reservation Action';

ob_start();
?>

<?php
$menu_title = "Reservation";
$link1url = "reservation_index.php";
$link1 = "Reservation";
$link2 = "Action";

include 'components/breadcrumb.php';
?>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Reservation Action</h4>
                <p class="card-description">Review and take action on the reservation request</p>
                
                <div class="reservation-details mb-4">
                    <h5>Reservation Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($reservation['name']); ?></p>
                            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($reservation['phone_number']); ?></p>
                            <p><strong>Guests:</strong> <?php echo htmlspecialchars($reservation['guests']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Date:</strong> <?php echo htmlspecialchars($reservation['date']); ?></p>
                            <p><strong>Time:</strong> <?php echo htmlspecialchars($reservation['time']); ?></p>
                            <p><strong>Created At:</strong> <?php echo htmlspecialchars($reservation['created_at']); ?></p>
                        </div>
                    </div>
                </div>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="notes">Admin Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Add any notes about this reservation"></textarea>
                    </div>
                    
                    <div class="mt-4 d-flex justify-content-between">
                        <a href="reservation_index.php" class="btn btn-light">Back to List</a>
                        <div>
                            <button type="submit" name="action" value="reject" class="btn btn-danger mr-2">
                                <i class="mdi mdi-close-circle"></i> Reject
                            </button>
                            <button type="submit" name="action" value="accept" class="btn btn-success">
                                <i class="mdi mdi-check-circle"></i> Accept
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

include 'layout/mainlayout.php';
?>