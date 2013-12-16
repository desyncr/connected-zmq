<?php
namespace Desyncr\Connected\Zmq\Factory;
use Desyncr\Connected\Factory as Connected;
use Desyncr\Connected\Zmq\Service\ZmqService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ZmqServiceFactory extends Connected\AbstractServiceFactory implements FactoryInterface {
    protected $configuration_key = 'zmq-adapter';

    public function createService(ServiceLocatorInterface $serviceLocator) {
        parent::createService($serviceLocator);

        $service = new ZmqService();
        $options = isset($this->config[$this->configuration_key]) ? $this->config[$this->configuration_key] : array();
        $service->setOptions($options);
        return $service;

    }
}
