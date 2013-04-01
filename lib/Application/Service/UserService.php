<?php
namespace Application\Service;

use \Application\Table\UserTableInterface;
use \Application\Form\UserFormInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var \Application\Table\UserTableInterface
     */
    protected $userTable;

    /**
     * @var \Application\Form\UserFormInterface
     */
    protected $userForm;

    /**
     * @return \Application\Table\UserTableInterface
     */
    public function getUserTable()
    {
        return $this->userTable;
    }

    /**
     * @param \Application\Table\UserTableInterface $userTable
     */
    public function setUserTable(UserTableInterface $userTable)
    {
        $this->userTable = $userTable;
    }

    /**
     * @return \Application\Form\UserFormInterface
     */
    public function getUserForm()
    {
        return $this->userForm;
    }

    /**
     * @param \Application\Form\UserFormInterface $userForm
     */
    public function setUserForm(UserFormInterface $userForm)
    {
        $this->userForm = $userForm;
    }

    /**
     * @see \Application\Table\UserTableInterface::findAllWithCarCount()
     */
    public function findAllWithCarCount()
    {
        return $this->getUserTable()->findAllWithCarCount();
    }

    /**
     * @param int $userId
     * @return \Doctrine_Collection
     * @see \Application\Table\UserTableInterface::findOneWithCarInfo()
     */
    public function findOneWithCarInfo($userId)
    {
        return $this->getUserTable()->findOneWithCarInfo((int)$userId);
    }

    /**
     * @param int $userId
     * @return \User
     * @see \Application\Table\UserTableInterface::find()
     */
    public function find($userId = null)
    {
        return $this->getUserTable()->find((int)$userId);
    }

    /**
     * @param array $params
     * @param array $files
     * @return boolean
     */
    public function isValid(array $params, array $files = array())
    {
        $this->getUserForm()->bind($params, $files);

        return $this->getUserForm()->isValid();
    }

    /**
     * @return User
     */
    public function saveUser()
    {
        return $this->getUserForm()->save();
    }
}