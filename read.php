<!-- read.php -->
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
<body>
<main>
        <article>
            <header>
                <a href="index.php">home</a>
            </header>
            <h1>釣竿一覧</h1>
            <div class="nav">
                <a href="create.php" class="btn"><p>登録</p></a>
            </div>
            
            <table class="users_table">
                <tr>
                    <th>メーカー名</th>
                    <th>全長</th>
                    <th>継数</th>
                    <th>仕舞寸法</th>
                    <th>錘負荷</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
                <?php
                foreach ($users as $user) {
                    $table_row = "
                    <tr>
                    <td>{$user['name']}</td>
                    <td>{$user['length']}</td>
                    <td>{$user['number']}</td>
                    <td>{$user['closing_size']}</td>
                    <td>{$user['weight']}</td>
                    <td><a href='update.php?id={$user['id']}'>編集</a></td>
                    <td><a href='delete.php?id={$user['id']}'>削除</a></td>
                    </tr>
                    ";
                    echo $table_row;
                }
                ?>
            </table>
        </article>
    </main>
    <footer>
        <p class="copyright">&copy; 釣竿管理アプリ 2022 Ashika</p>
    </footer>
</body>
</html>