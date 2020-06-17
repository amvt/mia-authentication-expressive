<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mobileia\Expressive\Auth\Factory;

use Psr\Container\ContainerInterface;

/**
 * Description of GoogleSignInFactory
 *
 * @author matiascamiletti
 */
class AppleSignInFactory
{
    public function __invoke(ContainerInterface $container) : \Mobileia\Expressive\Auth\Handler\AppleSignInHandler
    {
        // Obtenemos configuracion
        $config = $container->get('config')['apple'];
        // creamos libreria
        return new \Mobileia\Expressive\Auth\Handler\AppleSignInHandler($config);
    }
}