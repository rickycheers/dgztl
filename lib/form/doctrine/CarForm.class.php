<?php
/**
 * Car form.
 *
 * @package    dgztl
 * @subpackage form
 * @author     Luis Montealegre <montealegreluis@gmail.com>
 */
use \Application\Form\CarFormInterface;
use \Car;

/**
 * Car form.
 */
class CarForm extends BaseCarForm implements CarFormInterface
{
    /**
     * @param \Car $car
     * @return \CarForm
     */
    public function setCar(Car $car)
    {
        $this->object = $car;
        $this->isNew = !$this->getObject()->exists();

        //Set validation options for field 'id' properly
        $validators = $this->getValidatorSchema();
        $validators['id']->setOption('required', true);
        $validators['id']->setOption('choices', array($car->getId()));

        $this->updateDefaultsFromObject();

        return $this;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->setDefault('user_id', (int)$userId);
    }
}