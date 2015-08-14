<?php

/**
 * @file
 * Contains Drupal\password_strength\Annotation\PasswordStrengthSearcher.
 */

namespace Drupal\password_strength\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a PasswordStrength searcher annotation object.
 *
 * @Annotation
 */
class PasswordStrengthSearcher extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the scorer.
   *
   * @ingroup plugin_translatable
   *
   * @var \Drupal\Core\Annotation\Translation
   */
  public $title;

  /**
   * The description shown to users.
   *
   * @ingroup plugin_translatable
   *
   * @var \Drupal\Core\Annotation\Translation
   */
  public $description;

}
