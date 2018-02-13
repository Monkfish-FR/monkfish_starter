<?php

namespace Drupal\monkfish_starter\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class AddModulesForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'add_modules';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#title'] = 'Additional modules';

    $form['modules'] = [
      '#type' =>'checkboxes',
      '#multiple' => TRUE,
      '#options' => [
        'monkfish_adminimal' => 'Adminimal theme',
        'monkfish_slick' => 'Slick package',
      ],
      '#title' => t('Do you want to install these modules?'),
    ];
// _TODO: description for the module (fieldset? markup?)
    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save and continue'),
      '#weight' => 15,
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $modules = $form_state->getValue('modules');

    if (!empty($modules)) {
      \Drupal::service('module_installer')->install($modules);
    }
  }

}
