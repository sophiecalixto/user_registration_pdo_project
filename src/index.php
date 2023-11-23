<?php

require '../vendor/autoload.php';

use Sophiecalixto\UserRegistrationProject\Infrastructure\Persistence\ConnectionFactory;

$connectionPdo = ConnectionFactory::createConnection();

echo 'Sucessfully created connection';