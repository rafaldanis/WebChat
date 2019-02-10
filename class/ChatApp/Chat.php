<?php
namespace ChatApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    public $clients;
    private $logs;
    private $connectedUsers;
    private $connectedUsersNames;
    private $checkMessage;
    private $preparationMessage;
    private $connectedUsersId;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->logs = [];
        $this->connectedUsers = [];
        $this->connectedUsersNames = [];
        $this->connectedUsersId = [];
        $this->checkMessage = new CheckMessage\Check;
        $this->preparationMessage = new PreparationMessage\Preparation;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $conn->send(json_encode($this->logs));
        $this->connectedUsers [$conn->resourceId] = $conn;
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        //użytkownik istnieje
        if (isset($this->connectedUsersNames[$from->resourceId])) {
            echo "\n" . $this->connectedUsersNames[$from->resourceId] . ' : ' . $msg;

            $this->logs = array(
                "user" => $this->connectedUsersNames[$from->resourceId],
                "user_id" => $from->resourceId,
                "msg" => $this->preparationMessage->start($msg),
                "all_users" => $this->connectedUsersNames,
                "timestamp" => time(),
                "nick" => $this->checkMessage->getNick($msg, $this->connectedUsersNames),
            );
           
            $this->sendMessage($this->logs, null);
        } else {
            //użytkownik nie istnieje, świeżo zalogowany
            echo "\nZalogował się: " . $msg;
            $this->connectedUsersId[$msg] = $from->resourceId;
            $this->connectedUsersNames[$from->resourceId] = $msg;
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        unset($this->connectedUsersId[$this->connectedUsersNames[$conn->resourceId]]);
        unset($this->connectedUsersNames[$conn->resourceId]);
        unset($this->connectedUsers[$conn->resourceId]);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }

    private function sendMessage(array $message)
    {
        $jsonMessage = json_encode(array($message));
        if (!$message['nick']) {
            foreach ($this->connectedUsers as $i => $user) {
                $user->send($jsonMessage);
            }
        } else {
            foreach ($message['nick'] as $nick) {
                if (isset($this->connectedUsersId[$nick])) {
                    $this->connectedUsers[$this->connectedUsersId[$nick]]->send($jsonMessage);
                }
            }
            $this->connectedUsers[$message['user_id']]->send($jsonMessage);
        }
    }
}
