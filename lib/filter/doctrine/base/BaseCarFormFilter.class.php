<?php

/**
 * Car filter form base class.
 *
 * @package    dgztl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCarFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'brand'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'model'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'color'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'new' => 'new', 'used' => 'used'))),
      'mileage'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date_created'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'date_modified' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'brand'         => new sfValidatorPass(array('required' => false)),
      'model'         => new sfValidatorPass(array('required' => false)),
      'color'         => new sfValidatorPass(array('required' => false)),
      'status'        => new sfValidatorChoice(array('required' => false, 'choices' => array('new' => 'new', 'used' => 'used'))),
      'mileage'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date_created'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'date_modified' => new sfValidatorPass(array('required' => false)),
      'user_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('car_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Car';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'brand'         => 'Text',
      'model'         => 'Text',
      'color'         => 'Text',
      'status'        => 'Enum',
      'mileage'       => 'Number',
      'date_created'  => 'Date',
      'date_modified' => 'Text',
      'user_id'       => 'ForeignKey',
    );
  }
}
