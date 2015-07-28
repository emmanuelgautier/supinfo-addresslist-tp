<?php

spl_autoload_register(function ($class)
{
    require_once __DIR__.'/classes/' . str_replace('\\', '/', $class).'.php';
});
