<?php
namespace Desyncr\Connected\Zmq\Daemon;
use React, React\Socket, Ratchet, ZMQ;

class WebsocketDaemon {
    protected $broker_bind = 'tcp://127.0.0.1:5555';
    protected $broker_on = 'onNotification';
    protected $ws_bind = '0.0.0.0';
    protected $ws_port = 8080;

    public function execute($request) {
        $loop   = React\EventLoop\Factory::create();
        $pusher = new PusherDaemon;

        $this->launchZeroMQ($this->broker_bind, $this->broker_on, $loop, $pusher);

        $this->launchReact($this->ws_bind, $this->ws_port, $loop, $pusher);

        $loop->run();
    }

    private function launchZeroMQ($bind, $on, $loop, $pusher) {
        $context = new React\ZMQ\Context($loop);
        $pull = $context->getSocket(ZMQ::SOCKET_PULL);

        $pull->bind($bind);
        $pull->on('message', array($pusher, $on));

        return $pull;
    }

    private function launchReact($bind, $port, $loop, $pusher) {
        $webSock = new React\Socket\Server($loop);
        $webSock->listen($port, $bind);
        $webServer = new Ratchet\Server\IoServer(
            new Ratchet\Http\HttpServer(
                new Ratchet\WebSocket\WsServer(
                    new Ratchet\Wamp\WampServer(
                        $pusher
                    )
                )
            ),
            $webSock
        );

        return $webServer;
    }
}
