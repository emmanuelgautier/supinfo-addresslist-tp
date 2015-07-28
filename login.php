<?php

require 'bootstrap.php';

if($userManager->check())
{
    redirect('/');
}

$username = isset($_POST['username']) ? $_POST['username'] : '';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $userManager->login($_POST['username'], $_POST['password']);
}

$title = "Connexion";

?>

<?php require 'header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" name="username" class="form-control" value="<?php echo htmlentities($username); ?>" placeholder="username">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="mot de passe">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-default" value="Se connecter">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
