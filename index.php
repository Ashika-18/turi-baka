<!-- index.php -->
<?php
$dsn = 'mysql:dbname=turi-baka;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root'; 

try {
    $pdo = new PDO($dsn, $user, $password);

    $sql_select = 'SELECT * FROM users';

    $stmt_select = $pdo->query($sql_select);

    $users = $stmt_select->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit($e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>–釣竿管理アプリ–</title>
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="home" style="background-image: url('images/lake.jpg')">
    <header>
        <nav>
            <a href="index.php">home</a>
        </nav>
    </header>
    <main>
        <article>
            <h1>釣竿管理アプリ</h1>
            <a class="top_btn" href="read.php">一覧</a>
        </article>
    </main>
    <footer>
        <p class="copyright">&copy; 釣竿管理アプリ 2022 Ashika</p>
    </footer>
</body>
</html>