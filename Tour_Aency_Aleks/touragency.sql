CREATE DATABASE IF NOT EXISTS touragency;
USE touragency;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(255),
    role ENUM('user','admin') DEFAULT 'user'
);

CREATE TABLE destinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description TEXT,
    price DECIMAL(10,2),
    image_url VARCHAR(255)
);

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    destination_id INT,
    reservation_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (destination_id) REFERENCES destinations(id)
);

-- Администратор по подразбиране:
INSERT INTO users (username, email, password, role)
VALUES ('admin', 'admin@site.com', '$2y$10$Qe2rxZQeX7l2h5j7YUT4GuoN6kkbJ3DyEf9aJtUu4ZPObgXgZtC9y', 'admin');
-- Паролата е "admin123"
