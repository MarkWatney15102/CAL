<?php

namespace lib\Element\Elements;

use lib\Element\AbstractElement;

class ElementTextarea extends AbstractElement
{
    public function getHtml(): string
    {
        $class = $this->getClass() . ' form-control' ?? "";
        $id = $this->getId() ?? "";
        $value = $this->getValue();
        $attributes = $this->getAttributes();

        return '<textarea class="' . $class . '" name="' . $id . '" id="' . $id . '" ' . $attributes . '>' . $value . '</textarea>';
    }
}