<?php
/**
 * Car form base class.
 *
 * @method Car getObject() Returns the current form's model object
 *
 * @package    dgztl
 * @subpackage form
 * @author     Luis Montealegre <montealegreluis@gmail.com>
 */
abstract class BaseCarForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'brand'         => new sfWidgetFormInputText(),
      'model'         => new sfWidgetFormInputText(),
      'color'         => new sfWidgetFormInputText(),
      'status'        => new sfWidgetFormChoice(array('choices' => array('new' => 'new', 'used' => 'used'))),
      'mileage'       => new sfWidgetFormInputText(),
      'user_id'       => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'brand'         => new sfValidatorString(array('max_length' => 60)),
      'model'         => new sfValidatorString(array('max_length' => 60)),
      'color'         => new sfValidatorString(array('max_length' => 60)),
      'status'        => new sfValidatorChoice(array('choices' => array(0 => 'new', 1 => 'used'))),
      'mileage'       => new sfValidatorInteger(),
      'user_id'       => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('car[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Car';
  }
}