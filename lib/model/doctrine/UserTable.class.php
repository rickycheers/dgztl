<?php
use \Doctrine_Query as Query;
use \Doctrine_Table as Table;
use \Application\Table\UserTableInterface;

/**
 * UserTable
 *
 * @package    dgztl
 * @subpackage model
 * @author     Luis Montealegre <montealegreluis@gmail.com>
 */
class UserTable extends Table implements UserTableInterface
{
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
     * @param int $userId
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
                    c.color,
                    c.status,
                    c.mileage'
                 )
                 ->from('User u')
                 ->leftJoin('u.Car c')
                 ->where('u.id = ?', (int)$userId)
                 ->fetchOne();
    }

    /**
     * @param string $userId
     */
    public function find($userId = null)
    {
        return parent::find((int)$userId);
    }
}