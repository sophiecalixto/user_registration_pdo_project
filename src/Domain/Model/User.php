<?php

namespace Sophiecalixto\UserRegistrationProject\Domain\Model;

class User
{
    private ?int $id;
    private string $name;
    private string $email;
    private string $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function changePassword(string $currentPassword, string $newPassword) : bool
    {
        if($this->password == $currentPassword) {
            $this->password = $newPassword;
            return true;
        }

        return false;
    }

    public function changeEmail(string $currentEmail, string $newEmail) : bool
    {
        if($this->email == $currentEmail) {
            $this->email = $newEmail;
            return true;
        }

        return false;
    }

    public function changeName(string $name) : bool
    {
        if($this->name = $name) {
            return true;
        }

        return false;
    }

}