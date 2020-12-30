<?php
    include __DIR__ . '/bootstrap.php';
?>

<!doctype html>
<html lang="en" style="position: relative; min-height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title></title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php include __DIR__ . '/partials/navbar.php' ?>

    <div class="container" style="min-height: 1000px;">

            <?php include __DIR__ . '/partials/entries-list.php' ?>
   
    </div>

    <?php include __DIR__ . '/partials/footer.php' ?>
</body>

</html>