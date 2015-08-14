<?php

/**
 * @file
 * Contains Drupal\password_strength\PasswordStrengthSearcherInterface.
 */

namespace Drupal\password_strength;

interface PasswordStrengthSearcherInterface {

  /**
   * Calculate the minimum entropy for a password and its matches.
   *
   * @param string $password
   *   Password.
   * @param array $matches
   *   Array of Match objects on the password.
   *
   * @return float
   *   Minimum entropy for non-overlapping best matches of a password.
   */
  public function getMinimumEntropy($password, $matches);

}