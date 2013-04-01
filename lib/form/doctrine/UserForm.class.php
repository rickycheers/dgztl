<?php
use Application\Form\UserFormInterface;

/**
 * User form.
 *
 * @package    dgztl
 * @subpackage form
 * @author     Luis Montealegre <montealegreluis@gmail.com>
 */
class UserForm extends BaseUserForm implements UserFormInterface
{
    /**
     * @param \User $user
     * @return \UserForm
     */
    public function setUser(User $user)
    {
        $this->object = $user;
        $this->isNew = !$this->getObject()->exists();

        //Set validation options for field 'id' properly
        $validators = $this->getValidatorSchema();
        $validators['id']->setOption('required', true);
        $validators['id']->setOption('choices', array($user->getId()));

        $this->updateDefaultsFromObject();

        return $this;
    }
}
