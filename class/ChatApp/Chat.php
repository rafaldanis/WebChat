<?php
namespace ChatApp;


use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    public $clients;
    private $logs;
    private $connectedUsers;
    private $connectedUsersNames;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->logs = [];
        $this->connectedUsers = [];
        $this->connectedUsersNames = [];
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        $conn->send(json_encode($this->logs));
        $this->connectedUsers [$conn->resourceId] = $conn;
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        //użytkownik istnieje
        if (isset($this->connectedUsersNames[$from->resourceId])) {
	   echo "\n" . $this->connectedUsersNames[$from->resourceId] . ' : ' . $msg;

            $this->logs = [];
            $this->logs[] = array(
                "user" => $this->connectedUsersNames[$from->resourceId],
                "msg" => $msg,
                "all_users" => $this->connectedUsersNames,
                "timestamp" => time()
            );
            $this->sendMessage($this->logs);
        } else {
            //użytkownik nie istnieje, świeżo zalogowany
            echo "\nZalogował się: " . $msg;
            $this->connectedUsersNames[$from->resourceId] = $msg;
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        unset($this->connectedUsersNames[$conn->resourceId]);
        unset($this->connectedUsers[$conn->resourceId]);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }

    private function sendMessage($message) {
        foreach ($this->connectedUsers as $user) {
            $user->send(json_encode($message));
        }
    }
}
