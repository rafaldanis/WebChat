<?php
namespace ChatApp\CheckMessage;

class Check
{
    public function getNick($msg, $users)
    {
        $nick = $this->getNickFromMessage($msg, $users);

        if ($nick) {
            return $nick;
        }

        return null;
    }

    private function getNickFromMessage(string $msg, array $users)
    {
        preg_match('/@[a-zA-Z0-9\.\-_]*/', $msg, $nick);
        if ($nick) {
            foreach ($users as $i => $user) {
                if ($user == str_replace('@', '', $nick[0])) {
                    return $i;
                }
            }
        } else {
            return null;
        }
    }
}