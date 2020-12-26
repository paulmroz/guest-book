<?php

$sort = getParam('sort', 'id');
$direction = getParam('direction', 'asc');

if (!in_array(strtolower($sort), ['created_at'])) {
    $sort = 'id';
}

if (!in_array(strtolower($direction), ['desc', 'asc'])) {
    $direction = 'asc';
}

$nextDirection = 'asc' === $direction ? 'desc' : 'asc';
$stmt = $pdo->query("SELECT * FROM `entries` ORDER BY `{$sort}` {$direction}");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['submit_add'])) {
    $date = date('d/m/Y h:i:s', time());
    $stmt = $pdo->prepare('INSERT INTO entries(`autor`, `wpis`, `created_at`) VALUES (?, ?, ?)');
    $stmt->execute([
        $_POST['autor'],
        $_POST['wpis'],
        $date
    ]);

    header("Location: delete.php");
    exit();
}

if (isset($_POST['submit_edit']) && isset($_POST['id'])) {
    $stmt = $pdo->prepare('UPDATE entries SET autor = ?, wpis = ? WHERE id = ?');
    $stmt->execute([
            $_POST['autor'],
            $_POST['wpis'],
            $_POST['id']
    ]);

    header("Location: delete.php");
    exit();
}

if (isset($_POST['submit_delete']) && isset($_POST['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM entries WHERE id = ?");
    $stmt->execute([$_POST['id']]);
    $entries = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$entries) {
        header("Location: delete.php");
        exit();
    }

    $stmt = $pdo->prepare("DELETE FROM entries WHERE id = ?");
    $stmt->execute([$_POST['id']]);

    header("Location: delete.php");
    exit();
}

?>

<div>
    <div>
        <div class="alert alert-info">
            <span>Sortuj według:</span>
            <a href="?sort=autor&direction=<?= $nextDirection ?>">Autor /</a>
            <a href="?sort=wpis&direction=<?= $nextDirection ?>">Wpis /</a>
            <a href="?sort=created_at&direction=<?= $nextDirection ?>">Utworzono</a>
        </div>
        <div>
        
            <div class="form-row">
                <?php foreach ($rows as $row): ?>

                <form method="post" role="form-control">
                    <input type="text" name="id" value="<?= $row['id'] ?>" hidden>
                    <input type="text" class="col-10 p-1 m-1" value="<?= $row['autor'] ?>" name="autor">
                    <input type="text" class="col-10 p-1 m-1" value="<?= $row['wpis'] ?>" name="wpis">
                
                    <div class="btn-group">
                        <button type="submit" name="submit_edit" class="btn btn-warning">Edytuj</button>
                        <button type="submit" name="submit_delete" class="btn btn-danger">Usuń</button>
                    </div>
                </form>
                <hr>

                <?php endforeach; ?>
            </div>

            <div class="alert alert-success mt-3">Dodawanie:</div>
            <form method="post" role="form">
                <div class="form-group">
                    <label for="autor">Autor</label>
                    <input type="text" class="form-control" name="autor" id="autor" required>
                </div>

                <div class="form-group">
                    <label for="wpis">Treść wpisu</label>
                    <textarea name="wpis" id="wpis" class="form-control"></textarea>
                </div>

                <button type="submit" name="submit_add" class="btn btn-primary">Dodaj</button>
            </form>

        </div>
    </div>
</div>