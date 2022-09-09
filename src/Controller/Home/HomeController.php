<?php
declare(strict_types=1);

namespace src\Controller\Home;

use lib\Controller\AbstractController;
use src\Helper\Redirect;
use src\Model\Project\Mapper\ProjectContainer;
use src\Service\HomeController\HomeControllerService;

class HomeController extends AbstractController
{
    public function home(): void
    {
        $service = new HomeControllerService();
        $projects = ProjectContainer::getInstance()?->findBy([]);

        $this->render(
            'home/home',
            [
                'renderWithBasicBody' => true,
                'tableFields' => $service->buildTableBody($projects)
            ]
        );
    }

    public function redirectAction(): void
    {
        Redirect::to('/login');
    }
}