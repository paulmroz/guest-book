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


    if($_SESSION['captcha'] == strtoupper($_POST['captcha'])){

        $date = date('Y/m/d h:i:s', time());
        $stmt = $pdo->prepare('INSERT INTO entries(`autor`, `wpis`, `created_at`) VALUES (?, ?, ?)');
        $stmt->execute([
            $_POST['autor'],
            $_POST['wpis'],
            $date
        ]);
    }

    header('Location: index.php');
    exit();
 
}
?>

<div>
    <div>
        <div class="alert alert-info">
            <span>Sortuj według:</span>
            <a href="?sort=created_at&direction=<?= $nextDirection ?>">Utworzono</a>
        </div>
        <div>
        
            
                <?php foreach ($rows as $row): ?>
                <div class="card mx-auto mt-1">
                    <div class="card-header">
                        <?= $row['autor'] ?>
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                        <p><?= $row['wpis'] ?></p>
                        <footer class="blockquote-footer"><cite title="Source Title"><?= (new DateTime($row['created_at']))->format('d-m-Y H:i:s') ?></cite></footer>
                        </blockquote>
                    </div>
                </div>
                <?php endforeach; ?>
           

            <div class="alert alert-success mt-3"><h3 class="text-primary">Dodawanie:</h3>
            <form method="post" role="form">
                <div class="form-group">
                    <label for="autor">Autor:</label>
                    <input type="text" class="form-control" name="autor" id="autor" required>
                </div>

                <div class="form-group">
                    <label for="wpis">Treść wpisu:</label>
                    <textarea name="wpis" id="wpis" class="form-control"></textarea>
                </div>

                
                <img src="../captcha.php" alt="Captcha image">

                <div class="form-group">
                    <label for="captcha">Przepisz kod z obrazka:</label>
                    <p>(wielkość liter nie ma znaczenia)</p>
                    <input name="captcha" id="captcha" class="form-control" required>
                </div>
                

                <button type="submit" name="submit_add" class="btn btn-primary">Dodaj</button>
            </form>
            </div>

        </div>
    </div>
</div>