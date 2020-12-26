
<nav class="navbar navbar-light bg-light">
    <div>
        <a class="navbar-brand">Księga gości</a>
        <?php if (!empty($_SESSION['LOGGED'])): ?>
            <a class="btn btn-outline-dark mt-1" href="/delete.php">Admin Panel</a>
        <?php endif; ?>
    </div>
    <?php if (!empty($_SESSION['LOGGED'])): ?>
        <form method="post" role="form" action="/logout.php" class="inline-block">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="logout">Logout</button>
        </form>
    <?php else: ?>
        <a class="btn btn-outline-success my-2 my-sm-0" href="/login.php">Login</a>
    <?php endif; ?>
       
</nav>