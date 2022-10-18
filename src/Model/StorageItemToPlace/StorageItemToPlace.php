<?php

namespace src\Model\StorageItemToPlace;

use lib\Model\AbstractEntity;

class StorageItemToPlace extends AbstractEntity
{
    protected $ean = 0;
    protected $placeId = 0;
    protected $amount = 0;
    protected $row = 0;
    protected $position = 0;

    /**
     * @return int
     */
    public function getEan(): int
    {
        return $this->ean;
    }

    /**
     * @param int $ean
     */
    public function setEan(int $ean): void
    {
        $this->ean = $ean;
    }

    /**
     * @return int
     */
    public function getPlaceId(): int
    {
        return $this->placeId;
    }

    /**
     * @param int $placeId
     */
    public function setPlaceId(int $placeId): void
    {
        $this->placeId = $placeId;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getRow(): int
    {
        return $this->row;
    }

    /**
     * @param int $row
     */
    public function setRow(int $row): void
    {
        $this->row = $row;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }


}