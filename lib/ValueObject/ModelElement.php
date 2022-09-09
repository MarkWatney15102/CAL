<?php

declare(strict_types=1);

namespace lib\ValueObject;

class ModelElement
{
    public function __construct(private string $fieldname)
    {
    }
    
    public function getFieldname(): string
    {
        return $this->fieldname;
    }
}
