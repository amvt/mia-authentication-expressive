<?php 

declare(strict_types=1);

namespace Mobileia\Expressive\Auth\Factory;

use Psr\Container\ContainerInterface;

class MobileiaAuthFactory 
{
    public function __invoke(ContainerInterface $container) : \MobileIA\Auth\MobileiaAuth
    {
        // Obtenemos configuracion
        $config = $container->get('config')['mobileia_lab'];
        // creamos libreria
        return new \MobileIA\Auth\MobileiaAuth($config['app_id'], $config['app_secret']);
    }
}