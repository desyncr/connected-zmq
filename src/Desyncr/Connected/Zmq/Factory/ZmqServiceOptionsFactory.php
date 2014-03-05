<?php
/**
 * Desyncr\Connected\Zmq\Factory
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\Zmq\Factory
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\Zmq\Factory;

use Desyncr\Connected\Zmq\Options\ZmqServiceOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ZmqServiceOptionsFactory
 *
 * @category General
 * @package  Desyncr\Connected\Zmq\Factory
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class ZmqServiceOptionsFactory implements FactoryInterface
{
    /**
     * createService
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $configuration = $serviceLocator->get('Config');
        return new ZmqServiceOptions($configuration['connected']['zmq']['socket']);
    }
}
 