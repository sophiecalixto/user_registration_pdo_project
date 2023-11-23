<?php

namespace Sophiecalixto\UserRegistrationProject\Domain\Repository;

use Sophiecalixto\UserRegistrationProject\Domain\Model\User;

interface UserRepository
{
    public function allUsers(): array;

    public function getUserById(User $user): array;

    public function getUserByEmail(User $user): array;

    public function save(User $user): bool;

    public function remove(User $user): bool;
}
