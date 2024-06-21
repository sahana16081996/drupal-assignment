<?php

namespace Drupal\cities\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class CitiesSettingsForm.
 *
 *  This is cities settings form.
 */
class CitiesSettingsForm extends FormBase {

  /**
   * Form Id.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'cities_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   An associative array containing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }

  /**
   * Define the form used for cities settings.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   An associative array containing the current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['inventory_settings']['#markup'] = 'Settings form for Cities. Manage field settings here.';
    return $form;
  }

}
