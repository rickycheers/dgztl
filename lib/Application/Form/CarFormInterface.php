<?php
namespace Application\Form;

use \Car;

interface CarFormInterface
{
    /**
     * @param \Car $car
     * @return \CarForm
     */
    public function setCar(Car $car);

    /**
     * @param int $userId
     */
    public function setUserId($userId);
}