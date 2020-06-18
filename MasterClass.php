<?php

class MasterClass
{
    private $host = '127.0.0.1';
    private $user = 'root';
    private $pass = '';
    private $database = 'webtest';

    public function connectionDB()
    {
        return new mysqli($this->host,$this->user,$this->pass,$this->database);
    }
}