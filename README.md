# MobileIA Authentication Expressive
Libreria para autenticar usando MobileIA Lab.

1. Incluir libreria:
```bash
composer require mobileia/auth
composer require mobileia/mia-core-expressive
composer require mobileia/mia-authentication-expressive
```
2. Incluir configuración en el archivo: "config/config.php"
```php
// Configurar Modulo Mobileia Auth
\Mobileia\Expressive\Auth\ConfigProvider::class,

// Default App module config
//App\ConfigProvider::class,
```
3. Crear archivo de configuracion: "config/autoload/mobileia-lab.global.php":
```php
return [
    'mobileia_lab' => [
        'app_id'     => 453,
        'app_secret' => '$2y$10$T/3fjkJHSlsh2/dsdsdaSASa.ZTCmp:/hQdsaFTf6/p.'
    ]
];
```
4. Agregar validación a un router:
```php
$app->route('/api/home', [
        \Mobileia\Expressive\Auth\Handler\AuthHandler::class,
        App\Handler\HomePageHandler::class], ['GET', 'POST'], 'home');
```
5. Obtener datos del usuario en el handler:
```php
$user = $request->getAttribute(\Mobileia\Expressive\Auth\Model\MIAUser::class);
```