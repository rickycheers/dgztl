<?php
/**
 * Car Table
 *
 * @package    dgztl
 * @subpackage table
 * @author     Luis Montealegre <montealegreluis@gmail.com>
 */
use \Doctrine_Table as Table;
use \Application\Table\CarTableInterface;

/**
 * Car Table
 */
class CarTable extends Table implements CarTableInterface
{
    /**
     * @param int $carId
     */
    public function find($carId = null)
    {
        return parent::find((int)$carId);
    }
}