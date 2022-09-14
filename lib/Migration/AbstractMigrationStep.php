<?php

namespace lib\Migration;

use lib\Database\Database;

abstract class AbstractMigrationStep
{
    /**
     * Do not use order twice
     * For a new Migration Step add 1000 to last order
     */
    public const ORDER = 0;

    public string $name;

    public function __construct(protected Database $database)
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    abstract public function run(): void;
}