<?php

namespace Desyncr\Connected\Zmq\Daemon;

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class PusherDaemon implements WampServerInterface
{
    protected $sessions = null;

    /**
     * A lookup of all the topics clients have subscribed to
     */
    protected $subscribedTopics = array();

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
        if (array_key_exists($channel, $subscribedTopics)) {
            $topic = $subscribedTopics[$channel];
            $topic->broadcast($entryData);
        }

    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic)
    {
    }

    public function onOpen(ConnectionInterface $conn)
    {
    }

    public function onClose(ConnectionInterface $conn)
    {
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        $conn->close();
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
    }
}
