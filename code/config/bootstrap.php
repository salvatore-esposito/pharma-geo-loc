<?php
use Symfony\Component\Dotenv\Dotenv;
use Slim\Factory\AppFactory;

/* Dot-env */
$dotenv = new Dotenv();
$dotenv->load(CURRENT_PATH . '.env');

/* Slim and Container*/
$container = new DI\Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

/* Twig */
$cache = strtolower($_ENV['TWIG_CACHE'])!=='false' ? $_ENV['TWIG_CACHE'] : FALSE;

$loader = new \Twig\Loader\FilesystemLoader(CURRENT_PATH .  'src/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => $cache,
    'debug' => $_ENV['TWIG_DEBUG']
]);
$container->set('view' , $twig);
