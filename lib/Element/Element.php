<?php

declare(strict_types=1);

namespace lib\Element;

use Exception;
use lib\Element\Elements\ElementCheckbox;
use lib\Element\Elements\ElementDate;
use lib\Element\Elements\ElementEmail;
use lib\Element\Elements\ElementHidden;
use lib\Element\Elements\ElementNumber;
use lib\Element\Elements\ElementPassword;
use lib\Element\Elements\ElementSelect;
use lib\Element\Elements\ElementSubmit;
use lib\Element\Elements\ElementText;
use lib\Element\Elements\ElementTextarea;

enum Element
{
    case DATE;
    case EMAIL;
    case NUMBER;
    case PASSWORD;
    case TEXT;
    case SUBMIT;
    case SELECT;
    case HIDDEN;
    case CHECKBOX;
    case TEXTAREA;

    /**
     * @throws Exception
     */
    public function getClass(): AbstractElement
    {
        return match ($this) {
            self::TEXT => new ElementText(),
            self::PASSWORD => new ElementPassword(),
            self::NUMBER => new ElementNumber(),
            self::EMAIL => new ElementEmail(),
            self::DATE => new ElementDate(),
            self::SUBMIT => new ElementSubmit(),
            self::SELECT => new ElementSelect(),
            self::HIDDEN => new ElementHidden(),
            self::CHECKBOX => new ElementCheckbox(),
            self::TEXTAREA => new ElementTextarea(),
            default => throw new Exception('Invalid type')
        };
    }
}
