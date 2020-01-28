<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Document</title>
</head>

<body>
    <?php
    $host = '127.0.0.1';
    $db   = 'netland';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getmessage(), (int) $e->getcode());
    }
    $info = $pdo->query('SELECT * FROM gebruikers');
    ?>
    <h1> ADMIN PANEL</h1>
    <form method="POST">
        <input type="text" name="username">
        <input type="password" name="password">
        <input type="submit" value="Log in">
    </form>
    <?php
    foreach ($info as $key => $row) {
        if (
            $_POST['username'] == $row['username'] && $_POST['password'] ==
            $row['password']
        ) {
            echo "logged in as " . $row['username'] . " with password" . $row['password'];
            setcookie("LoggedInUser", $row['id'], time() + (30 + 30));
            header("location: ./index.php");
        }
    }
    ?>
</body>

</html>