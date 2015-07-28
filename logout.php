<?php

require 'bootstrap.php';

if( ! $userManager->check())
{
	redirect('/login.php');
}

$userManager->logout();

redirect('/login.php');
