<?php
/**
 * @file
 * Contains Drupal\password_strength\PasswordStrengthScorerPluginManager.
 */

namespace Drupal\password_strength;

use Drupal\Core\Plugin\Discovery\AnnotatedClassDiscovery;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Language\LanguageManager;


class PasswordStrengthScorerPluginManager extends \Drupal\Core\Plugin\DefaultPluginManager {
  /**
   * Constructs a new PasswordStrengthScorerPluginManager.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/PasswordStrengthScorer', $namespaces, $module_handler, 'Drupal\password_strength\PasswordStrengthScorerInterface', 'Drupal\password_strength\Annotation\PasswordStrengthScorer');
    $this->alterInfo('password_policy_password_strength_scorer_info');
    $this->setCacheBackend($cache_backend, 'password_strength_scorer');
  }

}