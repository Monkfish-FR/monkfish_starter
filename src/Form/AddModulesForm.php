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
    $form['#title'] = t('Additional packages');

    $form['packages'] = [
      '#type' => 'fieldset',
      '#title' => t('Select your packages (optional)'),
      '#tree' => TRUE,
    ];

      $form['packages']['monkfish_adminimal'] = [
        '#type' =>'checkbox',
        '#title' => t('Adminimal package'),
        '#description' => t('Contains the <a href="https://www.drupal.org/project/adminimal_theme" target="_blank">Adminimal</a> theme and the <a href="https://www.drupal.org/project/adminimal_admin_toolbar" target="_blank">Adminimal Admin Toolbar</a> module.'),
      ];

      $form['packages']['monkfish_slick'] = [
        '#type' =>'checkbox',
        '#title' => t('Slick package'),
        '#description' => t('Contains the Slick <a href="https://www.drupal.org/project/slick" target="_blank">module</a> and <a href="https://github.com/Vardot/slick" target="_blank">library</a>, and the Blazy <a href="https://www.drupal.org/project/blazy" target="_blank">module</a> and <a href="https://github.com/Vardot/blazy" target="_blank">library</a>.'),
      ];

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
// var_dump($form_state->getValues());die();
    $packages = $form_state->getValue('packages');

    if (!empty($packages)) {
      $install = [];

      foreach ($packages as $package => $value) {
        if ($value !== 0) {
          array_push($install, $package);
        }
      }

      if (!empty($install)) {
        \Drupal::service('module_installer')->install($install);
      }
    }
  }

}
