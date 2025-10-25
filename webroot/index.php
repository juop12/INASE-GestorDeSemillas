<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

require dirname(__DIR__) . '/vendor/autoload.php';

use Cake\Core\Configure;
use Cake\Http\Server;

/*
 * Define application constants
 */
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
define('ROOT', dirname(__DIR__));
define('APP_DIR', 'src');
define('WEBROOT_DIR', 'webroot');
define('WWW_ROOT', ROOT . DS . WEBROOT_DIR . DS);
define('CONFIG', ROOT . DS . 'config' . DS);
define('LOGS', ROOT . DS . 'logs' . DS);
define('TMP', ROOT . DS . 'tmp' . DS);
define('CACHE', TMP . 'cache' . DS);

/*
 * Bootstrap CakePHP
 */
require CONFIG . 'bootstrap.php';

$config = require CONFIG . 'app.php';
Configure::write($config);

/*
 * Create and run the HTTP Server
 */
$server = new Server(new \App\Application(CONFIG));
$server->run();
