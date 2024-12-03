<?php

namespace Config;

use MongoDB\Client;

class MongoDB
{
    public static function connect()
    {
        $client = new Client('mongodb://localhost:27017');
        return $client->selectDatabase('restaurant_reservation');
    }
}
