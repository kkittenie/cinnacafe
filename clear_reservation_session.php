<?php
session_start();

unset($_SESSION['reservation_name']);
unset($_SESSION['reservation_phone']);

header("Location: check_reservation.php");
exit();
?>