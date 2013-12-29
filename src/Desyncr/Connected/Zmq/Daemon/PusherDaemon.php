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

        if (!isset($entryData['targets'])) {
            if (array_key_exists($channel, $this->subscribedTopics)) {
                $topic = $this->subscribedTopics[$channel];
                $topic->broadcast($entryData);
            }

            return;
        }
        foreach ($entryData['targets']['id'] as $target) {
            $chan = $channel . $this->sessions[$target];
            if (array_key_exists($chan, $this->subscribedTopics)) {
                $topic = $this->subscribedTopics[$chan];
                $topic->broadcast($entryData);
            }
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
        // In this application if clients send data it's because the user hacked around in console
        // $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
        if (!is_array($params) || !isset($params[0]) || !isset($params[1])) {
            $conn->callError($id, $topic, 'Wrong number of arguments')->close();

            return;
        }
        $this->sessions[$params[1]] = $params[0];
        $conn->callResult($id, array('session' => $params[0], 'user' => $params[1], 'id' => $id));
    }
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        // In this application if clients send data it's because the user hacked around in console
        $conn->close();
    }
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
    }
}
