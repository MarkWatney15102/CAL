<?php

use lib\Controller\AbstractController;

class BillsController extends AbstractController
{
    public function listBillsAction(): void
    {
        $service = new BillsControllerService();
        $bills = BillContainer::getInstance()?->findBy([]);

        $this->render(
            'bill/bills',
            [
                'renderWithBasicBody' => true,
                'tableFields' => $service->buildTableBody($bills)
            ]
        );
    }
}