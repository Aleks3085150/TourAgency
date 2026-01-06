<?php
include 'config.php';
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}
?>
<h2>Администраторски панел</h2>
<ul>
    <li><a href="admin_destinations.php">Управление на дестинации</a></li>
    <li><a href="logout.php">Изход</a></li>
</ul>
