<?php

namespace src\Form\Task\Order;

use lib\Element\AbstractElement;
use lib\Element\Elements\ElementSubmit;
use lib\Form\AbstractForm;
use src\Model\Order\Mapper\OrderMapper;
use src\Model\Order\Order;
use src\Model\Task\Task;

class OrderForm extends AbstractForm
{

    public function save(): void
    {
        $elements = $this->formData->getElements();

        /** @var Order $order */
        $order = $this->formData->getModel('order');

        foreach ($elements as $element) {
            if ($element instanceof AbstractElement && !$element instanceof ElementSubmit) {
                if (array_key_exists($element->getId(), $_POST)) {
                    $newValue = $_POST[$element->getId()];
                    if (!empty($element->getWrite())) {
                        call_user_func_array($element->getWrite(), [$newValue]);
                    }
                }
            }
        }

        if ($order->getID() !== null) {
            $orderId = OrderMapper::getInstance()?->update($order);
        } else {
            $orderId = OrderMapper::getInstance()?->create($order);
        }

        header('Location: /order/' . $order->getTaskId() . '/' . $orderId);
    }
}