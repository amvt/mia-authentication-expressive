<?php

namespace Mobileia\Expressive\Auth\Factory;

use Psr\Container\ContainerInterface;

/**
 * Description of GoogleSignInFactory
 *
 * @author matiascamiletti
 */
class GoogleSignInFactory
{
    public function __invoke(ContainerInterface $container) : \Mobileia\Expressive\Auth\Handler\GoogleSignInHandler
    {
        // Obtenemos configuracion
        $config = $container->get('config')['google'];
        // creamos libreria
        return new \Mobileia\Expressive\Auth\Handler\GoogleSignInHandler($config);
    }
}