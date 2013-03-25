<?php
/**
 * User
 *
 * @package    dgztl
 * @subpackage model
 * @author     Luis Montealegre <montealegreluis@gmail.com>
 */
class User extends BaseUser
{
    /**
     * @return string
     */
    public function getFullName()
    {
        return sprintf('%s %s', $this->getFirstName(), $this->getLastName());
    }

    /**
     * @return int
     */
    public function getCarsCount()
    {
        return (int)$this->_values['cars_count'];
    }
}
