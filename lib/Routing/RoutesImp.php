<?php
declare(strict_types=1);

namespace lib\Routing;

use lib\Auth\Level;
use src\Controller\Access\AccessController;
use src\Controller\Dashboard\DashboardController;
use src\Controller\Home\HomeController;
use src\Controller\Job\JobController;
use src\Controller\Job\JobHistoryController;
use src\Controller\Login\LoginController;
use src\Controller\Project\ProjectController;
use src\Controller\Task\Order\OrderController;
use src\Controller\Task\TaskController;
use src\Controller\User\ProfileController;

class RoutesImp
{
    /**
     * @var Route[]
     */
    private array $routes;

    public function __construct()
    {
        $this->routes[] = new Route(
            '/no-access',
            AccessController::class,
            'noAccess',
            RouteMethod::GET,
            Level::NO_LEVEL->getLevel(),
            false
        );
        $this->routes[] = new Route(
            '/',
            HomeController::class,
            'redirectAction',
            RouteMethod::GET,
            Level::NO_LEVEL->getLevel(),
            false
        );
        $this->routes[] = new Route(
            '/home',
            HomeController::class,
            'redirectAction',
            RouteMethod::GET,
            Level::NO_LEVEL->getLevel(),
            false
        );
        $this->routes[] = new Route(
            '/login',
            LoginController::class,
            'login',
            RouteMethod::GET,
            Level::NO_LEVEL->getLevel(),
            false
        );
        $this->routes[] = new Route(
            '/logout',
            LoginController::class,
            'logoutAction',
            RouteMethod::GET,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/login',
            LoginController::class,
            'tryLogin',
            RouteMethod::POST,
            Level::NO_LEVEL->getLevel(),
            false
        );
        $this->routes[] = new Route(
            '/dashboard',
            DashboardController::class,
            'dashboardAction',
            RouteMethod::GET,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/projects',
            HomeController::class,
            'home',
            RouteMethod::GET,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/project/(\w+)',
            ProjectController::class,
            'project',
            RouteMethod::GET,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/project/(\w+)',
            ProjectController::class,
            'saveProject',
            RouteMethod::POST,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/project/(\d+)/summary',
            ProjectController::class,
            'summaryAction',
            RouteMethod::GET,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/task/(\d+)/(\d+)',
            TaskController::class,
            'taskAction',
            RouteMethod::GET,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/task/(\d+)/(\d+)',
            TaskController::class,
            'saveTaskAction',
            RouteMethod::POST,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/task/(\d+)/work-card',
            TaskController::class,
            'taskWorkCardAction',
            RouteMethod::GET,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/order/(\d+)/(\d+)',
            OrderController::class,
            'orderAction',
            RouteMethod::GET,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/order/list/load',
            OrderController::class,
            'loadOrdersAction',
            RouteMethod::POST,
            Level::NO_LEVEL->getLevel(),
            false
        );
        $this->routes[] = new Route(
            '/task/(\d+)/new-resource',
            TaskController::class,
            'createNewResourceAction',
            RouteMethod::POST,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/task/(\d+)/save-resource',
            TaskController::class,
            'editResourceAction',
            RouteMethod::POST,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/task/(\d+)/delete-resource',
            TaskController::class,
            'deleteResourceAction',
            RouteMethod::POST,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/order/(\d+)/(\d+)',
            OrderController::class,
            'saveAction',
            RouteMethod::POST,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/profile',
            ProfileController::class,
            'profileAction',
            RouteMethod::GET,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/profile',
            ProfileController::class,
            'saveAction',
            RouteMethod::POST,
            Level::WORKER->getLevel(),
            true
        );
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}