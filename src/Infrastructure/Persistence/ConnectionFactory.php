<?php

namespace Sophiecalixto\UserRegistrationProject\Infrastructure\Persistence;

use PDO;

class ConnectionFactory
{
    public static function createConnection() : PDO
    {
        $absolutePathOfDb = __DIR__ . '../../../db/db.sqlite';
        return new PDO('sqlite:', $absolutePathOfDb);
    }
}