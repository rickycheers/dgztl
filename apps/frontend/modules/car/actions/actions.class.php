<?php
/**
 * Car actions.
 *
 * @package    dgztl
 * @subpackage car
 * @author     Luis Montealegre <montealegreluis@gmail.com>
 */
class carActions extends sfActions
{
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
        $this->form = new CarForm();
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

        $this->form = new CarForm();
        $this->processForm($request, $this->form);

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

        $this->form = new CarForm($car);
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

        $this->form = new CarForm($car);
        $this->processForm($request, $this->form);

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
     * @param sfForm $form
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind(
            $request->getParameter($form->getName()), $request->getFiles($form->getName())
        );

        if ($form->isValid()) {

            $car = $form->save();
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
        $car = CarTable::getInstance()->find(array($carId));
        $this->forward404Unless($car, sprintf('Car does not exist (%s).', $carId));

        return $car;
    }
}