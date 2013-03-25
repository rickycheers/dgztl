<?php
/**
 * Car form.
 *
 * @package    dgztl
 * @subpackage form
 * @author     Luis Montealegre <montealegreluis@gmail.com>
 */
class CarForm extends BaseCarForm
{
  public function configure()
  {
  }

  /**
   * @param int $userId
   */
  public function setUserId($userId)
  {
      $this->setDefault('user_id', (int)$userId);
  }
}