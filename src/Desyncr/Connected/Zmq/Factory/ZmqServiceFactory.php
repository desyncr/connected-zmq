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

use Desyncr\Connected\Factory\AbstractServiceFactory;
use Desyncr\Connected\Zmq\Service\ZmqService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ZmqServiceFactory
 *
 * @category General
 * @package  Desyncr\Connected\Zmq\Factory
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class ZmqServiceFactory extends AbstractServiceFactory implements
    FactoryInterface
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
        $zmq = $serviceLocator->get(
            'Desyncr\Connected\Zmq\Client\ZmqClient'
        );
        /** @var \Zend\Stdlib\AbstractOptions $options */
        $options = $serviceLocator->get(
            'Desyncr\Connected\Zmq\Options\ZmqServiceOptions'
        );

        return new ZmqService($zmq, $options);
    }
}
