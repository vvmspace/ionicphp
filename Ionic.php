<?php

namespace App;

use ElephantIO\Engine\SocketIO\Version2X;
use ElephantIO\Client as EClient;


class Ionic
{
    private $eclient;

    function __construct($host = 'http://localhost:7070')
    {
        $this->eclient = new EClient(new Version2X($host));
        $this->eclient->initialize();
    }

    function __destruct()
    {
        $this->eclient->close();
    }

    static function Action(String $event, $data = [], $host = 'http://localhost:7070'){
        $ionic = new Ionic($host);
        $ionic->impulse($event, $data);
    }

    function impulse(String $event, $data = []){
        $this->eclient->emit('data', [
           'event' => $event,
           'data' => $data
        ]);
    }
}