<?php

require 'bootstrap.php';

if($userManager->check())
{
    redirect('/');
}

$username       = (isset($_POST['username']))       ? $_POST['username'] : '';
$firstname      = (isset($_POST['firstname']))      ? $_POST['firstname'] : '';
$lastname       = (isset($_POST['lastname']))       ? $_POST['lastname'] : '';
$addressNumber  = (isset($_POST['addressNumber']))  ? $_POST['addressNumber'] : '';
$addressStreet  = (isset($_POST['addressStreet']))  ? $_POST['addressStreet'] : '';
$addressCity    = (isset($_POST['addressCity']))    ? $_POST['addressCity'] : '';

$error = null;

function check(array $inputs)
{
    if(empty($inputs['username'])) {
        return "Le nom utilisateur doit être rempli.";
    } else if(strlen($inputs['username']) < 2) {
        return "Le nom d'utilisateur est trop court.";
    } else if(strlen($inputs['username']) > 255) {
        return "Le nom d'utilisateur est trop long.";
    }

    if(empty($inputs['password'])) {
        return "Le mot de passe doit être rempli.";
    } else if(strlen($inputs['password']) < 5) {
        return "Le mot de passe doit contenir au moins 5 charactères.";
    } else if(empty($inputs['password_confirmation'])) {
        return "La confirmation du mot de passe doit être remplie.";
    } else if($inputs['password'] != $inputs['password_confirmation']) {
        return "Le mot de passe et le mot de passe de confirmation doivent être identiques.";
    }

    if(empty($inputs['firstname'])) {
        return "Le prénom doit être rempli.";
    } else if(strlen($inputs['firstname']) > 150) {
        "Le prénom doit contenir moins de 150 charactères.";
    }

    if(empty($inputs['lastname'])) {
        return "Le nom doit être rempli.";
    } else if(strlen($inputs['lastname']) > 150) {
        "Le nom doit contenir moins de 150 charactères.";
    }

    if(empty($inputs['address_number'])) {
        return "Le numéro d'adresse doit être rempli.";
    }

    if(empty($inputs['address_street'])) {
        return "Le nom de la rue doit être rempli.";
    }

    if(empty($inputs['address_city'])) {
        return "Le nom de la ville doit être rempli.";
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // vérification des entrées utilisateurs
    // si les données sont mauvaises alors on les affiche à l'aide de la variable $error
    if(is_null($error = check($_POST)))
    {
        $addressManager = new Managers\AddressManager($db);
        $personManager  = new Managers\PersonManager($db);

        $address = new \Entities\Address(0, $_POST['address_number'], $_POST['address_street'], $_POST['address_city']);
        $person  = new \Entities\Person(0, $_POST['firstname'], $_POST['lastname'], $address);

        $addressManager->create($address);
        $personManager->create($person);

        if($userManager->register($_POST['username'], $_POST['password'], $person))
        {
            redirect('/');
        }

        $error = "Le nom d'utilisateur est déjà pris.";
    }
}

$title = "Inscription";

?>

<?php require 'header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form action="register.php" method="POST">
                <?php if( ! is_null($error)): ?>
                <span class="text-danger"><?php echo htmlentities($error); ?></span>
                <?php endif; ?>
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" name="username" class="form-control" value="<?php echo htmlentities($username); ?>">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input type="text" name="firstname" class="form-control" value="<?php echo htmlentities($firstname); ?>">
                </div>

                <div class="form-group">
                    <label for="lastname">Nom</label>
                    <input type="text" name="lastname" class="form-control" value="<?php echo htmlentities($lastname); ?>">
                </div>

                <div class="form-group">
                    <label for="address_number">Numéro de rue</label>
                    <input type="text" name="address_number" class="form-control" value="<?php echo htmlentities($addressNumber); ?>">
                </div>

                <div class="form-group">
                    <label for="address_street">Nom de rue</label>
                    <input type="text" name="address_street" class="form-control" value="<?php echo htmlentities($addressStreet); ?>">
                </div>

                <div class="form-group">
                    <label for="address_city">Ville</label>
                    <input type="text" name="address_city" class="form-control" value="<?php echo htmlentities($addressCity); ?>">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-default" value="S'enregistrer">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'footer.php';
