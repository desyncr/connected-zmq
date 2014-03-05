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
return array(
    'modules' => array(
        'Desyncr\Connected',
    ),
    'module_listener_options' => array(
        'config_glob_paths' => array(
            __DIR__ . '/testing.config.php',
        ),
        'module_paths' => array(),
    ),
);
