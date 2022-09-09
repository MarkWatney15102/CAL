<?php

namespace src\Controller\Task\Order;

use lib\Controller\AbstractController;
use lib\Message\Message;
use lib\Message\MessageGroup;
use src\Form\Task\Order\OrderFormFactory;
use src\Model\Order\Mapper\OrderContainer;
use src\Model\Order\Order;

class OrderController extends AbstractController
{
    public function orderAction(): void
    {
        $taskId = (int)$this->urlParams[0];
        $orderId = (int)$this->urlParams[1];

        if ($taskId > 0) {
            if ($orderId !== 0) {
                $this->editOrder($taskId, $orderId);
            } else {
                $this->newOrder($taskId);
            }
        }
    }

    private function editOrder(int $taskId, int $orderId): void
    {
        $this->form = OrderFormFactory::make($taskId, $orderId);

        $this->render(
            'task/order/order',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form
            ]
        );
    }

    private function newOrder(int $taskId): void
    {
        $this->form = OrderFormFactory::makeWithoutModel($taskId);

        $this->render(
            'task/order/new-order',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form
            ]
        );
    }

    public function saveAction(): void
    {
        $taskId = (int)$this->urlParams[0];
        $orderId = (int)$this->urlParams[1];

        $this->form = OrderFormFactory::make($taskId, $orderId);

        $messageGroup = MessageGroup::getInstance();

        if ($messageGroup instanceof MessageGroup) {
            $messageGroup->addMessage(Message::SUCCESS, 'Formular', 'Speicherung war erfolgreich');
        }

        $this->form->save();
    }

    public function loadOrdersAction(): void
    {
        $options = [];

        $data = json_decode(file_get_contents('php://input'));

        $taskId = $data->taskId;

        if (!empty($taskId)) {
            /** @var Order[] $orders */
            $orders = OrderContainer::getInstance()?->findBy(['taskId' => $taskId]);

            $options[] = ['value' => -1, 'text' => "Bitte wählen"];
            foreach ($orders as $order) {
                $options[] = ['value' => $order->getID(), 'text' => "[{$order->getID()}] {$order->getSupplier()} - {$order->getTrackingCode()}"];
            }
        }

        $this->renderJson(['options' => $options]);
    }
}