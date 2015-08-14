<?php

/**
 * @file
 * Contains Drupal\password_strength\Plugin\PasswordStrengthMatcher\DigitMatch.
 */

namespace Drupal\password_strength\Plugin\PasswordStrengthMatcher;

use Drupal\password_strength\MatchBase;
use ZxcvbnPhp\Matchers\DigitMatch as ZxcvbnDigitMatch;
use ZxcvbnPhp\Matchers\MatchInterface;

/**
 * Matches the use of the same three digits of characters used in passwords.
 *
 * @PasswordStrengthMatcher(
 *   id = "password_strength_digit_match",
 *   title = @Translation("Matching the use of three or more digits in a row in passwords"),
 *   description = @Translation("Identifies the use of three or more digits in a row within passwords"),
 * )
 */

class DigitMatch extends MatchBase implements MatchInterface {

  /**
   * Match occurences of 3 or more digits in a password
   *
   * @copydoc Match::match()
   */
  public static function match($password, array $userInputs = array()) {
    return ZxcvbnDigitMatch::match($password, $userInputs);
  }

  /**
   * @param $password
   * @param $begin
   * @param $end
   * @param $token
   */
  public function __construct($password, $begin, $end, $token) {
    parent::__construct($password, $begin, $end, $token);
    $this->zxcvbn_matcher = new ZxcvbnDigitMatch($password, $begin, $end, $token);
  }
}