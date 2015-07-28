<?php

require 'autoload.php';
require 'helpers.php';

$config = require 'config.php';

try {
    $db = new PDO(
        "{$config['database']['driver']}:host={$config['database']['host']};port={$config['database']['port']};dbname={$config['database']['database']}",
        $config['database']['username'],
        $config['database']['password']
    );

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch(PDOException $exception) {
    throw new Exception("Database connection failed");
}

$userManager = new \Managers\AuthManager($db);

session_start();

$userManager->bootstrap();
