<?php

require 'bootstrap.php';

if( ! $userManager->check())
{
    http_response_code(401);
    exit();
}

if( ! isset($_GET['id']))
{
    http_response_code(404);
    exit();
}

$personManager = new \Managers\PersonManager($db);
$personManager->delete($_GET['id']);
