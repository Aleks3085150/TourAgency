<?php
include 'config.php';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: profile.php");
            }
            exit;
        } else {
            echo "Грешна парола!";
        }
    } else {
        echo "Няма такъв потребител!";
    }
}
?>

<form method="post">
    <h2>Вход</h2>
    <input type="email" name="email" placeholder="Имейл" required><br>
    <input type="password" name="password" placeholder="Парола" required><br>
    <button type="submit" name="login">Вход</button>
</form>
