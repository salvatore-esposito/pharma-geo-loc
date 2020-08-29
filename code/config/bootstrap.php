<?php
define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Slim\Factory\AppFactory;

/* Dot-env */
$dotenv = new Dotenv();
$dotenv->load( BASE_PATH . '/.env' );

/* Slim and Container*/
$container = new DI\Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

/* Twig */
$cache = strtolower($_ENV['TWIG_CACHE'])!=='false' ? $_ENV['TWIG_CACHE'] : FALSE;

$loader = new \Twig\Loader\FilesystemLoader( BASE_PATH .  '/src/templates' );
$twig = new \Twig\Environment($loader, [
    'cache' => $cache,
    'debug' => $_ENV['TWIG_DEBUG']
]);

$function = new \Twig\TwigFunction('assets_path', function ($file) {
    return sprintf("./%s/%s", $_ENV['ASSETS_PATH'], $file);
});
$twig->addFunction($function);

/* set container objects */
$container->set( 'view' , $twig );
$container->set( 'app' , $_ENV );
