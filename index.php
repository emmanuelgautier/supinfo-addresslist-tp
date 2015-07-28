<?php

require 'bootstrap.php';

if( ! $userManager->check())
{
    redirect('/login.php');
}

$personManager = new \Managers\PersonManager($db);
$persons = $personManager->findAll();

$title = 'Carnet d\'Adreses';

?>

<?php require 'header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <?php foreach($persons as $person): ?>
                <div class="col-md-3" id="person-<?php echo intval($person->getId()); ?>">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo htmlentities($person->getFirstname()); ?> <?php echo htmlentities($person->getLastname()); ?></div>
                        <?php if( ! is_null($person->getAddress())): ?>
                        <div class="panel-body">
                            <dl>
                                <dt>Numéro de rue</dt>
                                <dd><?php echo htmlentities($person->getAddress()->getNumber()); ?></dd>
                            </dl>

                            <dl>
                                <dt>Nom de rue</dt>
                                <dd><?php echo htmlentities($person->getAddress()->getStreet()); ?></dd>
                            </dl>

                            <dl>
                                <dt>Ville</dt>
                                <dd><?php echo htmlentities($person->getAddress()->getCity()); ?></dd>
                            </dl>
                        </div>
                        <?php endif; ?>

                        <div class="panel-footer">
                            <a class="btn btn-warning" href="/edit.php?id=<?php echo intval($person->getId()); ?>">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <button type="button" class="btn btn-danger" onclick="javascript:destroyPerson(<?php echo intval($person->getId()); ?>)">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <a class="btn btn-success" href="/create.php">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    (function(window, $) {
        'use strict';

        var removePersonNode = function(id) {
            $("#person-" + id).remove();
        };

        var destroyPerson = function(id) {
            $.get('destroy.php', { id: id }, function() {
                removePersonNode(id);
            });
        };

        window.destroyPerson = destroyPerson;
    }(window, jQuery));
</script>

<?php require 'footer.php'; ?>
