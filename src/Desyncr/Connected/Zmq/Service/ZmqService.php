<?php
/**
 * Desyncr\Connected\Zmq\Service
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\Zmq\Service
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\Zmq\Service;

use Desyncr\Connected\Service\AbstractService;
use Desyncr\Connected\Zmq\Options\ZmqServiceOptions;

/**
 * Class ZmqService
 *
 * @category General
 * @package  Desyncr\Connected\Zmq\Service
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class ZmqService extends AbstractService
{
    /**
     * @var Object
     */
    protected $context = null;

    /**
     * @var Object
     */
    protected $socket = null;

    /**
     * @var
     */
    protected $options;

    /**
     * @var array
     */
    protected $frames = array();

    /**
     * Constructor
     *
     * @param Object            $zmq     ZMQContext
     * @param ZmqServiceOptions $options Options
     */
    public function __construct($zmq, ZmqServiceOptions $options)
    {
        $this->setOptions($options);

        $socketType = $options->getSocketType();
        $socketName = $options->getSocketName();
        $socket = $zmq->getSocket($socketType, $socketName);

        $this->setSocket($socket);
        $this->setContext($zmq);
    }

    /**
     * dispatch
     *
     * @return mixed
     * @throws \Exception
     */
    public function dispatch()
    {
        if ($this->getSocket()->connect($this->getAddress())) {
            foreach ($this->frames as $frame) {
                if (is_object($frame)) {
                    $frame = json_encode($frame->serialize());
                }
                $this->getSocket()->send($frame);
            }

            $this->frames = array();

        } else {
            throw new \Exception('Couldn\'t connect with socket server');
        }

    }

    /**
     * setContext
     *
     * @param Object $context Context object
     *
     * @return mixed
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

    /**
     * getContext
     *
     * @return Object
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * setSocket
     *
     * @param Object $socket
     *
     * @return null
     */
    public function setSocket($socket)
    {
        $this->socket = $socket;
    }

    /**
     * getSocket
     *
     * @return Object
     */
    public function getSocket()
    {
        return $this->socket;
    }

    /**
     * getAddress
     *
     * @return mixed
     */
    public function getAddress()
    {
        /** @var ZmqServiceOptions $options */
        $options = $this->getOptions();
        return $options->getHost() . ':' . $options->getPort();
    }

    /**
     * getOptions
     *
     * @return Object
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * setOptions
     *
     * @param ZmqServiceOptions $options Options
     *
     * @return null
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * add
     *
     * @param Object $frame  Frame
     * @param String $key    Key
     *
     * @return mixed|void
     */
    public function add($key, $frame)
    {
        array_push($this->frames, $frame);
    }
}
