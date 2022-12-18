<!-- update.php -->
<?php
$dsn = 'mysql:dbname=turi-baka;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root'; 

if (isset($_POST['submit'])) {
    try {
        $pdo = new PDO($dsn, $user, $password);

        $sql_update = '
            UPDATE users 
            SET name = :name,
            length = :length,
            number = :number,
            closing_size = :closing_size,
            weight = :weight
            WHERE id = :id
        ';

        $stmt_update = $pdo->prepare($sql_update);

        $stmt_update->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt_update->bindValue(':length', $_POST['length'], PDO::PARAM_STR);
        $stmt_update->bindValue(':number', $_POST['number'], PDO::PARAM_INT);
        $stmt_update->bindValue(':closing_size', $_POST['closing_size'], PDO::PARAM_STR);
        $stmt_update->bindValue(':weight', $_POST['weight'], PDO::PARAM_STR);
        $stmt_update->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

        $stmt_update->execute();

       

        header("Location: read.php?message={$message}");
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}

if (isset($_GET['id'])) {
    try {
        $pdo = new PDO($dsn, $user, $password);

       $sql_select_user = 'SELECT * FROM users WHERE id = :id';
       $stmt_select_user = $pdo->prepare($sql_select_user);
       
       $stmt_select_user->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

       $stmt_select_user->execute();

       $user = $stmt_select_user->fetch(PDO::FETCH_ASSOC);

       if ($user === FALSE) {
           exit('idパラメータの値が不正です！');
       }
    } catch (PDOException $e) {
        exit($e->getMessage());
    }

} else {
    exit('idパラメータの値が存在しません！');
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
            <h1>釣竿更新</h1>
            <div class="nav">
                <a href="read.php">&lt; 一覧へ</a>
            </div>
            <form action="update.php?id=<?= $_GET['id'] ?>" method="post">
                <div class="registration">
                    <label for="name">釣竿メーカー名</label>
                    <input type="text" name="name" value="<?= $user['name'] ?>" required>

                    <label for="length">全長</label>
                    <input type="text" name="length" value="<?= $user['length'] ?>" required>

                    <label for="number">継数</label>
                    <input type="number" name="number" min="0" max="10" value="<?= $user['number'] ?>" required>

                    <label for="closing_size">仕舞寸法</label>
                    <input type="text" name="closing_size" value="<?= $user['closing_size'] ?>" required>

                    <label for="weight">錘負荷</label>
                    <input type="text" name="weight" value="<?= $user['weight'] ?>" required>
                </div>
                <button type="submit" class="submit_btn" name="submit" value="update">更新</button>
            </form>
        </article>
    </main>
    <footer>
        <p class="copyright">&copy; 釣竿管理アプリ 2022 Ashika</p>
    </footer>
</body>
</html>