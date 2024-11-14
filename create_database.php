<?php
$host = getenv('DB_HOST');
$login = getenv('DB_LOGIN');
$password = getenv('DB_PASSWORD');
$database = 'comments_db';

try {
    $db = new PDO("mysql:host=$host", $login, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Tworzenie bazy danych, jeśli nie istnieje
    $db->exec("CREATE DATABASE IF NOT EXISTS $database");
    $db->exec("USE $database");

    // Tworzenie tabeli
    $db->exec("CREATE TABLE IF NOT EXISTS comments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        content TEXT NOT NULL,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    echo "Baza danych i tabela zostały utworzone.";
} catch (PDOException $e) {
    echo "Błąd przy tworzeniu bazy danych: " . $e->getMessage();
}
?>
