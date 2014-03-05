<?php
/**
 * Desyncr\Connected\Zmq
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\Zmq
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\Zmq;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * Class Module
 *
 * @category General
 * @package  Desyncr\Connected\Zmq
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ServiceProviderInterface
{
    /**
     * getAutoloaderConfig
     *
     * @return mixed
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespace' => array(__NAMESPACE__ => __DIR__)
            )
        );
    }

    /**
     * getConfig
     *
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../../../config/module.config.php';
    }

    /**
     * getServiceConfig
     *
     * @return mixed
     */
    public function getServiceConfig()
    {
        return array(
            'host' => 'tcp://127.0.0.1',
            'port' => 5555
        );
    }
}
