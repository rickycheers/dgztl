<?php
/**
 * User form base class.
 *
 * @method User getObject() Returns the current form's model object
 *
 * @package    dgztl
 * @subpackage form
 * @author     Luis Montealegre <montealegreluis@gmail.com>
 */
abstract class BaseUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'first_name'    => new sfWidgetFormInputText(),
      'last_name'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'first_name'    => new sfValidatorString(array('max_length' => 45)),
      'last_name'     => new sfValidatorString(array('max_length' => 45)),
    ));

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }
}