<?php

/**
 * @file
 * Contains Drupal\password_strength\Plugin\PasswordStrengthMatcher\DictionaryMatch.
 */

namespace Drupal\password_strength\Plugin\PasswordStrengthMatcher;

use Drupal\password_strength\MatchBase;
use ZxcvbnPhp\Matchers\DictionaryMatch as ZxcvbnDictionaryMatch;

/**
 * Matches dictionary words used in passwords.
 *
 * @PasswordStrengthMatcher(
 *   id = "password_strength_dictionary_match",
 *   title = @Translation("Matching words used in passwords pulled from a dictionary"),
 *   description = @Translation("Identifies common words used within passwords pulled from a dictionary"),
 * )
 */
class DictionaryMatch extends MatchBase {

  /**
   * Match occurences of dictionary words in password.
   *
   * @copydoc Match::match()
   */
  public static function match($password, array $userInputs = array()) {
    return DictionaryMatch::match($password, $userInputs);
  }

  /**
   * @return float
   */
  public function getEntropy() {
    return $this->log($this->rank) + $this->uppercaseEntropy();
  }

  /**
   * @return float
   */
  protected function uppercaseEntropy() {
    $token = $this->token;
    // Return if token is all lowercase.
    if ($token === strtolower($token)) {
      return 0;
    }

    $startUpper = '/^[A-Z][^A-Z]+$/';
    $endUpper = '/^[^A-Z]+[A-Z]$/';
    $allUpper = '/^[A-Z]+$/';
    // a capitalized word is the most common capitalization scheme, so it only doubles the search space
    // (uncapitalized + capitalized): 1 extra bit of entropy. allcaps and end-capitalized are common enough to
    // underestimate as 1 extra bit to be safe.
    foreach (array($startUpper, $endUpper, $allUpper) as $regex) {
      if (preg_match($regex, $token)) {
        return 1;
      }
    }

    // Otherwise calculate the number of ways to capitalize U+L uppercase+lowercase letters with U uppercase letters or
    // less. Or, if there's more uppercase than lower (for e.g. PASSwORD), the number of ways to lowercase U+L letters
    // with L lowercase letters or less.
    $uLen = 0;
    $lLen = 0;

    foreach (str_split($token) as $x) {
      $ord = ord($x);

      if ($this->isUpper($ord)) {
        $uLen += 1;
      }
      if ($this->isLower($ord)) {
        $lLen += 1;
      }
    }

    $possibilities = 0;
    foreach (range(0, min($uLen, $lLen) + 1) as $i) {
      $possibilities += $this->binom($uLen + $lLen, $i);
    }

    return $this->log($possibilities);
  }
}