<?php

namespace Desyncr\Connected\Zmq\Factory;

use Desyncr\Connected\Factory\AbstractServiceFactory;
use Desyncr\Connected\Zmq\Service\ZmqService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ZmqServiceFactory extends AbstractServiceFactory implements FactoryInterface
{
    protected $configuration_key = 'zmq-adapter';

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        parent::createService($serviceLocator);

        $zmq = $serviceLocator->get('Desyncr\Connected\Zmq\Client\ZmqClient');
        $options = isset($this->config[$this->configuration_key]) ? $this->config[$this->configuration_key] : array();

        return new ZmqService($zmq, $options);

    }
}
