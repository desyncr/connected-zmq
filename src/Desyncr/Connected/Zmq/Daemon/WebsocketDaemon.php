<?php

namespace Desyncr\Connected\Zmq\Daemon;

use React;
use Ratchet;
use ZMQ;

class WebsocketDaemon
{
    protected $broker_bind  = 'tcp://127.0.0.1:5555';
    protected $broker_on    = 'onNotification';
    protected $ws_bind      = '0.0.0.0';
    protected $ws_port      = 8080;
    protected $pusher       = 'Desyncr\Connected\Zmq\Daemon\PusherDaemon';

    public function execute($request)
    {
        $loop   = React\EventLoop\Factory::create();
        $pusher = is_string($this->pusher) ? new $this->pusher : $this->pusher;

        $this->launchZeroMQ($this->broker_bind, $this->broker_on, $loop, $pusher);

        $this->launchReact($this->ws_bind, $this->ws_port, $loop, $pusher);

        $loop->run();
    }

    private function launchZeroMQ($bind, $on, $loop, $pusher)
    {
        $context = new React\ZMQ\Context($loop);
        $pull = $context->getSocket(ZMQ::SOCKET_PULL);

        $pull->bind($bind);
        $pull->on('message', array($pusher, $on));

        return $pull;
    }

    private function launchReact($bind, $port, $loop, $pusher)
    {
        $webSock = new React\Socket\Server($loop);
        $webSock->listen($port, $bind);
        $webServer = new Ratchet\Server\IoServer(
            new Ratchet\WebSocket\WsServer(
                new Ratchet\Wamp\WampServer(
                    $pusher
                )
            ),
            $webSock
        );

        return $webServer;
    }

    public function setBrokerBindAddress($bind)
    {
        $this->broker_bind = $bind;
    }

    public function getBrokerBindAddress()
    {
        return $this->broker_bind;
    }

    public function setBrokerOnHandler($on)
    {
        $this->broker_on = $on;
    }

    public function getBrokerOnHandler()
    {
        return $this->broker_on;
    }

    public function setWsBindAddress($bind)
    {
        $this->ws_bind = $bind;
    }

    public function getWsBindAddress()
    {
        return $this->ws_bind;
    }

    public function setWsPort($port)
    {
        $this->ws_port = $port;
    }

    public function getWsPort()
    {
        return $this->ws_port;
    }

    public function setPusher($pusher)
    {
        $this->pusher = $pusher;
    }

    public function getPusher()
    {
        return $this->pusher;
    }
}
