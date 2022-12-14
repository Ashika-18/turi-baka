<!-- create.php -->
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
    <title>–釣竿登録–</title>
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
        <article>
            <h1>釣竿登録</h1>
            <div>
                <a href="read.php">&lt; 一覧へ</a>
            </div>
            <form action="create.php" method="post" class="registration">
                <div>
                    <label for="name">釣竿メーカー名</label>
                    <input type="text" name="name" required>

                    
                </div>
            </form>
        </article>
    </main>
</body>
</html>