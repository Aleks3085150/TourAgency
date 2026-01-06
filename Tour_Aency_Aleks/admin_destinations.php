<?php
include 'config.php';
if ($_SESSION['role'] != 'admin') header("Location: login_user.php");

$result = $conn->query("SELECT * FROM destinations");
?>
<h2>Дестинации</h2>
<a href="add_tour.php">Добави нова</a>
<table border="1">
<tr><th>Име</th><th>Описание</th><th>Цена</th><th>Действия</th></tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= htmlspecialchars($row['name']); ?></td>
<td><?= htmlspecialchars($row['description']); ?></td>
<td><?= $row['price']; ?> лв.</td>
<td>
<a href="edit_tour.php?id=<?= $row['id']; ?>">Редактирай</a> |
<a href="?delete=<?= $row['id']; ?>">Изтрий</a>
</td>
</tr>
<?php endwhile; ?>
</table>

<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM destinations WHERE id=$id");
    header("Location: admin_destinations.php");
}
?>
