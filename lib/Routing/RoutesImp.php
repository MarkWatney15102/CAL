<?php
declare(strict_types=1);

namespace lib\Routing;

use lib\Auth\Level;
use src\Controller\Access\AccessController;
use src\Controller\Admin\AccessControl\AccessControlGroupController;
use src\Controller\Admin\AccessControl\AccessControlPermissionController;
use src\Controller\Admin\AccessControl\AccessControlRoleController;
use src\Controller\Admin\AdminDashboardController;
use src\Controller\Admin\User\UserEditController;
use src\Controller\Api\ApiController;
use src\Controller\Dashboard\DashboardController;
use src\Controller\Home\HomeController;
use src\Controller\Job\JobController;
use src\Controller\Job\JobHistoryController;
use src\Controller\Login\LoginController;
use src\Controller\Migration\MigrationController;
use src\Controller\Project\ProjectController;
use src\Controller\Storage\StorageController;
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
            '/migration/run',
            MigrationController::class,
            'runMigrationAction',
            RouteMethod::GET,
            Level::ADMIN->getLevel(),
            true
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

        // Admin
        $this->routes[] = new Route(
            '/admin/dashboard',
            AdminDashboardController::class,
            'adminDashboardAction',
            RouteMethod::GET,
            Level::ADMIN->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/admin/user/create',
            UserEditController::class,
            'createUserAction',
            RouteMethod::GET,
            Level::ADMIN->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/admin/user/create',
            UserEditController::class,
            'saveUserAction',
            RouteMethod::POST,
            Level::ADMIN->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/admin/user/edit/(\d+)',
            UserEditController::class,
            'editUserAction',
            RouteMethod::GET,
            Level::ADMIN->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/admin/user/edit/(\d+)',
            UserEditController::class,
            'saveUserAction',
            RouteMethod::POST,
            Level::ADMIN->getLevel(),
            true
        );

        // Start Role
        $this->routes[] = new Route(
            '/admin/ac/role',
            AccessControlRoleController::class,
            'roleAction',
            RouteMethod::GET,
            Level::ADMIN->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/admin/ac/role/edit/(\d+)',
            AccessControlRoleController::class,
            'editRoleAction',
            RouteMethod::GET,
            Level::ADMIN->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/admin/ac/role/edit/(\d+)',
            AccessControlRoleController::class,
            'saveRoleAction',
            RouteMethod::POST,
            Level::ADMIN->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/admin/ac/role/group/change',
            AccessControlRoleController::class,
            'changeGroupAction',
            RouteMethod::POST,
            Level::ADMIN->getLevel(),
            true
        );
        // End Role

        // Start Group
        $this->routes[] = new Route(
            '/admin/ac/group',
            AccessControlGroupController::class,
            'groupAction',
            RouteMethod::GET,
            Level::ADMIN->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/admin/ac/group/edit/(\d+)',
            AccessControlGroupController::class,
            'editGroupAction',
            RouteMethod::GET,
            Level::ADMIN->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/admin/ac/group/edit/(\d+)',
            AccessControlGroupController::class,
            'saveGroupAction',
            RouteMethod::POST,
            Level::ADMIN->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/admin/ac/group/permission/change',
            AccessControlGroupController::class,
            'changePermissionAction',
            RouteMethod::POST,
            Level::ADMIN->getLevel(),
            true
        );
        // End Group

        // Start Permission
        $this->routes[] = new Route(
            '/admin/ac/permission',
            AccessControlPermissionController::class,
            'permissionAction',
            RouteMethod::GET,
            Level::ADMIN->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/admin/ac/permission/edit/(\d+)',
            AccessControlPermissionController::class,
            'editPermissionAction',
            RouteMethod::GET,
            Level::ADMIN->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/admin/ac/permission/edit/(\d+)',
            AccessControlPermissionController::class,
            'savePermissionAction',
            RouteMethod::POST,
            Level::ADMIN->getLevel(),
            true
        );
        // End Permission

        // Start Storage
        $this->routes[] = new Route(
            '/storage',
            StorageController::class,
            'listStoragePlacesAction',
            RouteMethod::GET,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/storage/place/(\d+)',
            StorageController::class,
            'storagePlaceAction',
            RouteMethod::GET,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/storage/place/(\d+)',
            StorageController::class,
            'saveStoragePlaceAction',
            RouteMethod::POST,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/storage/items',
            StorageController::class,
            'itemAction',
            RouteMethod::GET,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/storage/item/(\d+)',
            StorageController::class,
            'editItemAction',
            RouteMethod::GET,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/storage/item/(\d+)',
            StorageController::class,
            'saveStorageItemAction',
            RouteMethod::POST,
            Level::WORKER->getLevel(),
            true
        );
        // End Storage

        $this->routes[] = new Route(
            '/api/storage/bookout',
            ApiController::class,
            'bookoutStorageItemAction',
            RouteMethod::POST,
            Level::WORKER->getLevel(),
            true
        );
        $this->routes[] = new Route(
            '/api/storage/bookin',
            ApiController::class,
            'bookinStorageItemAction',
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