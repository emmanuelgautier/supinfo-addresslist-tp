<?php

namespace Managers;

use \PDO;

abstract class AbstractManager
{
    /**
     * PDO instance.
     * 
     * @var \PDO $pdo
     */
    protected $pdo;

    /**
     * Manager constructor.
     * 
     * @param  \PDO  $pdo
     * @return void
     */
    public function __construct(PDO &$pdo)
    {
        $this->pdo = $pdo;
    }
}
