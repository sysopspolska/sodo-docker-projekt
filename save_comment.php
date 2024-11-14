<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];

    if (!empty($content)) {
        $host = getenv('DB_HOST');
        $login = getenv('DB_LOGIN');
        $password = getenv('DB_PASSWORD');
        $database = 'comments_db';

        try {
            $db = new PDO("mysql:host=$host;dbname=$database", $login, $password);
            $stmt = $db->prepare("INSERT INTO comments (content) VALUES (:content)");
            $stmt->bindParam(':content', $content);
            $stmt->execute();

            header("Location: index.php");
            exit;
        } catch (PDOException $e) {
            echo "Błąd przy zapisywaniu komentarza: " . $e->getMessage();
        }
    } else {
        echo "Komentarz nie może być pusty.";
    }
}
?>
