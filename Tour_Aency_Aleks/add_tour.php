<?php
include 'config.php';
if ($_SESSION['role'] != 'admin') header("Location: login_user.php");

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $conn->query("INSERT INTO destinations (name, description, price) VALUES ('$name','$desc','$price')");
    header("Location: admin_destinations.php");
}
?>
<form method="post">
    <h2>Добавяне на дестинация</h2>
    <input type="text" name="name" placeholder="Име" required><br>
    <textarea name="description" placeholder="Описание"></textarea><br>
    <input type="number" name="price" placeholder="Цена" required><br>
    <button type="submit" name="add">Добави</button>
</form>
