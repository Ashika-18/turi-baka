<!-- create.php -->
<?php
$dsn = 'mysql:dbname=turi-baka;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root'; 

if (isset($_POST['submit'])) {
    try {
        $pdo = new PDO($dsn, $user, $password);

        $sql_insert = '
            INSERT INTO users (name, length, number, closing_size, weight)
            VALUES (:name, :length, :number, :closing_size, :weight)
        ';

        $stmt_insert = $pdo->prepare($sql_insert);

        $stmt_insert->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt_insert->bindValue(':length', $_POST['length'], PDO::PARAM_STR);
        $stmt_insert->bindValue(':number', $_POST['number'], PDO::PARAM_INT);
        $stmt_insert->bindValue(':closing_size', $_POST['closing_size'], PDO::PARAM_STR);
        $stmt_insert->bindValue(':weight', $_POST['weight'], PDO::PARAM_STR);

        $stmt_insert->execute();

        header("Location: read.php");
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}

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
            <header>
                <a href="index.php">home</a>
            </header>
            <h1>釣竿登録</h1>
            <div class="nav">
                <p><a class="back" href="read.php">&lt; 一覧へ</a></p>
            </div>
            <form action="create.php" method="post">
                <div class="registration">
                    <label for="name">釣竿メーカー名</label>
                    <input class="input" type="text" name="name" required>

                    <label for="length">全長</label>
                    <input  class="input" type="text" name="length" required>

                    <label for="number">継数</label>
                    <input  class="input" type="number" name="number" min="0" max="10" required>

                    <label for="closing_size">仕舞寸法</label>
                    <input type="text" name="closing_size" required>

                    <label for="weight">錘負荷</label>
                    <input  class="input" type="text" name="weight" required>
                </div>
                <button type="submit" class="submit_btn" name="submit" value="create">登録</button>
            </form>
        </article>
    </main>
    <footer>
        <p class="copyright">&copy; 釣竿管理アプリ 2022 Ashika</p>
    </footer>
</body>
</html>