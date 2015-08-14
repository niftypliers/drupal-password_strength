<?php

/**
 * @file
 * Definition of Drupal\password_strength\Tests\PasswordStrengthOperations.
 */

namespace Drupal\password_strength\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Tests password strength operations.
 *
 * @group password_strength
 */
class PasswordStrengthOperations extends WebTestBase {

  public static $modules = array('password_strength', 'password_policy');

  /**
   * Test password strength policy management.
   */
  function testPasswordStrengthPolicyManagement() {
    // Create user with permission to create policy.
    $user1 = $this->drupalCreateUser(array('administer site configuration'));
    $this->drupalLogin($user1);

    // Create new password reset policy.
    $edit = array();
    $edit['score'] = '4';
    $this->drupalPostForm('admin/config/security/password-policy/password-strength', $edit, t('Add policy'));

    // Get info for policy.
    $policy = db_select("password_strength_policies", 'p')
      ->fields('p', array())
      ->orderBy('p.pid', 'DESC')
      ->execute()
      ->fetchObject();

    $this->assertEqual($policy->score, '4', 'The score must be 4 after insert');

    // Check user interface.
    $this->drupalGet('admin/config/security/password-policy');
    $this->assertText("Password Strength score greater than or equal to 4");

    // Update the policy.
    $edit = array();
    $edit['score'] = '2';
    $this->drupalPostForm("admin/config/security/password-policy/password-strength/" . $policy->pid, $edit, t('Update policy'));

    // Check user interface.
    $this->drupalGet('admin/config/security/password-policy');
    $this->assertText("Password Strength score greater than or equal to 2");

    // Get info for policy.
    $policy = db_select("password_strength_policies", 'p')
      ->fields('p', array())
      ->condition('p.pid', $policy->pid)
      ->execute()
      ->fetchObject();

    $this->assertEqual($policy->score, '2', 'The character length must be 2 after update');

    // Delete the policy.
    $edit = array();
    $this->drupalPostForm("admin/config/security/password-policy/delete-policy/password-strength-constraint/" . $policy->pid, $edit, t('Confirm deletion of policy'));

    // Get info for policy.
    $policy = db_select("password_strength_policies", 'p')
      ->fields('p', array())
      ->condition('p.pid', $policy->pid)
      ->execute()
      ->fetchAll();

    $this->assertEqual(count($policy), 0, 'The policy must be deleted');

    // Check user interface.
    $this->drupalGet('admin/config/security/password-policy');
    $this->assertNoText("Password Strength score greater than or equal to 2");
  }

}
