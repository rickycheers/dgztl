<?php
/**
 * Car
 *
 * @package    dgztl
 * @subpackage model
 * @author     Luis Montealegre <montealegreluis@gmail.com>
 */
class Car extends BaseCar
{
    /**
     * @return string
     */
    public function getName()
    {
        return sprintf('%s %s', $this->getBrand(), $this->getModel());
    }
}