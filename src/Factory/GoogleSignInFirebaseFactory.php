<?php

namespace Mobileia\Expressive\Auth\Factory;

use Psr\Container\ContainerInterface;

/**
 * Description of GoogleSignInFirebaseFactory
 *
 * @author matiascamiletti
 */
class GoogleSignInFirebaseFactory
{
    public function __invoke(ContainerInterface $container) : \Mobileia\Expressive\Auth\Handler\GoogleSignInHandler
    {
        // Obtenemos configuracion
        $config = $container->get('config')['google'];
        // creamos libreria
        return new \Mobileia\Expressive\Auth\Handler\GoogleSignInFirebaseHandler($config);
    }
}