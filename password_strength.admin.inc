<?php

/**
 * @file
 * Admin page callbacks for the password strength module.
 */

/**
 * Form builder for password strength form.
 *
 * @see system_settings_form()
 * @ingroup forms
 */
function password_strength_settings() {
  $form = array();
  $form['password_strength_default_required_score'] = array(
    '#type' => 'select',
    '#title' => t('Minimum required password strength'),
    '#description' => t('The minimum strength required for user account passwords.'),
    '#default_value' => variable_get('password_strength_default_required_score', NULL),
    '#options' => password_strength_score_list(),
  );

  return system_settings_form($form);
}
