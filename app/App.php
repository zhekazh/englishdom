<?php


/**
 * Class App
 */
class App
{
    /**
     * @return string
     */
    public static function getConfigDir()
    {
        return __DIR__.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    public static function getDataDir()
    {
        return realpath(__DIR__.'/../data');
    }

    public static function getConfigDB()
    {
        $configDir = \App::getConfigDir();
        $fileConfigDb = $configDir.'db.php';
        if (file_exists($fileConfigDb)) {
            $config = require_once $fileConfigDb;

            return $config;
        } else {
            throw new \Exception('Config not found');
        }
    }

    public function run()
    {
        $container = new League\Container\Container;

        $container->share('response', Zend\Diactoros\Response::class);
        $container->share(
            'request',
            function () {
                return Zend\Diactoros\ServerRequestFactory::fromGlobals(
                    $_SERVER,
                    $_GET,
                    $_POST,
                    $_COOKIE,
                    $_FILES
                );
            }
        );

        $container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);

        $route = new League\Route\RouteCollection($container);

        $route->map('GET', '/', [new \Controller\IndexController(new \View\View()), 'indexAction']);
        $route->map('POST', '/', [new \Controller\IndexController(new \View\View()), 'handlerAction']);
        $route->map('GET', '/delete', [new \Controller\IndexController(new \View\View()), 'deleteAction']);

        $route->map('GET', '/log', [new \Controller\IndexController(new \View\View()), 'logAction']);

        $route->map('GET', '/install', [new \Controller\IndexController(new \View\View()), 'installAction']);

        $response = $route->dispatch($container->get('request'), $container->get('response'));
        $container->get('emitter')->emit($response);
    }
}