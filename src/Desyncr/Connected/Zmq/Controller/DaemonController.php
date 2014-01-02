<?php

namespace Desyncr\Connected\Zmq\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;
use Desyncr\Connected\Zmq\Daemon\WebsocketDaemon;

class DaemonController extends AbstractActionController
{
    public function executeAction()
    {
        $request = $this->getRequest();
        if (!$request instanceof ConsoleRequest) {
            throw new \RuntimeException('You can call this action from a webspace');
        }
        $instance = $this->getServiceLocator()->get('Desyncr\Connected\Zmq\Daemon\WebsocketDaemon');
        $instance->execute($request);
    }
}
