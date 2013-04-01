<?php
namespace Application\Container;

use \Pimple;
use \Doctrine_Core as Doctrine;
use \Evenement\EventEmitter;
use \Application\Service\CarService;
use \CarForm;
use \Car;
use \sfContext;

class CarContainer extends Pimple
{
    /**
     * Initialize form, table and service objects.
     */
    public function __construct()
    {
        $this['carTable'] = $this->share(function() {

            return Doctrine::getTable('Car');
        });
        $this['carForm'] = $this->share(function() {

            return new CarForm();
        });
        $this['emitter'] = $this->share(function() {
            $emitter = new EventEmitter();

            $emitter->on('car.created', function (Car $car) {
                $mailer = sfContext::getInstance()->getMailer();

                $message = $mailer->compose(
                    array('noreply@checoperez.com' => 'Checo Pérez Mail Bot'),
                    'montealegreluis@gmail.com',
                    'New Car has been Created',
                    "A new car has been created for {$car->getUser()->getFullName()}."
                );

                sfContext::getInstance()->getLogger()->info((string)$message);

                $mailer->send($message);
            });

            return $emitter;
        });
        $this['car'] = $this->share(function(Pimple $c) {
            $car = new CarService();
            $car->setCarTable($c['carTable']);
            $car->setCarForm($c['carForm']);
            $car->setEmitter($c['emitter']);

            return $car;
        });

    }
}