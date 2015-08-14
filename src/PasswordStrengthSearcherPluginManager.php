<?php
/**
 * @file
 * Contains Drupal\password_strength\PasswordStrengthSearcherPluginManager.
 */

namespace Drupal\password_strength;

use Drupal\Core\Plugin\Discovery\AnnotatedClassDiscovery;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Language\LanguageManager;


class PasswordStrengthSearcherPluginManager extends \Drupal\Core\Plugin\DefaultPluginManager {
  /**
   * Constructs a new PasswordStrengthSearcherPluginManager.
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
    parent::__construct('Plugin/PasswordStrengthSearcher', $namespaces, $module_handler, 'Drupal\password_strength\PasswordStrengthSearcherInterface', 'Drupal\password_strength\Annotation\PasswordStrengthSearcher');
    $this->alterInfo('password_policy_password_strength_searcher_info');
    $this->setCacheBackend($cache_backend, 'password_strength_searcher');
  }

}