<?php

require '../vendor/autoload.php';

use Sophiecalixto\UserRegistrationProject\Domain\Model\User;
use Sophiecalixto\UserRegistrationProject\Infrastructure\Persistence\ConnectionFactory;
use Sophiecalixto\UserRegistrationProject\Infrastructure\Repository\PdoUserRepository;
use Sophiecalixto\UserRegistrationProject\Migrations\createUsersTable;

$connectionPdo = ConnectionFactory::createConnection();

echo 'Sucessfully created connection' . PHP_EOL;

$usersTable = new createUsersTable($connectionPdo);
$usersTable->createUsersTable();

echo 'Success to create users table' . PHP_EOL;

// Creating users

$userRepository = new PdoUserRepository($connectionPdo);

$connectionPdo->beginTransaction();

try {

    $user1 = new User(null, 'user 1', 'user1@test.com', '123456');
    $userRepository->save($user1, '123456');
    $user2 = new User(null, 'user 2', 'user2@test.com', '123456');
    $userRepository->save($user2, '123456');
    $user3 = new User(null, 'user 3', 'user3@test.com', '123456');
    $userRepository->save($user3, '123456');

    $connectionPdo->commit();
} catch (\PDOException $e) {
    echo $e->getMessage();
    $connectionPdo->rollback();
}

$userRepository->removeById(3);
var_dump($userRepository->allUsers());
var_dump($userRepository->getUserById(1));
var_dump($userRepository->getUserByEmail('user2@test.com'));