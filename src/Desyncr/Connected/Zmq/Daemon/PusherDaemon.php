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

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

/**
 * Class PusherDaemon
 *
 * @category General
 * @package  Desyncr\Connected\Zmq\Daemon
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class PusherDaemon implements WampServerInterface
{
    /**
     * A lookup of all the topics clients have subscribed to
     */
    protected $subscribedTopics = array();

    /**
     * onSubscribe
     *
     * @param ConnectionInterface        $conn
     * @param \Ratchet\Wamp\Topic|string $topic
     *
     * @return mixed
     */
    public function onSubscribe(ConnectionInterface $conn, $topic)
    {
        // When a visitor subscribes to a topic link the Topic object in a  lookup array
        if (!array_key_exists($topic->getId(), $this->subscribedTopics)) {
            $this->subscribedTopics[$topic->getId()] = $topic;
        }
    }

    /**
     * @param string JSON'ified string we'll receive from ZeroMQ
     */
    public function onNotification($entry)
    {
        $entryData = json_decode($entry, true);
        $channel = $entryData['id'];
        if (array_key_exists($channel, $this->subscribedTopics)) {
            $topic = $this->subscribedTopics[$channel];
            $topic->broadcast($entryData);
        }

    }

    /**
     * onCall
     *
     * @param ConnectionInterface        $conn
     * @param string                     $id
     * @param \Ratchet\Wamp\Topic|string $topic
     * @param array                      $params
     *
     * @return mixed
     */
    public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
    }

    /**
     * onPublish
     *
     * @param ConnectionInterface        $conn
     * @param \Ratchet\Wamp\Topic|string $topic
     * @param string                     $event
     * @param array                      $exclude
     * @param array                      $eligible
     *
     * @return mixed
     */
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        $conn->close();
    }

    /**
     * onUnSubscribe
     *
     * @param ConnectionInterface        $conn
     * @param \Ratchet\Wamp\Topic|string $topic
     *
     * @return mixed
     */
    public function onUnSubscribe(ConnectionInterface $conn, $topic)
    {
    }

    /**
     * onOpen
     *
     * @param ConnectionInterface $conn
     *
     * @return mixed
     */
    public function onOpen(ConnectionInterface $conn)
    {
    }

    /**
     * onClose
     *
     * @param ConnectionInterface $conn
     *
     * @return mixed
     */
    public function onClose(ConnectionInterface $conn)
    {
    }

    /**
     * onError
     *
     * @param ConnectionInterface $conn
     * @param \Exception          $e
     *
     * @return mixed
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
    }
}
