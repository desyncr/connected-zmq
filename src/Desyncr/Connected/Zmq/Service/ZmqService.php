<?php
namespace Desyncr\Connected\Zmq\Service;
use Desyncr\Connected\Service as Connected;

class ZmqService extends Connected\AbstractService {
    protected $context = null;
    protected $socket = null;
    protected $host = 'tcp://127.0.0.1';
    protected $port = 5555;
    protected $socket_name = 'websocket-pusher';
    protected $socket_type = \ZMQ::SOCKET_PUSH;

    public function __construct() {
        $this->context = new \ZMQContext();
        $this->socket = $this->context->getSocket($this->socket_type, $this->socket_name);

        $this->addr = "$this->host:$this->port";
    }

    public function dispatch() {

        if ($this->socket->connect($this->addr)) {

            foreach ($this->frames as $frame) {
                $this->socket->send($frame->serialize());
            }

        } else {
            throw new \Exception('Couldn\'t connect with socket server');
        }

    }

}
