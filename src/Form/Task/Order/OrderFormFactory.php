<?php

namespace src\Form\Task\Order;

use src\Model\Order\Mapper\OrderMapper;
use src\Model\Order\Order;
use src\Model\Task\Mapper\TaskMapper;
use src\Model\Task\Task;

class OrderFormFactory
{
    public static function makeWithoutModel(int $taskId): OrderForm
    {
        $formData = new OrderFormData();

        $task = TaskMapper::getInstance()->read($taskId);
        if (!$task instanceof Task) {
            throw new \Exception('Task dosent exist');
        }
        $formData->addModel($task, 'task');

        $order = new Order();
        $order->setTaskId($task->getID());
        $formData->addModel($order, 'order');

        $formData->initStructure();

        return new OrderForm('orderForm', $formData);
    }

    public static function make(int $taskId, int $orderId): OrderForm
    {
        $task = TaskMapper::getInstance()?->read($taskId);
        $order = OrderMapper::getInstance()?->read($orderId);

        $formData = new OrderFormData();

        if ($task instanceof Task) {
            $formData->addModel($task, 'task');
        }

        if ($order instanceof Order) {
            $formData->addModel($order, 'order');
        }

        $formData->initStructure();

        return new OrderForm('orderForm', $formData);
    }
}