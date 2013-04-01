<?php
namespace Application\Table;

interface CarTableInterface
{
    /**
     * @param string $carId
     */
    public function find($carId = null);
}