<?php

namespace Sophiecalixto\UserRegistrationProject\Domain\Repository;

use Sophiecalixto\UserRegistrationProject\Domain\Model\User;

interface UserRepository
{
    public function allUsers(): array;

    public function getUserById(int $id): array;

    public function getUserByEmail(string $email): array;

    public function save(User $user, string $userPassword): bool;

    public function remove(User $user): bool;
}
