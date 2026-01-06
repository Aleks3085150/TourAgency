<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM users WHERE id=$user_id");
$user = $result->fetch_assoc();
?>

<h2>Здравей, <?php echo htmlspecialchars($user['username']); ?>!</h2>
<a href="my_reservations.php">Моите резервации</a> |
<a href="logout.php">Изход</a>
