<?php

declare(strict_types=1);

namespace Mobileia\Expressive\Auth\Factory;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;

class AuthHandlerFactory
{
    public function __invoke(ContainerInterface $container) : \Mobileia\Expressive\Auth\Handler\AuthHandler
    {
        // Creamos servicio
        $service   = $container->get(\MobileIA\Auth\MobileiaAuth::class);
        // Generamos el handler
        return new \Mobileia\Expressive\Auth\Handler\AuthHandler($service);
    }
}
