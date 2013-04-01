<?php
namespace Application\Service;

use \Application\Table\CarTableInterface;

interface CarServiceInterface extends CarTableInterface
{
    /**
     * @param array $params
     * @param array $files
     * @return boolean
     */
    public function isValid(array $params, array $files = array());

    /**
     * @return \Car
     */
    public function saveCar();
}