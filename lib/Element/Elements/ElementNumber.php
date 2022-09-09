<?php

declare(strict_types=1);

namespace lib\Element\Elements;

use lib\Element\AbstractElement;

class ElementNumber extends AbstractElement
{
    public function getHtml(): string
    {
        $class = $this->getClass() . ' form-control' ?? "";
        $id = $this->getId() ?? "";
        $value = $this->getValue();

        return '<input type="number" class="' . $class . '" name="' . $id . '" id="' . $id . '" value="' . $value . '">';
    }
}
