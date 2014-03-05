<?php
/**
 * Desyncr\Connected\Zmq\Controller
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\Zmq\Controller
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\Zmq\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;
use Desyncr\Connected\Zmq\Daemon\WebsocketDaemon;

/**
 * Class DaemonController
 *
 * @category General
 * @package  Desyncr\Connected\Zmq\Controller
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class DaemonController extends AbstractActionController
{
    /**
     * executeAction
     *
     * @return mixed
     * @throws \RuntimeException
     */
    public function executeAction()
    {
        $request = $this->getRequest();
        if (!$request instanceof ConsoleRequest) {
            throw new \RuntimeException('You can call this action from web');
        }
        $instance = $this->getServiceLocator()->get(
            'Desyncr\Connected\Zmq\Daemon\WebsocketDaemon'
        );
        $instance->execute($request);
    }
}
