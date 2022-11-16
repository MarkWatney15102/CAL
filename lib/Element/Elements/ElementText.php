<?php

declare(strict_types=1);

namespace lib\Element\Elements;

use lib\Element\AbstractElement;

class ElementText extends AbstractElement
{
    public function getHtml(): string
    {
        $class = $this->getClass() . ' form-control' ?? "";
        $id = $this->getId() ?? "";
        $value = $this->getValue();
        $attributes = $this->getAttributes();

        return '<input type="text" class="' . $class . '" name="' . $id . '" id="' . $id . '" value="' . $value . '" ' . $attributes . '>';
    }
}
