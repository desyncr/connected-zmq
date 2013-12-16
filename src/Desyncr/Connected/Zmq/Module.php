<?php
namespace Desyncr\Connected\Zmq;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ServiceProviderInterface {
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespace' => array(__NAMESPACE__ => __DIR__)
            )
        );
    }

    public function getConfig() {
        return include __DIR__ . '/../../../../config/module.config.php';
    }

    public function getServiceConfig() {
        return array(
            'host' => 'tcp://127.0.0.1',
            'port' => 5555
        );
    }
}
