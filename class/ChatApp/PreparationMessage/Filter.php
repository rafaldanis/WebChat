<?php
namespace ChatApp\PreparationMessage;

class Filter
{
    private $msg;

    public function __construct($msg)
    {
        $this->msg = $msg;

        $this->setHtmlentities();
    }
    private function setHtmlentities()
    {
        $this->msg = htmlentities($this->msg);
    }
    public function getMsg():string
    {
        return $this->msg;
    }
}