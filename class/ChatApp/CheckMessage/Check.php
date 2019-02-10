<?php
namespace ChatApp\CheckMessage;

class Check
{

    public function getNick($msg, $users)
    {
        $nicks = $this->getNickFromMessage($msg, $users);
        if (is_array($nicks) && count($nicks) > 0) {
            return $nicks;
        }

        return null;
    }

    private function getNickFromMessage(string $msg, array $users)
    {
        preg_match_all('/@[a-zA-Z0-9ąęółśążźćńĄĘÓŁŚĄŻŹĆŃ\.\-_]*/', $msg, $nick);
        if (is_array($nick[0]) && count($nick[0]) > 0) {
            foreach ($nick[0] as $n) {
                echo "\n dodaje do tablicy \n";
                $nicks[] = str_replace('@', '', $n);
            }
            return $nicks;
        }
        return null;
    }
}