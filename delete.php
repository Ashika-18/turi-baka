<!-- delete.php -->
<?php
$dsn = 'mysql:dbname=turi-baka;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root';

try {
    $pdo = new PDO($dsn, $user, $password);

    $sql_delete = 'DELETE FROM users WHERE id = :id';
    $stmt_delete = $pdo->prepare($sql_delete);

    $stmt_delete->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

    $stmt_delete->execute();

    $count = $stmt_delete->rowCount();

    $message = "アイテムを{count}件削除しました！";

    header("Location: read.php?message={$message}");
} catch (PDOException $e) {
    exit($e->getMessage());
}
?>