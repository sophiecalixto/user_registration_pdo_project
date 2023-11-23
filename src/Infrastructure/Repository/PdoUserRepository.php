<?php

namespace Sophiecalixto\UserRegistrationProject\Infrastructure\Repository;

use PDO;
use Sophiecalixto\UserRegistrationProject\Domain\Model\User;
use Sophiecalixto\UserRegistrationProject\Domain\Repository\UserRepository;

class PdoUserRepository implements UserRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }


    public function allUsers(): array
    {
        $statement = $this->connection->query("SELECT * FROM users");
        return $this->hydrateUserList($statement);
    }

    public function getUserById(int $id): array
    {
        $statement = $this->connection->prepare("SELECT * FROM users WHERE id = ?");
        $statement->bindValue(1, $id);
        $statement->execute();
        return $this->hydrateUserList($statement);
    }

    public function getUserByEmail(string $email): array
    {
        $statement = $this->connection->prepare("SELECT * FROM users WHERE email = ?");
        $statement->bindValue(1, $email);
        $statement->execute();
        return $this->hydrateUserList($statement);
    }

    public function save(User $user, string $userPassword): bool
    {
        $statement = $this->connection->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        return $statement->execute(
            [
                ':name' => $user->getName(),
                ':email' => $user->getEmail(),
                ':password' => $userPassword,
            ]
        );
    }

    public function remove(User $user): bool
    {
        $statement = $this->connection->prepare("DELETE FROM users WHERE id = ?");
        return $statement->execute(
            [
                $user->getId(),
            ]
        );
    }

    public function removeById(int $id): bool
    {
        $statement = $this->connection->prepare("DELETE FROM users WHERE id = ?");
        return $statement->execute(
            [
                $id,
            ]
        );
    }

    private function hydrateUserList(\PDOStatement $statement): array
    {
        $userDataList = $statement->fetchAll();
        $userList = [];

        foreach ($userDataList as $user) {
            $userList[] = new User(
                $user['id'],
                $user['name'],
                $user['email'],
                $user['password']
            );
        }

        return $userList;
    }
}
