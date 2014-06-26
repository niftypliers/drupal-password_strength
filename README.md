## Password Strength

Realistic password strength measurement for Drupal using the
Zxcvbn-PHP library.

### Dependencies

https://github.com/bjeavons/zxcvbn-php

Clone into lib: `cd lib && git clone https://github.com/bjeavons/zxcvbn-php`

### Quickstart

1. Set a required password score of 1 
  `drush vset password_strength_default_required_score 1`
2. Go to password change form
3. Enter new password 'password' and see validation fail
