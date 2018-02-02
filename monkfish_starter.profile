<?php
/**
 * @file
 * Enables modules and site configuration for a standard site installation.
 */

use Drupal\Core\Form\FormStateInterface;


/**
 * Implements hook_form_FORM_ID_alter() for install_settings_form().
 *
 * Allows the profile to alter the database configuration form.
 */
function monkfish_starter_form_install_settings_form_alter(&$form, FormStateInterface $form_state) {
  $base_path = rtrim($GLOBALS['base_path'], '/web/');
  $parts = explode('/', $base_path);
  $db_name = end($parts);
  $form['settings']['mysql']['database']['#default_value'] = strtolower($db_name);

  $form['settings']['mysql']['username']['#default_value'] = 'root';

  $form['settings']['mysql']['password']['#type'] = 'textfield';
  $form['settings']['mysql']['password']['#default_value'] = 'root';
}

/**
 * Implements hook_form_FORM_ID_alter() for install_configure_form().
 *
 * Allows the profile to alter the site configuration form.
 */
function monkfish_starter_form_install_configure_form_alter(&$form, FormStateInterface $form_state) {
  // Site information
  $base_path = rtrim($GLOBALS['base_path'], '/web/');
  $parts = explode('/', $base_path);
  $site_name = end($parts);
  $form['site_information']['site_name']['#default_value'] = $site_name;

  $form['site_information']['site_mail']['#default_value'] = 'contact@monkfish.fr';

  // Site maintenance account
  $form['admin_account']['account']['name']['#default_value'] = 'admin';
  $form['admin_account']['account']['mail']['#default_value'] = 'contact@monkfish.fr';

  // Regional settings
  $form['regional_settings']['site_default_country']['#default_value'] = 'FR';
  $form['regional_settings']['date_default_timezone']['#default_value'] = 'Europe/Paris';

  // Update notifications
  $form['update_notifications']['enable_update_status_emails']['#default_value'] = 0;
}

/**
 * Implements hook_install_tasks().
 */
function monkfish_starter_install_tasks(&$install_state) {
  return [
    'monkfish_starter_add_modules' => [
      'display_name' => t('Additional modules'),
      'display' => TRUE,
      'type' => 'form',
      'function' => 'Drupal\monkfish_starter\Form\AddModulesForm',
    ],
  ];
}
