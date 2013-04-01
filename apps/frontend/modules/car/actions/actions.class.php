<?php
/**
 * Car actions.
 *
 * @package    dgztl
 * @subpackage car
 * @author     Luis Montealegre <montealegreluis@gmail.com>
 */
use \Application\Container\CarContainer;

/**
 * Car actions.
 */
class carActions extends sfActions
{
    /**
     * @var \Application\Service\CarService
     */
    protected $service;

    /**
     * Initialize dependency injection container
     */
    public function __construct($context, $moduleName, $actionName)
    {
        parent::__construct($context, $moduleName, $actionName);
        $container = new CarContainer();
        $this->service = $container['car'];
    }

    /**
     * The list of cars is filtered in the user's show action, and shouldn't be accesed
     * through this controller
     *
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->forward404('Page not found');
    }

    /**
     * Show a car's details given its numerical ID
     *
     * @param sfWebRequest $request
     */
    public function executeShow(sfWebRequest $request)
    {
        $this->car = $this->retrieveCar($request->getParameter('id'));
    }

    /**
     * Show the form to create a new car entry associated to a given user
     *
     * @param sfWebRequest $request
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->form = $this->service->getCarForm();
        $this->form->setUserId($request->getParameter('user-id'));
    }

    /**
     * Save the details of a new car entry
     *
     * @param sfWebRequest $request
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = $this->service->getCarForm();
        $this->processForm($request, $this->form->getName());

        $this->setTemplate('new');
    }

    /**
     * Populate the form with the details of a car in order to update them
     *
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request)
    {
        $car = $this->retrieveCar($request->getParameter('id'));

        $this->form = $this->service->getCarForm()->setCar($car);
    }

    /**
     * Persist the changes of a given car entry
     *
     * @param sfWebRequest $request
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless(
            $request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT)
        );

        $car = $this->retrieveCar($request->getParameter('id'));

        $this->form = $this->service->getCarForm()->setCar($car);
        $this->processForm($request, $this->form->getName());

        $this->setTemplate('edit');
    }

    /**
     * Perform the deletion of a car information given its numerical ID
     *
     * @param sfWebRequest $request
     */
    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $car = $this->retrieveCar($request->getParameter('id'));
        $car->delete();

        $this->redirect('user/show?id=' . $request->getParameter('user-id'));
    }

    /**
     * Bind the information in the form with the information in the request
     *
     * @param sfWebRequest $request
     * @param string $formName
     */
    protected function processForm(sfWebRequest $request, $formName)
    {
        if ($this->service->isValid($request->getParameter($formName))) {

            $car = $this->service->saveCar();
            $this->redirect(
                'car/edit?user-id=' . $car->getUserId() . '&id=' . $car->getId()
            );
        }
    }

    /**
     * If no car is found, the current request is forwarded to the 404 page
     *
     * @param $carId
     * @return Car
     */
    protected function retrieveCar($carId)
    {
        $car = $this->service->find($carId);
        $this->forward404Unless($car, sprintf('Car does not exist (%s).', $carId));

        return $car;
    }
}