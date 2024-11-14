<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Formularz komentarzy</title>
</head>
<body>
    <h1>Dodaj komentarz</h1>
    <form action="save_comment.php" method="post">
        <label for="content">Komentarz:</label>
        <textarea id="content" name="content" required></textarea><br><br>
        <button type="submit">Zapisz komentarz</button>
    </form>

    <h2>Lista komentarzy</h2>
    <?php
    $host = getenv('DB_HOST');
    $login = getenv('DB_LOGIN');
    $password = getenv('DB_PASSWORD');
    $database = 'comments_db';

    try {
        $db = new PDO("mysql:host=$host;dbname=$database", $login, $password);
        $stmt = $db->query("SELECT content, timestamp FROM comments ORDER BY timestamp DESC");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<p><strong>" . htmlspecialchars($row['content']) . "</strong><br>";
            echo "<small>" . $row['timestamp'] . "</small></p><hr>";
        }
    } catch (PDOException $e) {
        echo "Błąd przy wyświetlaniu komentarzy: " . $e->getMessage();
    }
    ?>
</body>
</html>
