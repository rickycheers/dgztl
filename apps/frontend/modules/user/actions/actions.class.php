<?php
/**
 * user actions.
 *
 * @package    dgztl
 * @subpackage user
 * @author     Luis Montealegre <montealegreluis@gmail.com>
 */
use \Application\Container\UserContainer;

/**
 * User actions.
 */
class userActions extends sfActions
{
    /**
     * @var \Application\Service\UserService
     */
    protected $service;

    /**
     * Initialize dependency injection container
     */
    public function __construct($context, $moduleName, $actionName)
    {
        parent::__construct($context, $moduleName, $actionName);
        $container = new UserContainer();
        $this->service = $container['user'];
    }

    /**
     * Retrieve all the users and the count of the cars that they own
     *
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->users = $this->service->findAllWithCarCount();
    }

    /**
     * Retrieve a single user by its numerical id and the information about the cars she
     * owns
     *
     * @param sfWebRequest $request
     */
    public function executeShow(sfWebRequest $request)
    {
        $this->user = $this->service->findOneWithCarInfo($request->getParameter('id'));
        $this->forward404Unless($this->user);
    }

    /**
     * Show the form to create a new user entry
     *
     * @param sfWebRequest $request
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->form = $this->service->getUserForm();
    }

    /**
     * Save a new user entry
     *
     * @param sfWebRequest $request
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = $this->service->getUserForm();
        $this->processForm($request, $this->form->getName());

        $this->setTemplate('new');
    }

    /**
     * Populate the form with the details of a user in order to update them
     *
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request)
    {
        $user = $this->retrieveUser($request->getParameter('id'));

        $this->form = $this->service->getUserForm()->setUser($user);
    }

    /**
     * Persist the changes of a given user entry
     *
     * @param sfWebRequest $request
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless(
            $request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT)
        );

        $user = $this->retrieveUser($request->getParameter('id'));
        $this->form = $this->service->getUserForm()->setUser($user);

        $this->processForm($request, $this->form->getName());

        $this->setTemplate('edit');
    }

    /**
     * Delete the information of the given user
     *
     * @param sfWebRequest $request
     */
    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $user = $this->retrieveUser($request->getParameter('id'));
        $user->delete();

        $this->redirect('user/index');
    }

    /**
     * Bind the request values to the user form in order to update the user information
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processForm(sfWebRequest $request, $formName)
    {
        if ($this->service->isValid($request->getParameter($formName))) {

            $user = $this->service->saveUser();
            $this->redirect('user/show?id=' . $user->getId());
        }
    }

    /**
     * If no user is found, the current request is forwarded to the 404 page
     *
     * @param int $userId
     * @return User
     */
    protected function retrieveUser($userId)
    {
        $user = $this->service->find($userId);
        $this->forward404Unless($user, sprintf('User does not exist (%s).', $userId));

        return $user;
    }
}