<?php
/**
 * Desyncr\Connected\Zmq
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\Zmq
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    $loader = include __DIR__ . '/../vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/../../../autoload.php')) {
    $loader = include __DIR__ . '/../../../autoload.php';
} else {
    throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}

/** @var $loader \Composer\Autoload\ClassLoader */
$loader->add('Desyncr\\Connected\\ZmqTest\\', __DIR__);
