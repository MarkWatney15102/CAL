<?php

declare(strict_types=1);

namespace lib\Element\Elements;

use lib\Element\AbstractElement;

class ElementHidden extends AbstractElement
{
    public function getHtml(): string
    {
        $id = $this->getId() ?? "";
        $value = $this->getValue();

        return '<input type="hidden" name="' . $id . '" id="' . $id . '" value="' . $value . '">';
    }
}
