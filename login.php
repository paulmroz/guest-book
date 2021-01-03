<?php
include __DIR__ . '/bootstrap.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php include __DIR__ . '/partials/navbar.php' ?>
    <div class="container mt-5 pt-5">
        <form action="save-credentials.php" method="post">
            <div class="form-group">
                <label for="username">Login</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>

            <div class="form-group">
                <label for="password">Hasło</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Zaloguj</button>
        </form>

    </div>
</body>

</html>