<?php

require 'bootstrap.php';

if( ! $userManager->check())
{
    redirect('/login.php');
}

if( ! isset($_GET['id']))
{
    http_response_code(404);
    exit();
}

$id = intval($_GET['id']);

$error = null;

function check(array $inputs)
{
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
}

$personManager  = new Managers\PersonManager($db);

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // vérification des entrées utilisateurs
    // si les données sont mauvaises alors on les affiche à l'aide de la variable $error
    if(is_null($error = check($_POST)))
    {
        $person = new \Entities\Person(0, $_POST['firstname'], $_POST['lastname'], $address);

        $personManager->update($id, $person);

        redirect('/');
    }
}

$person = $personManager->find($id);

if(empty($person))
{
    http_response_code(404);
    exit();
}

$firstname  = (isset($_POST['firstname']))  ? $_POST['firstname'] : $person->getFirstname();
$lastname   = (isset($_POST['lastname']))   ? $_POST['lastname'] : $person->getLastname();

$title = 'Ajout d\'une personne';

?>

<?php require 'header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="edit.php?id=<?php echo $id; ?>" method="POST">
                <?php if( ! is_null($error)): ?>
                <span class="text-danger"><?php echo htmlentities($error); ?></span>
                <?php endif; ?>

                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input type="text" name="firstname" class="form-control" value="<?php echo htmlentities($firstname); ?>">
                </div>

                <div class="form-group">
                    <label for="lastname">Nom</label>
                    <input type="text" name="lastname" class="form-control" value="<?php echo htmlentities($lastname); ?>">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-default" value="S'enregistrer">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
