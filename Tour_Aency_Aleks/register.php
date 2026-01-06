<?php
include 'config.php';

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "Регистрацията е успешна! <a href='login.php'>Вход</a>";
    } else {
        echo "Грешка: " . $stmt->error;
    }
}
?>

<form method="post">
    <h2>Регистрация</h2>
    <input type="text" name="username" placeholder="Потребителско име" required><br>
    <input type="email" name="email" placeholder="Имейл" required><br>
    <input type="password" name="password" placeholder="Парола" required><br>
    <button type="submit" name="register">Регистрация</button>
</form>
