<?php

/**
 * @file
 * Contains Drupal\password_strength\Plugin\PasswordStrengthMatcher\Bruteforce.
 */

namespace Drupal\password_strength\Plugin\PasswordStrengthMatcher;

use Drupal\password_strength\MatchBase;
use ZxcvbnPhp\Matchers\Bruteforce as ZxcvbnBruteforce;


/**
 * Brute force checking of a password.
 *
 * @PasswordStrengthMatcher(
 *   id = "password_strength_bruteforce_match",
 *   title = @Translation("Brute force checking of a password"),
 *   description = @Translation("Providing a score based on brute force attempts against the password"),
 * )
 */
class Bruteforce extends MatchBase {

  /**
   * @copydoc Match::match()
   */
  public static function match($password, array $userInputs = array()) {
    return ZxcvbnBruteforce::match($password, $userInputs);
  }

  /**
   * @param $password
   * @param $begin
   * @param $end
   * @param $token
   * @param $cardinality
   */
  public function __construct($password, $begin, $end, $token, $cardinality = NULL) {
    parent::__construct($password, $begin, $end, $token);
    $this->zxcvbn_matcher = new ZxcvbnBruteforce($password, $begin, $end, $token);
    $this->pattern = 'bruteforce';
  }

  /**
   *
   */
  public function getEntropy() {
    return $this->zxcvbn_matcher->getEntropy();
  }
}