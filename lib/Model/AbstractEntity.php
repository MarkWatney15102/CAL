<?php

declare(strict_types=1);

namespace lib\Model;

use ReflectionClass;

abstract class AbstractEntity
{
    protected int|null $ID = null;

    /**
     * Get the value of ID
     */ 
    public function getID()
    {
        return $this->ID;
    }

    /**
     * Set the value of ID
     *
     * @return  self
     */ 
    public function setID($ID)
    {
        $this->ID = $ID;

        return $this;
    }

    public function getMapperClass()
    {
        $class = new ReflectionClass(get_called_class());
        $className = "src/Model/" . $class->getShortName() . "/Mapper/" . $class->getShortName() . "Mapper";

        require_once $className . ".php";

        $className = str_replace("/", "\\", $className);

        return $className::getInstance();
    }
}
