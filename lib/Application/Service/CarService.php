<?php
namespace Application\Service;

use \Application\Table\CarTableInterface;
use \Application\Form\CarFormInterface;
use \Evenement\EventEmitter;

class CarService implements CarServiceInterface
{
    /**
     * @var \Application\Table\CarTableInterface
     */
    protected $carTable;

    /**
     * @var \Application\Form\CarFormInterface
     */
    protected $carForm;

    /**
     * @var \Evenement\EventEmitter
     */
    protected $emitter;

    /**
     * @return \Application\Table\CarTableInterface
     */
    public function getCarTable()
    {
        return $this->carTable;
    }

    /**
     * @param \Application\Table\CarTableInterface $carTable
     */
    public function setCarTable(CarTableInterface $carTable)
    {
        $this->carTable = $carTable;
    }

    /**
     * @return \Application\Form\CarFormInterface
     */
    public function getCarForm()
    {
        return $this->carForm;
    }

    /**
     * @param \Application\Form\CarFormInterface $carForm
     */
    public function setCarForm(CarFormInterface $carForm)
    {
        $this->carForm = $carForm;
    }

    /**
     * @return \Evenement\EventEmitter
     */
    public function getEmitter()
    {
        return $this->emitter;
    }

    /**
     * @param \Evenement\EventEmitter $emitter
     */
    public function setEmitter(EventEmitter $emitter)
    {
        $this->emitter = $emitter;
    }

    /**
     * @param int $carId
     */
    public function find($carId = null)
    {
        return $this->getCarTable()->find($carId);
    }

    /**
     * @param array $params
     * @param array $files
     * @return boolean
     */
    public function isValid(array $params, array $files = array())
    {
        $this->getCarForm()->bind($params, $files);

        return $this->getCarForm()->isValid();
    }

    /**
     * @return \Car
     */
    public function saveCar()
    {
        $car = $this->getCarForm()->save();

        $this->getEmitter()->emit('car.created', array($car));

        return $car;
    }
}