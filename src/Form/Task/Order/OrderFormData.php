<?php

namespace src\Form\Task\Order;

use lib\Element\Element;
use lib\Form\AbstractFormData;
use src\Model\CatOrderStatus\CatOrderStatus;
use src\Model\CatOrderStatus\Mapper\CatOrderStatusContainer;
use src\Model\Order\Order;
use src\Model\Task\Task;

class OrderFormData extends AbstractFormData
{
    public function initStructure(): void
    {
        /** @var Task $task */
        $task = $this->getModel('task');

        /** @var Order $order */
        $order = $this->getModel('order');

        $this->addElement(
            [
                'id' => 'taskId',
                'type' => Element::HIDDEN,
                'read' => function () use ($task) {
                    if ($task instanceof Task) {
                        return $task->getID();
                    }
                },
                'write' => function ($value) use ($task, $order) {
                    if ($task instanceof Task && $order instanceof Order) {
                        $order->setTaskId($task->getID());
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'supplier',
                'type' => Element::TEXT,
                'label' => 'Lieferant',
                'read' => function () use ($order) {
                    if ($order instanceof Order && !empty($order->getSupplier())) {
                        return $order->getSupplier();
                    }

                    return "";
                },
                'write' => function ($value) use ($order) {
                    if ($order instanceof Order) {
                        $order->setSupplier($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'trackingCode',
                'type' => Element::TEXT,
                'label' => 'Sendungsnummer',
                'read' => function () use ($order) {
                    if ($order instanceof Order && !empty($order->getTrackingCode())) {
                        return $order->getTrackingCode();
                    }

                    return "";
                },
                'write' => function ($value) use ($order) {
                    if ($order instanceof Order) {
                        $order->setTrackingCode($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'status',
                'type' => Element::SELECT,
                'label' => 'Status',
                'defaultOption' => true,
                'options' => $this->getStatusSelectOptions(),
                'read' => function () use ($order) {
                    if ($order instanceof Order && !empty($order->getStatus())) {
                        return $order->getStatus();
                    }

                    return 0;
                },
                'write' => function ($value) use ($order) {
                    if ($order instanceof Order) {
                        $order->setStatus((int)$value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'save',
                'type' => Element::SUBMIT,
                'label' => 'Speichern'
            ]
        );
    }

    private function getStatusSelectOptions(): array
    {
        $options = [];

        /** @var CatOrderStatus[] $orderStatus */
        $orderStatus = CatOrderStatusContainer::getInstance()?->findBy([]);

        foreach ($orderStatus as $status) {
            $options[] = ['value' => $status->getID(), 'text' => $status->getText()];
        }

        return $options;
    }
}