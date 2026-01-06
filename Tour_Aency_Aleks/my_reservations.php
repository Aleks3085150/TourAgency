<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) header("Location: login_user.php");

$user_id = $_SESSION['user_id'];
$query = "SELECT r.id, d.name, d.price, r.reservation_date 
          FROM reservations r 
          JOIN destinations d ON r.destination_id = d.id 
          WHERE r.user_id = $user_id";
$res = $conn->query($query);
?>
<h2>Моите резервации</h2>
<table border="1">
<tr><th>Дестинация</th><th>Цена</th><th>Дата</th></tr>
<?php while($row = $res->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= $row['price'] ?> лв.</td>
    <td><?= $row['reservation_date'] ?></td>
</tr>
<?php endwhile; ?>
</table>
