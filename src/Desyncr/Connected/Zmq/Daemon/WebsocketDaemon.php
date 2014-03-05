<?php
/**
 * Desyncr\Connected\Zmq\Daemon
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\Zmq\Daemon
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\Zmq\Daemon;

use React;
use Ratchet;
use Zend\Stdlib\AbstractOptions;
use ZMQ;
use Desyncr\Connected\Zmq\Options\WebsocketDaemonOptions;

/**
 * Class WebsocketDaemon
 *
 * @category General
 * @package  Desyncr\Connected\Zmq\Daemon
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class WebsocketDaemon
{
    /**
     * @var WebsocketDaemonOptions Options
     */
    protected $options;

    /**
     * Construct
     * @param WebsocketDaemonOptions $options
     */
    public function __construct(WebsocketDaemonOptions $options)
    {
        $this->setOptions($options);
    }

    /**
     * execute
     *
     * @param $request
     *
     * @return mixed
     */
    public function execute($request)
    {
        $loop   = React\EventLoop\Factory::create();
        /** @var WebsocketDaemonOptions $options */
        $options = $this->getOptions();

        $pusher = $options->getPusher();
        $pusher = is_string($pusher) ? new $pusher : $pusher;

        $this->launchZeroMQ(
            $options->getBrokerBindAddress(),
            $options->getBrokerOnHandler(),
            $loop,
            $pusher
        );
        $this->launchReact(
            $options->getWsBindAddress(),
            $options->getWsPort(),
            $loop,
            $pusher
        );

        $loop->run();
    }

    /**
     * launchZeroMQ
     *
     * @param $bind
     * @param $on
     * @param $loop
     * @param $pusher
     *
     * @return mixed
     */
    private function launchZeroMQ($bind, $on, $loop, $pusher)
    {
        $context = new React\ZMQ\Context($loop);
        $pull = $context->getSocket(ZMQ::SOCKET_PULL);

        $pull->bind($bind);
        $pull->on('message', array($pusher, $on));

        return $pull;
    }

    /**
     * launchReact
     *
     * @param $bind
     * @param $port
     * @param $loop
     * @param $pusher
     *
     * @return mixed
     */
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

    /**
     * setOptions
     *
     * @param WebsocketDaemonOptions $options Options
     *
     * @return null
     */
    public function setOptions(WebsocketDaemonOptions $options)
    {
        $this->options = $options;
    }

    /**
     * getOptions
     *
     * @return WebsocketDaemonOptions
     */
    public function getOptions()
    {
        return $this->options;
    }
}
