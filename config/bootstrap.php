<?php
/*
 * Bootstrap CakePHP
 */
if (!defined('CAKE_CORE_INCLUDE_PATH')) {
    define('CAKE_CORE_INCLUDE_PATH', ROOT . DS . 'vendor' . DS . 'cakephp' . DS . 'cakephp');
}

// Load CakePHP bootstrap files
if (file_exists(ROOT . '/config/bootstrap_cli.php')) {
    require ROOT . '/config/bootstrap_cli.php';
}
