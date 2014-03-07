<?php
/**
 * Desyncr\Connected\Zmq\Options
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\Zmq\Options
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\Zmq\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Class WebsocketDaemonOptions
 *
 * @category General
 * @package  Desyncr\Connected\Zmq\Options
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class WebsocketDaemonOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $broker_bind = 'tcp://127.0.0.1:5555';

    /**
     * @var string
     */
    protected $broker_on = 'onNotification';

    /**
     * @var string
     */
    protected $ws_bind = '0.0.0.0';

    /**
     * @var int
     */
    protected $ws_port = 8080;

    /**
     * @var string
     */
    protected $pusher = 'Desyncr\Connected\Zmq\Daemon\PusherDaemon';

    /**
     * setBrokerBindAddress
     *
     * @param $bind
     *
     * @return mixed
     */
    public function setBrokerBind($bind)
    {
        $this->broker_bind = $bind;
    }

    /**
     * getBrokerBindAddress
     *
     * @return mixed
     */
    public function getBrokerBind()
    {
        return $this->broker_bind;
    }

    /**
     * setBrokerOnHandler
     *
     * @param $on
     *
     * @return mixed
     */
    public function setBrokerOn($on)
    {
        $this->broker_on = $on;
    }

    /**
     * getBrokerOnHandler
     *
     * @return mixed
     */
    public function getBrokerOn()
    {
        return $this->broker_on;
    }

    /**
     * setWsBindAddress
     *
     * @param $bind
     *
     * @return mixed
     */
    public function setWsBind($bind)
    {
        $this->ws_bind = $bind;
    }

    /**
     * getWsBindAddress
     *
     * @return mixed
     */
    public function getWsBind()
    {
        return $this->ws_bind;
    }

    /**
     * setWsPort
     *
     * @param $port
     *
     * @return mixed
     */
    public function setWsPort($port)
    {
        $this->ws_port = $port;
    }

    /**
     * getWsPort
     *
     * @return mixed
     */
    public function getWsPort()
    {
        return $this->ws_port;
    }

    /**
     * setPusher
     *
     * @param $pusher
     *
     * @return mixed
     */
    public function setPusher($pusher)
    {
        $this->pusher = $pusher;
    }

    /**
     * getPusher
     *
     * @return mixed
     */
    public function getPusher()
    {
        return $this->pusher;
    }
}
 