<?php

/**
 * @file
 * Contains Drupal\password_strength\Plugin\PasswordStrengthMatcher\DateMatch.
 */

namespace Drupal\password_strength\Plugin\PasswordStrengthMatcher;

use Drupal\password_strength\MatchBase;
use ZxcvbnPhp\Matchers\DateMatch as ZxcvbnDateMatch;


/**
 * Matches the use of dates in passwords.
 *
 * @PasswordStrengthMatcher(
 *   id = "password_strength_date_match",
 *   title = @Translation("Matching the use of dates in passwords"),
 *   description = @Translation("Identifies date patterns used within passwords"),
 * )
 */
class DateMatch extends MatchBase {

  /**
   * Match occurences of dates in a password
   *
   * @copydoc Match::match()
   */
  public static function match($password, array $userInputs = array()) {
    return ZxcvbnDateMatch::match($password, $userInputs);
  }

  /**
   * @param $password
   * @param $begin
   * @param $end
   * @param $token
   * @param array $params
   *   Array with keys: day, month, year, separator.
   */
  public function __construct($password, $begin, $end, $token, $params) {
    parent::__construct($password, $begin, $end, $token);
    $this->zxcvbn_matcher = new ZxcvbnDateMatch($password, $begin, $end, $token, $params);
  }

  /**
   * Get match entropy.
   *
   * @return float
   */
  public function getEntropy() {
    return $this->zxcvbn_matcher->getEntropy();
  }
}