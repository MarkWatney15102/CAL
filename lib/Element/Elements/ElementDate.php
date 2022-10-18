<?php

declare(strict_types=1);

namespace lib\Element\Elements;

use DateTime;
use Exception;
use lib\Element\AbstractElement;

class ElementDate extends AbstractElement
{
    public function getHtml(): string
    {
        $class = $this->getClass() . ' form-control' ?? "";
        $id = $this->getId() ?? "";
        $value = $this->getValue();
        $attributes = $this->getAttributes();

        return '<input type="date" class="' . $class . '" name="' . $id . '" id="' . $id . '" value="' . $value . '" ' . $attributes . '>';
    }

    public function setValue(string|int $value): AbstractElement
    {
        try {
            $date = new DateTime($value);
        } catch (Exception $e) {
            $date = new DateTime();
        }

        $this->value = $date->format('Y-m-d');
        
        return $this;
    }
}
