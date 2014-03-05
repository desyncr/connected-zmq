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
use Zend\ServiceManager\ServiceLocatorInterface;

return array(
    /**
     * Configure factories
     */
    'service_manager' => array(
        'factories' => array(
            'Desyncr\Connected\Zmq\Service\ZmqService'
            => 'Desyncr\Connected\Zmq\Factory\ZmqServiceFactory',

            'Desyncr\Connected\Zmq\Daemon\WebsocketDaemon'
            => 'Desyncr\Connected\Zmq\Factory\WebsocketDaemonFactory',

            'Desyncr\Connected\Zmq\Options\WebsocketDaemonOptions'
            => 'Desyncr\Connected\Zmq\Factory\WebsocketDaemonOptionsFactory',

            'Desyncr\Connected\Zmq\Options\ZmqServiceOptions'
            => 'Desyncr\Connected\Zmq\Factory\ZmqServiceOptionsFactory',

            'Desyncr\Connected\Zmq\Client\ZmqClient'
            => function(ServiceLocatorInterface $sm) {
                return new \ZMQContext();
            }
        ),
    ),

    /**
     * Configure controllers
     */
    'controllers' => array(
        'invokables' => array(
            'Desyncr\Connected\Zmq\Controller\Daemon'
            => 'Desyncr\Connected\Zmq\Controller\DaemonController',
        )
    ),

    /**
     * Configure routes
     */
    'console' => array(
        'router' => array(
            'routes' => array(
                'zmq_daemon_route' => array(
                    'options' => array(
                        'route' => 'zmq daemon execute',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Desyncr\Connected\Zmq\Controller',
                            'controller' => 'Daemon',
                            'action' => 'execute'
                        )
                    )
                )
            )
        )
    ),
);
