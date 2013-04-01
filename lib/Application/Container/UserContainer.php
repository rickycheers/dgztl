<?php
namespace Application\Container;

use \Pimple;
use \Doctrine_Core as Doctrine;
use \Application\Service\UserService;
use \UserForm;

class UserContainer extends Pimple
{
    /**
     * Initialize form, table and service objects.
     */
    public function __construct()
    {
        $this['userTable'] = $this->share(function() {

            return Doctrine::getTable('User');
        });
        $this['userForm'] = $this->share(function() {

            return new UserForm();
        });
        $this['user'] = $this->share(function(Pimple $c) {
            $user = new UserService();
            $user->setUserTable($c['userTable']);
            $user->setUserForm($c['userForm']);

            return $user;
        });
    }
}