<?php
session_start();
include('functions.php');
include 'config.php';

// Check if user has checked a reservation
if (!isset($_SESSION['reservation_name']) || !isset($_SESSION['reservation_phone'])) {
    header("Location: check_reservation.php");
    exit();
}

$name = $_SESSION['reservation_name'];
$phone = $_SESSION['reservation_phone'];

// Get reservations for this user with admin username
$stmt = $conn->prepare("SELECT r.*, u.username as admin_username FROM reservations r 
                        LEFT JOIN users u ON r.user_id = u.id 
                        WHERE r.name = ? AND r.phone_number = ? ORDER BY created_at DESC");
$stmt->bind_param("ss", $name, $phone);
$stmt->execute();
$result = $stmt->get_result();
$reservations = [];

while ($row = $result->fetch_assoc()) {
    $reservations[] = $row;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Your Reservations</title>
    <?php echo getAlertStyles(); ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Miniver&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap');

        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(to right, #e0f2fe, #fff8e1); /* Pastel gradient */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .card {
            background-color: #fff;
            padding: 25px 20px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 450px;
            width: 90%;
            transition: all 0.3s ease-in-out;
        }

        h1 {
            color: #a47192;
            font-size: 24px;
            margin-bottom: 5px;
        }

        h2 {
            color: #c288b4;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .reservation-item {
            background-color: #fef6fb;
            border: 1px dashed #eac5dd;
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 15px;
            text-align: left;
        }

        .reservation-item p {
            margin: 6px 0;
            color: #5c4a57;
            font-size: 14px;
        }

        .reservation-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px 15px;
            margin-top: 8px;
        }

        .reservation-grid p {
            margin: 0;
            font-size: 14px;
            color: #5c4a57;
        }

        .full-row {
            grid-column: span 2;
            margin-top: 8px;
        }


        .status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-accepted {
            background-color: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 16px;
            background-color: #f6e7f1;
            color: #5c4a57;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s;
            font-size: 14px;
        }

        a:hover {
            background-color: #eac5dd;
            transform: translateY(-2px);
        }

        .emoji {
            font-size: 28px;
            margin-bottom: 5px;
        }
        
        .no-reservations {
            text-align: center;
            color: #666;
            margin: 20px 0;
            font-size: 14px;
        }
        
        .clear-button {
            background-color: #f9f3f7;
            border: none;
            color: #5c4a57;
            padding: 8px 15px;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
        }
        
        .clear-button:hover {
            background-color: #eac5dd;
        }
        
        .admin-note {
            background-color: #f9f9f9;
            padding: 6px;
            border-radius: 5px;
            margin-top: 5px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="emoji">📋</div>
        <h1>Hello, <?php echo htmlspecialchars($name); ?>!</h1>
        <h2>Your Reservation History</h2>
        <?php displayAlert(); ?>
        
        <?php if (count($reservations) > 0): ?>
            <?php foreach ($reservations as $reservation): ?>
              <div class="reservation-item">
                <div class="reservation-grid">
                    <p><strong>📅 Date:</strong> <?php echo htmlspecialchars($reservation['date']); ?></p>
                    <p><strong>🕒 Time:</strong> <?php echo htmlspecialchars($reservation['time']); ?></p>
                    <p><strong>👥 Guests:</strong> <?php echo htmlspecialchars($reservation['guests']); ?></p>
                    <p>
                        <strong>🔄 Status:</strong>
                        <?php if ($reservation['status'] == 'pending'): ?>
                            <span class="status status-pending">Pending</span>
                        <?php elseif ($reservation['status'] == 'accepted'): ?>
                            <span class="status status-accepted">Accepted</span>
                        <?php elseif ($reservation['status'] == 'rejected'): ?>
                            <span class="status status-rejected">Rejected</span>
                        <?php endif; ?>
                    </p>

                    <?php if ($reservation['status'] == 'accepted' && isset($reservation['admin_username'])): ?>
                        <p><strong>✅ Accepted by:</strong> <?php echo htmlspecialchars($reservation['admin_username']); ?></p>
                    <?php elseif ($reservation['status'] == 'rejected' && isset($reservation['admin_username'])): ?>
                        <p><strong>❌ Rejected by:</strong> <?php echo htmlspecialchars($reservation['admin_username']); ?></p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($reservation['admin_notes']) && ($reservation['status'] == 'accepted' || $reservation['status'] == 'rejected')): ?>
                    <p class="full-row"><strong>📝 Notes:</strong></p>
                    <div class="admin-note full-row">
                        <?php echo htmlspecialchars($reservation['admin_notes']); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-reservations">
                <p>No reservations found.</p>
            </div>
        <?php endif; ?>
        
        <form action="clear_reservation_session.php" method="post">
            <button type="submit" class="clear-button">Check Another Reservation</button>
        </form>
        
        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>