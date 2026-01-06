<?php
// Връзка с базата
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "touragency";
$port = 3307;

$conn = new mysqli($host, $user, $pass, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Извличане на дестинации
$sql = "SELECT * FROM destinations";
$result = $conn->query($sql);

// Проверка дали има логнат потребител
$isLogged = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Гост';
?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Tour Agency</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
        }
        header {
            background: #0078d7;
            color: white;
            padding: 15px 0;
            text-align: center;
            font-size: 24px;
        }
        nav {
            background: #005a9e;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
            transition: 0.3s;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .user-info {
            color: #fff;
            float: right;
            margin-right: 20px;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: 0.3s;
        }
        .card:hover {
            transform: scale(1.03);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-content {
            padding: 15px;
        }
        .card-content h3 {
            margin: 0 0 10px;
        }
        .card-content p {
            font-size: 14px;
            color: #555;
        }
        .price {
            color: #0078d7;
            font-weight: bold;
            margin-top: 10px;
        }
        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background: #0078d7;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }
        .btn:hover {
            background: #005a9e;
        }
        footer {
            text-align: center;
            background: #0078d7;
            color: white;
            padding: 10px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header>🌍 Добре дошли в Tour Agency</header>

<nav>
    <a href="index.php">Начало</a>
    <?php if (!$isLogged): ?>
        <a href="login.php">Вход</a>
        <a href="register.php">Регистрация</a>
    <?php else: ?>
        <span class="user-info">👤 <?= htmlspecialchars($username) ?></span>
        <a href="logout.php">Изход</a>
        <?php if ($isAdmin): ?>
            <a href="admin.php">Админ панел</a>
        <?php endif; ?>
    <?php endif; ?>
</nav>

<div class="container">
<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "
        <div class='card'>
            <img src='{$row['image_url']}' alt='{$row['name']}'>
            <div class='card-content'>
                <h3>{$row['name']}</h3>
                <p>{$row['description']}</p>
                <div class='price'>Цена: {$row['price']} лв.</div>";

        if ($isLogged) {
            echo "<a href='reserve.php?destination_id={$row['id']}' class='btn'>Резервирай</a>";
        } else {
            echo "<a href='login.php' class='btn'>Влез, за да резервираш</a>";
        }

        echo "</div></div>";
    }
} else {
    echo "<p>Няма добавени дестинации.</p>";
}
?>
</div>

<footer>© <?= date('Y') ?> Tour Agency. Всички права запазени.</footer>

</body>
</html>
<?php $conn->close(); ?>
