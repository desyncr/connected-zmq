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
 * Class ZmqServiceOptions
 *
 * @category General
 * @package  Desyncr\Connected\Zmq\Options
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class ZmqServiceOptions extends AbstractOptions
{
    /**
     * @var
     */
    protected $host;

    /**
     * @var
     */
    protected $port;

    /**
     * @var
     */
    protected $socketType;

    /**
     * @var
     */
    protected $socketName;

    /**
     * setHost
     *
     * @param String $host Host
     *
     * @return mixed
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * getHost
     *
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * setPort
     *
     * @param String $port Port
     *
     * @return mixed
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * getPort
     *
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * getSocketType
     *
     * @return mixed
     */
    public function getSocketType()
    {
        return $this->socketType;
    }

    /**
     * setSocketType
     *
     * @param $type
     *
     * @return null
     */
    public function setSocketType($type)
    {
        $this->socketType = $type;
    }

    /**
     * getSocketName
     *
     * @return String
     */
    public function getSocketName()
    {
        return $this->socketName;
    }

    /**
     * setSocketName
     *
     * @param String $name
     *
     * @return mixed
     */
    public function setSocketName($name)
    {
        $this->socketName = $name;
    }
}
 