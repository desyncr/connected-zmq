<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Desyncr\Connected\Zmq\Service\ZmqService' => 'Desyncr\Connected\Zmq\Factory\ZmqServiceFactory',
            'Desyncr\Connected\Zmq\Client\ZmqClient'  => function($sm) {
                return new \ZMQContext();
            }
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'Desyncr\Connected\Zmq\Controller\Daemon'    => 'Desyncr\Connected\Zmq\Controller\DaemonController',
        )
    ),

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
