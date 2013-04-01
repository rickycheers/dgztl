<?php
namespace Application\Table;

interface UserTableInterface
{
    /**
     * Retrieve all the users's information including the count of cars each user owns.
     *
     * @return \Doctrine_Collection
     */
    public function findAllWithCarCount();

    /**
     * Retrieve all the information related to the given user including the information
     * of all the cars she owns.
     *
     * @param int $userId
     * @return \Doctrine_Collection
     */
    public function findOneWithCarInfo($userId);

    /**
     * Find the information of a given user
     *
     * @param int $userId
     * @return \User
     */
    public function find($userId = null);
}