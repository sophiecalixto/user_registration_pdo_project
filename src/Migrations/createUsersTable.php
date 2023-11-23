<?php

namespace Sophiecalixto\UserRegistrationProject\Migrations;

use PDO;
use Sophiecalixto\UserRegistrationProject\Infrastructure\Persistence\ConnectionFactory;

class createUsersTable
{
    private PDO $connection;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function createUsersTable(): bool
    {
        try {
            $this->connection->exec(
                "CREATE TABLE IF NOT EXISTS users(
                id INTEGER PRIMARY KEY,
                name TEXT,
                email TEXT,
                password TEXT
            )"
            );

            if($this->connection->query("SELECT 1 FROM users LIMIT 1") === false) {
                return false;
            }

            return true;
        } catch (\PDOException $e) {
            return false;
        }

    }
}