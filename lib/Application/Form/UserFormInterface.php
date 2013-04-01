<?php
namespace Application\Form;

use \User;

interface UserFormInterface
{
    /**
     * @param User $user
     */
    public function setUser(User $user);
}