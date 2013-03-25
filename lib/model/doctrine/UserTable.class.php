<?php
use \Doctrine_Query as Query;
use \Doctrine_Table as Table;

/**
 * UserTable
 *
 * @package    dgztl
 * @subpackage model
 * @author     Luis Montealegre <montealegreluis@gmail.com>
 */
class UserTable extends Table
{
    /**
     * Returns an instance of this class.
     *
     * @return UserTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('User');
    }

    /**
     * @return \Doctrine_Collection
     */
    public function findAllWithCarCount()
    {
        $q = Query::create();
        return $q->select('u.id, u.first_name, u.last_name, COUNT(c.id) AS cars_count')
                 ->from('User u')
                 ->leftJoin('u.Car c')
                 ->groupBy('u.id')
                 ->execute();
    }

    /**
     * @return \Doctrine_Collection
     */
    public function findOneWithCarInfo($userId)
    {
        $q = Query::create();
        return $q->select('
                    u.id,
                    u.first_name,
                    u.last_name,
                    c.id,
                    c.brand,
                    c.model,
                    c.status,
                    c.mileage'
                 )
                 ->from('User u')
                 ->leftJoin('u.Car c')
                 ->where('u.id = ?', (int)$userId)
                 ->fetchOne();
    }
}