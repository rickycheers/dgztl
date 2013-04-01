<?php
namespace Application\Service;

use \Application\Table\UserTableInterface;

interface UserServiceInterface extends UserTableInterface
{
    /**
     * Validate the request parameters before persisting the user information
     *
     * @param array $params
     * @param array $files
     * @return boolean
     */
    public function isValid(array $params, array $files = array());

    /**
     * Persist the user information
     *
     * @return User
     */
    public function saveUser();
}