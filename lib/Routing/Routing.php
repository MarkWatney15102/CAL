<?php
declare(strict_types=1);

namespace lib\Routing;

use Bramus\Router\Router;
use lib\Controller\AbstractController;
use lib\Database\Database;
use src\Helper\Redirect;
use src\Service\Auth\AuthService;

class Routing
{
    private Router $router;
    private RoutesImp $routes;
    private AuthService $authService;

    public function __construct(private readonly Database $database)
    {
        $this->router = new Router();
        $this->routes = new RoutesImp();
        $this->authService = new AuthService();
    }

    public function init(): void
    {
        /** @var Route[] $routes */
        $routes = $this->routes->getRoutes();

        foreach ($routes as $route) {
            if ($route instanceof Route) {
                $method = $route->getMethod()->method();
                $this->router->$method($route->getUri(), function (...$args) use ($route) {
                    $access = $this->authService->isLoggedInOrNoLoginRequired($route->isRequiresLogin(), $route->getLevel());

                    if (empty($access->redirect())) {
                        $action = $route->getAction();
                        $controllerClass = $route->getController();
                        $controller = new $controllerClass();
                        if ($controller instanceof AbstractController) {
                            $controller->setDatabase($this->database);
                            $controller->setUrlParams($args ?? []);
                            $controller->$action();
                        }
                    } else {
                        Redirect::to($access->redirect());
                    }
                });
            }
        }

        $this->router->run();
    }
}